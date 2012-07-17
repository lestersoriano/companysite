<?php defined('SYSPATH') or die('No direct access allowed.');

class Service {
    
    protected $status;
    
    protected $result;
    
    const PREFIX = 'Service_';
    
    public static function factory($name)
    {
        $name = strtolower($name);
        
        $reflection = new ReflectionClass(Service::PREFIX . $name);
        
        $class = $reflection->newInstanceArgs();
        
        return $class;
    }
    
    public function __toString()
    {
        return json_encode(
            array(
                'status' => $this->status,
                'result' => $this->result
            )
        );
    }
    
    public function result()
    {
        return $this->result;
    }
    
    public function status()
    {
        return $this->status;
    }
    
    protected function respond($result, $status = true)
    {
        $this->result = $result;
        $this->status = $status;
        return $this;
    }
}