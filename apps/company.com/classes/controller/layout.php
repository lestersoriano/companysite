<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Layout extends Controller_Template_Layout
{
	 /**
     * @var  boolean  auto render template
     */
    public $auto_render = TRUE;
    
    /**
     * Path of the contents container folder relative to the view folder.
     */
    public $content_path = 'content';
    
    /**
     * template template file
     */
    public $template = 'template/default';
    
    /**
     * header template file
     */
    public $header = 'template/header';
	
    /**
     * footer template file
     */
    public $footer = null;

    /**
     * layout object
     */
    public $layout = null;


	public $user = null;

    public function before()
    {
        parent::before();
        
        // Just in case the whole controller does not need rendiring.
        if ($this->auto_render !== TRUE)
        {
            return true;
        }
        
        $controller = $this->request->controller();
        $action = $this->request->action();
        
        
        $body = $this->content_path . DIRECTORY_SEPARATOR . $controller . DIRECTORY_SEPARATOR . $action;
        
        // Create content layout depending on the controller and action.
        $this->layout = Layout::factory($this->template, $body);
        
        $auth = \Auth::instance();
        
        // the following can also be manually called in the action method.
        if (!empty($this->header))
        {
            $this->layout->set_header($this->header);
            if($auth->logged_in()){
            	$this->user = $auth->get_user();

               	$notification = View::factory("template/notification");
            	$notification->user =  $this->user;           	
            	$this->layout->header->notification = (string)$notification; 
            	
            	$dropdown = View::factory("template/dropdown");
            	$dropdown->user =  $this->user;
            	$this->layout->header->dropdown = (string) $dropdown;
            }
            
        }
       
        
        if (!empty($this->footer))
        {
            $this->layout->set_footer($this->footer);
        }
    }

} // End Welcome
