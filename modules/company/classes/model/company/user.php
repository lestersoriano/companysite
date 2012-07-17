<?php
class Model_Company_User extends Model_Auth_User
{
	const DEFAULT_PHOTO = 'https://s3-ap-southeast-1.amazonaws.com/site-assets2/images/common/profile-full.gif';
	const DEFAULT_THUMB = 'https://s3-ap-southeast-1.amazonaws.com/site-assets2/images/common/profile-50x50.gif';
	
	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('min_length', array(':value', 6)),
				array('max_length', array(':value', 35)),
				array(array($this, 'username_available'), array(':validation', ':field')),
			),
			'password' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('min_length', array(':value', 4)),
				array('max_length', array(':value', 255)),
				array('email'),
				array(array($this, 'email_available'), array(':validation', ':field')),
			),
		);
	}

	// This class can be replaced or extended

	/**
	 * Complete the login for a user by incrementing the logins and saving login timestamp
	 *
	 * @return void
	 */
	public function complete_login()
	{
		if ($this->_loaded)
		{
			
		}
	}
	
	
	public function build($form);
	{
		$post = Validation::factory($form);
			
		$rules = $this->rules();
		
		foreach($rules as $field => $rule){
			$post->rules($field, $rule);
		}
		
		
		if($post->check()){
			$client = \orm::factory("client")->detect();
		
			$user = orm::factory("user");
			$user->username = !empty($form["email"]) ? $form["email"] : "";
			$user->email = !empty($form["email"]) ? $form["email"] : "";
			$user->password = !empty($form["password"]) ? $form["password"] : "";
			$user->client_id = $client->id;
			$user->full_name = !empty($form["full_name"]) ? $form["full_name"] : "";
			$user->first_name = !empty($form["first_name"]) ? $form["first_name"] : "";
			$user->last_name = !empty($form["last_name"]) ? $form["last_name"] : "";
			$user->image_url = !empty($form["image_url"]) ? $form["image_url"] : "";
			$user->slug = !empty($form["slug"]) ? $form["slug"] : "";
			$user->is_active = 1;
			$user->date_last_login = \db::expr("now()");
			$user->save();
			
		}
		
	}
	
	
	
	public function save(Validation $validation = NULL)
	{
		if(empty($this->_changed['email'])){
			$this->username = $this->email;
		}

		$object = parent::save($validation);
		
		
		return $object;
    }
    

	
	/**
     * Check email exists or not
     *
     * @param string $email
     * @return boolean
     * @access public
     */
    public function get_email_exists($email)
    {
        $this->clear();
        return $this->where('email', '=', $email)->find()->loaded();
    }
}
