<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Login extends Controller_Layout {
	public function action_index()
	{
		$this->layout->page = 'login';
		if(strtolower($this->request->method()) == "post"){
			$result = $this->login();
			if(!empty($result["status"])){
				$this->request->redirect($result["redirect"]);
			}else{
				$this->layout->body->message = "Invalid Username / Password.";
			}
		}
		
	}

	public function login()
	{
	    $auth = \Auth::instance();
	    $session = \Session::instance();
	    $islogin = false;  $form = $this->request->post();
	    
	    $response = array(
	        'status' => false,
	        'form' => $form,
	        'islogin' => false,
	    );
	    
	    if (empty($form["email"]) and empty($form["password"] ))
	    {
	        if (!empty($form['signupsuccess']))
	        {
	            $response['signupsuccess'] = 1;
	        }
	        return $response;
	    }
	    
	
	    $response['islogin'] = $auth->login((!empty($form['email']) ? $form['email'] : ""), (!empty($form['password']) ? $form['password'] : ""), true);
	    
	  
	    
	    if ($auth->logged_in())
	    {	
	    	$user = $auth->get_user();
	    	
	    	if($user->is_active == "1"){
				return array('status' => true, 'redirect' => "/profile");
			}

	        return array('status' => true, 'redirect' => false === strpos($this->destination, "logout") ? $this->destination: '/default');
	    }
	    
	    return $response;
	}
	
} // End Welcome
