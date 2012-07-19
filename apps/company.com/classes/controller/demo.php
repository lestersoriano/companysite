<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Demo extends Controller_Layout {
	public $destination = "/demo/success";
	public function action_index()
	{
	
	}
	
	public function action_login()
	{
	
		$form = !empty($_GET) ? $_GET : array();
		$this->login();
	}
	
	public function action_create(){
		$user = orm::factory("user")->create_user(array("username"=>"lestersoriano",
														"password"=>"lss11283",
														"email"=>"lester@matchmove.com"),
												  array('username',
													    'password',
													    'email',
													));
/*
		$user->username = "lestersoriano";
		$user->email = "lestersoriano@yahoo.com";
		$user->password = "lss11283";
		$user->department_id = 1;
		$user->client_id = 1;
		$user->display_name = "frozentech";

		$user->full_name = "lester soriano";
		$user->first_name = "lester";
		$user->last_name = "soriano";

		$user->image_url = "";
		$user->slug = "frozentech";
		$user->is_active = 1;
		$user->date_last_login = \db::expr("now()");
		$user->entity_id = 1;
		$user->save();
*/
	}
	
	  public function login()
       {
            $auth = \Auth::instance();
            $session = \Session::instance();
            $islogin = false;
            $form = !empty($_POST) ? $_POST: $_GET;
            
            $response = array(
                'status' => false,
                'form' => $form,
                'islogin' => false,
            );
            
            if (empty($form["username"]) and empty($form["password"] ))
            {
                if (!empty($form['signupsuccess']))
                {
                    $response['signupsuccess'] = 1;
                }
                return $response;
            }
            

            $response['islogin'] = $auth->login((!empty($form['username']) ? $form['username'] : ""), (!empty($form['password']) ? $form['password'] : ""), true);
            
            if ($auth->logged_in())
            {	
            	$user = $auth->get_user();
            	
            	if($user->is_active != "1"){
					$this->destination = '/demo/failed';
					return array('status' => true, 'redirect' => $this->destination);
				}
		    
				if (isset($_GET['referer']))
                {
                    return array('status' => true, 'redirect' => 'admin');
				}

                return array('status' => true, 'redirect' => false === strpos($this->destination, "logout") ? $this->destination: '/games');
		    }
            
            return $response;
        }

} // End Welcome
