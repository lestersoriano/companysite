<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Logout extends Controller_Layout {

	public function action_index()
	{
		$this->auto_render = false;
		
		$session = \Session::instance();

		$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';

		$referer = strtolower($referer);

		if(strpos($referer, "logout") !== false){
		   	$referer = "/profile/feeds";
		}

	    $auth = \Auth::instance();
        if ($auth->logged_in())
        {

			$user = $auth->get_user();
			$loggedin = $auth->logout(true);
			
			
			// destroy all session;
			$session = \Session::instance();
			$session->destroy();

			$this->request->redirect($referer);
        }else{
			$this->request->redirect($referer);
		}

	}
	
	
	public function before()
    {
       $this->auto_render = false;
    }

	
} // End Welcome
