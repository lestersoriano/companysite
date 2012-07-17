<?php
class Service_Edit extends Service_Upload
{
    public function save_url_to_file($url)
    {
    	$url = str_replace("https://","",$url);
    	$url = str_replace("http://","",$url);
    	$url = str_replace("//","/",$url);
    	$url = "http://" . $url;
    	
        $f = @fopen($url, 'r');
        if(!$f)
        {
       	    return $this->respond(array('object' => 'file', 'path' => $url), false);
        }
        
        $pathinfo = pathinfo($url);
        
        
        $filename = !empty($pathinfo['filename']) ? $pathinfo['filename'] : '';
        $ext = !empty($pathinfo['extension']) ? $pathinfo['extension'] : '';

        $target = fopen(TEMP_FOLDER . $filename . '.' . $ext, "w");            
        stream_copy_to_stream($f, $target);
        fclose($f);
        fclose($target);

        return $this->respond(array('object' => 'file', 'path' => TEMP_FOLDER.$filename.'.'.$ext), true);
    }
}
