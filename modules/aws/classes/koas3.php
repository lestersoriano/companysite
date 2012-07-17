<?php defined('SYSPATH') or die('No direct access allowed.');

class KoAS3
{
    public static $config;
    
    public $ec2 = null;
    
    public $s3 = null;
    
    public $bucket = null;
    
    public $filename = null;
    
    
    public static function instance()
    {
        return new KoAS3(KoAS3::$config->key, KoAS3::$config->secret_key);
    }
    
    public function __construct($key, $secret_key)
    {
        $this->s3 = new AmazonS3($key, $secret_key);
        //$this->ec2 = new AmazonEC2($key, $secret_key);
    }
    
    public function bucket($buket)
    {
        $this->bucket = $buket;
        
        return $this;
    }
    
    public function copy($file_from, $file_to = null, $acl = AmazonS3::ACL_PUBLIC, $options = array())
    {
        $params = array(
                'headers' => array(
                    'Cache-Control' => 'max-age=29030400, public',
                )
            );
        $params = array_merge($params, $options);
        
        $params['fileUpload'] = $file_from;
        $params['acl'] = $acl;
        
        if (empty($file_to))
        {
            $file_to = pathinfo($file_from);
            $file_to = $file_to['basename'];
        }
        $this->filename = $file_to;
        
        return $this->s3->create_object($this->get_bucket(), $this->get_folder().$file_to, $params);
    }
    
    public function get_last_object_url() {
        return $this->s3->get_object_url($this->get_bucket(), $this->get_folder().$this->filename);
    }

    private function get_bucket(){
        $pos = strpos($this->bucket, '/');
        if (false !== $pos)
        {
            return substr($this->bucket, 0, $pos);
        }
        return '';
    }

    private function get_folder(){
        $pos = strpos($this->bucket, '/');
        if (false !== $pos)
        {
            return substr($this->bucket, $pos+1);
        }
        return '';
    }

    public function batch_delete(array $files) {
        foreach ($files as $file) {
            $this->s3->batch()->delete_object($this->get_bucket(), $this->get_folder() . $file);
        }
        $file_delete_response = $this->s3->batch()->send();
        if ($file_delete_response->areOK()) {
            return true;
        }
        return false;
    }
}
