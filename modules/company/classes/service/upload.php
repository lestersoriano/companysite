<?php defined('SYSPATH') or die('No direct script access.');

class Service_Upload extends Service
{
    const NAME_RANDOM = 'random';
    const FILE_IMAGES = 'jpeg jpg gif png bmp';
    const FILE_FETCH_IMAGES = 'image/jpeg image/gif image/png image/bmp';
    const ERR_INVALID_TYPE = -1;
    
    public static $errors = array(
        self::ERR_INVALID_TYPE => 'invalid file type',
        UPLOAD_ERR_OK          => 'success',
        UPLOAD_ERR_INI_SIZE    => 'file too large [set by ini]',
        UPLOAD_ERR_FORM_SIZE   => 'file too large',
        UPLOAD_ERR_PARTIAL     => 'file was partially uploaded',
        UPLOAD_ERR_NO_FILE     => 'no file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR  => 'missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE  => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION   => 'php extension stopped the file upload'
    );

    public function upload($allowed_types, $limit = 2097152)
    {
        if (!is_array($allowed_types))
        {
            $allowed_types = explode(' ', $allowed_types);
        }
        
        $uploader = new \QqUploader($allowed_types, $limit);
        $result = $uploader->handleUpload(TEMP_FOLDER);
            
        if (!isset($result['success']) || true !== $result['success'])
        {
            //echo $this->respond($result, false);
            return $this->respond($result, false);
        }
        
        return $this->respond(array('object' => 'file', 'path' => $uploader->file->getName()), true);
    }
    
    public function fetch($file, $allowed_types, $limit = 2097152)
    {
        $result = array();
        
        if (!is_array($allowed_types))
        {
            $allowed_types = explode(' ', $allowed_types);
        }
        
        if ($file['error'] > 0)
        {
            return $this->respond(array(
                'code' => $file['error'],
                'message' => self::$errors[$file['error']],
            ), false);
        }
        
        if (!in_array($file['type'], $allowed_types))
        {
            return $this->respond(array(
                'code' => self::ERR_INVALID_TYPE,
                'message' => self::$errors[self::ERR_INVALID_TYPE],
            ), false);
        }
        
        if ($file['size'] > $limit)
        {
            return $this->respond(array(
                'code' => UPLOAD_ERR_FORM_SIZE,
                'message' => self::$errors[UPLOAD_ERR_FORM_SIZE],
            ), false);
        }
        
        $exts = File::exts_by_mime($file['type']);
        $file_name = TEMP_FOLDER . uniqid('image_') . '.' . end($exts);

        if (move_uploaded_file($file['tmp_name'], $file_name))
        {
            return $this->respond(array('object' => 'file', 'path' => $file_name), true);
        }
        
        return $this->respond(array(
            'code' => UPLOAD_ERR_EXTENSION,
            'message' => self::$errors[UPLOAD_ERR_EXTENSION],
        ), false);
    }
    
    public function is_animated() 
    {
        if(!($fh = @fopen($this->result['path'], 'rb')))
            return false;
        $count = 0;
        //an animated gif contains multiple "frames", with each frame having a 
        //header made up of:
        // * a static 4-byte sequence (\x00\x21\xF9\x04)
        // * 4 variable bytes
        // * a static 2-byte sequence (\x00\x2C) (some variants may use \x00\x21 ?)
        
        // We read through the file til we reach the end of the file, or we've found 
        // at least 2 frame headers
        while(!feof($fh) && $count < 2) {
            $chunk = fread($fh, 1024 * 100); //read 100kb at a time
            $count += preg_match_all('#\x00\x21\xF9\x04.{4}\x00(\x2C|\x21)#s', $chunk, $matches);
       }
        
        fclose($fh);
        return $count > 1;
    }

 	public function usefile($filename)
    {
        $this->result['path'] = $filename;
        $this->result['object'] = 'file';
        $this->status = true;
        return $this;
    }

    public function validate($allowed_image_only = true)
    {
        $type = array('FILE', 'GIF', 'JPG', 'PNG', 'SWF', 'PSD', 'BMP',
            'TIFF_II', 'TIFF_MM', 'JPC', 'JP2', 'JPX', 'JB2', 'SWC', 'IFF',
            'WBMP', 'XBM', 'ICO');
        
        $result = exif_imagetype($this->result['path']);
        $result = empty($type[$result]) ? 'FILE': $type[$result];
        
        if ($allowed_image_only)
        {
            $allow = explode(' ', strtoupper(self::FILE_IMAGES));
            return in_array($result, $allow) ? $result: 'FILE';
        }
        
        return  $result;
    }
    
    public function rotate($name = null, $degrees = 45,$file_prefix = '')
    {
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }

        $path = $this->_get_path($name, $file_prefix);
        $image = \Image::factory($this->result['path']);
		$image->rotate($degrees);
        $image->save($path);
        $this->result['path'] = $path;
        
        return $this;
    }

    public function image()
    {
        return \Image::factory($this->result['path']);
    }

     public function resizewidth($costraint, $name = null, $file_prefix = '', $reverse = null)
    {
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }

        $path = $this->_get_path($name, $file_prefix);
        $image = \Image::factory($this->result['path']);
    
    	$height = null;
	    $width = $costraint;

        $image->resize($width, $height);
        

        // for yahoo images
        if(strpos($path,"?") !== false){
        	$arrpath =explode("?",$path);
        	$path = $arrpath[0];
        }
        
        $image->save($path);
        
        $this->result['path'] = $path;
        
        return $this;
    }
    
    public function resize($costraint, $name = null, $file_prefix = '', $reverse = null)
    {
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }

        $path = $this->_get_path($name, $file_prefix);
        $image = \Image::factory($this->result['path']);
    
    	if($reverse == null){
	        // limit photo size being uploaded
	        if ($image->height > $image->width)
	        {
	            $height = $costraint;
	            $width = null;
	        }
	        else
	        {
	            $height = null;
	            $width = $costraint;
	        }

    	}else{
    		// limit photo size being uploaded
	        if ($image->height > $image->width)
	        {
	            $height = null;
	            $width = $costraint;
	        }
	        else
	        {
	            $height = $costraint;
	            $width = null;
	        }

    	}
    
                
        if ($costraint < $image->height || $costraint < $image->width)
        {
            $image->resize($width, $height);
        }
        

        // for yahoo images
        if(strpos($path,"?") !== false){
        	$arrpath =explode("?",$path);
        	$path = $arrpath[0];
        }
        
        $image->save($path);
        
        $this->result['path'] = $path;
        
        return $this;
    }
	
	public function fixsize($width, $height, $name = null, $file_prefix = '')
    {
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }

        $path = $this->_get_path($name, $file_prefix);
        $image = \Image::factory($this->result['path']);
    	
        $image->resize($width, $height,  \Image::NONE);
        
        // for yahoo images
        if(strpos($path,"?") !== false)
		{
        	$arrpath =explode("?",$path);
        	$path = $arrpath[0];
        }
        
        $image->save($path);
        
        $this->result['path'] = $path;
        
        return $this;
    }

    public function crop($width, $height, $name = NULL, $file_prefix = '', $offset_x = NULL, $offset_y = NULL)
    {
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }

        $path = $this->_get_path($name, $file_prefix);
        $image = \Image::factory($this->result['path']);

        if($offset_x==NULL && $offset_y==NULL){
            $image_radio = $image->width / $image->height;
            $goal_radio = $width / $height;

            if ($image_radio > $goal_radio)
            {
                $tmp_height = $height;
                $tmp_width = null;
            }
            else
            {
                $tmp_height = null;
                $tmp_width = $width;
            }
            if ($tmp_height < $image->height || $tmp_width < $image->width)
            {
                $image->resize($tmp_width, $tmp_height);
            }
        }
        $image->crop($width, $height, $offset_x, $offset_y);
        $image->save($path);

        $this->result['path'] = $path;
        return $this;
    }
    
    public function s3_send($bucket)
    {
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }
        
        $path =  $this->result['path'];
        
        $s3 = \KoAS3::instance()->bucket($bucket);
        $response = $s3->copy($path);
        return $this->respond($response->header, $response->isOk());
    }

    private function _get_path($name = null, $file_prefix = ''){
        $path = $this->result['path'];
        $file = pathinfo($path);
        
        if (Service_Upload::NAME_RANDOM == $name)
        {
            $name = md5($file['filename'] . time()) . '.' . $file['extension'];
            $path = TEMP_FOLDER . DIRECTORY_SEPARATOR . $name;
        }
        elseif (!empty($name))
        {
            $path = TEMP_FOLDER . DIRECTORY_SEPARATOR . $name . '.' . $file['extension'];
        }
        
        if (!empty($file_prefix))
        {
            $path = TEMP_FOLDER . DIRECTORY_SEPARATOR . $file_prefix . $file['basename'];
        }
        return $path;
    }

    public function resize_and_crop($width, $height, $name = NULL, $file_prefix = '', 
                                        $crop_w = NULL, $crop_h = NULL, $offset_x = NULL, $offset_y = NULL)
    {
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }

        $path = $this->_get_path($name, $file_prefix);
        $image = \Image::factory($this->result['path']);

        //if($offset_x==NULL && $offset_y==NULL){
            $image_ratio = $image->width / $image->height;
            $goal_ratio = $width / $height;

            if ($image_ratio > $goal_ratio)
            {
                $height < $image->height && $image->resize(null, $height);
            }
            else
            {
                $width < $image->width && $image->resize($width, null);
            }
        //}
        $image->crop_white($crop_w?:$width, $crop_h?:$height, $offset_x, $offset_y);
        $image->save($path);

        $this->result['path'] = $path;
        return $this;
    }

    public function save_as($name = '', $file_prefix = ''){
        if (false === $this->status || 'file' !== $this->result['object'])
        {
            return $this;
        }
        $path = $this->_get_path($name, $file_prefix);
        $image = \Image::factory($this->result['path']);
        $image->save($path);
        $this->result['path'] = $path;
        return $this;
    }
}
