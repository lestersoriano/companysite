<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Layout extends Controller_Template_Layout
{
	public $user = null;
	public $footer = null;
	public $destination = "";
	
    public function before()
    {
       $this->_check_access();
       
       parent::before();
       $auth = auth::instance();
       if($auth->logged_in())
       {
           	$this->user = $auth->get_user();
			$this->layout->header->user = $this->user;
			
            $notification = View::factory("template/notification");
            $notification->user =  $this->user;           	
            $this->layout->header->notification = (string)$notification; 
            	
            $dropdown = View::factory("template/dropdown");
            $dropdown->user =  $this->user;
            $this->layout->header->dropdown = (string) $dropdown;
       
       }
       $this->layout->header->logged_in = $auth->logged_in();
   	}

   	
   	 private function _check_access()
	 {
		$config = \Kohana::$config->load('pageaccess');
		
		$auth = \Auth::instance();
		
		$controller = strtolower($this->request->controller());
		$action = strtolower($this->request->action());
		
		// forbidden pages.
		$public = \Arr::merge($config['public_only'], $config['public_access']);
		$public = empty($public[$controller]) ? array(): $public[$controller];
		
		// public only.
		$public_only = $config['public_only'];
		$public_only = empty($public_only[$controller]) ? array(): $public_only[$controller];
	          
        $request = !empty($_GET) ? http_build_query($_GET) : "";
        $request = !empty($request) ? ("?" . $request . ((strpos($request, "unreview") === false) ? "&unreview=1" : "")) : "?unreview=1";
		
		$referer = "/" . str_replace("/index","",$this->request->uri()) . $request;
		
		if(strpos($referer,"logout") !== false){
			$referer = "";
		}

		if (!in_array($action, $public) && !$auth->logged_in())
		{
			if( !$this->request->is_ajax() )
			{
				return $this->request->redirect($config['invalid_landing_page'].  (!empty($referer) ? ( '?referer='.urlencode($referer) ) : ""));
			}
		}elseif (in_array($action, $public_only) && $auth->logged_in())
		{
			return $this->request->redirect($config['success_landing_page']);
		}
     }

   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	public function after()
    {
        if ($this->auto_render === TRUE)
        {
            $this->response->body($this->layout);
        }
        
        parent::after();
    }

} // End Welcome
