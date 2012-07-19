<?php
class Company_Model_User extends Model_Auth_User
{
	protected $_table_name = 'users';

	const DEFAULT_PHOTO = 'https://s3-ap-southeast-1.amazonaws.com/site-assets2/images/common/profile-full.gif';
	const DEFAULT_THUMB = 'https://s3-ap-southeast-1.amazonaws.com/site-assets2/images/common/profile-50x50.gif';
	
	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('min_length', array(':value', 8)),
				array('max_length', array(':value', 35)),
				array(array($this, 'username_available'), array(':validation', ':field')),
			),
			'password' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('min_length', array(':value', 8)),
				array('max_length', array(':value', 255)),
				array('email'),
				array(array($this, 'email_available'), array(':validation', ':field')),
			)
		);
	}
	
	
	public function get_displayname()
	{

		if(!$this->loaded()){
			return "Somebody";
		}
		
		$data = $this->as_array();
		
		if(!empty($this->display_name)){
			return $this->display_name;
		}
		
		if(!empty($this->full_name)){
			return ucwords($this->full_name);
		}
		
		if(!empty($this->first_name)){
			return ucwords($this->first_name);
		}
		
		if(!empty($this->last_name)){
			return ucwords($this->last_name);
		}
		
		if(!empty($this->username)){
			return ucwords($this->username);
		}
	}
	
	
	public function get_full_name()
	{
		if(!$this->loaded()){
			return "Somebody";
		}
		
		$data = $this->as_array();
		
		if(!empty($data["full_name"])){
			return ucwords($data["full_name"]);
		}
		
		if(!empty($data["first_name"])){
			return ucwords($data["first_name"]);
		}
		
		if(!empty($data["last_name"])){
			return ucwords($data["last_name"]);
		}
		
		if(!empty($data["username"])){
			return ucwords($data["username"]);
		}
	}
	
	
	public function get_feeds(){
		$cache = Database_Query::$cache; 
		$entities = $this->followee_entity_ids;
		$entities[] = $this->entity_id;


		$entities = array_unique(array_merge(array("0"),$entities));
		$entities = array_filter($entities, 'strlen');
		$entities = array_diff($entities,$this->_get_block_users());
		$entities = array_splice($entities,0,2000);

		$message_i_sent = orm::factory("recent")
						->where("media_type_id","in",\Model_Company_Message::$_user_generated_content)
						->where("id","not in",$this->_get_block_messages())
						->where("receiver_entity_id","in",$entities)
						->where("receiver_entity_id","=",\db::expr("sender_entity_id"))
						->cached(\Date::DAY)
						->order_by("date_added","desc");

		return $message_i_sent;
	}
	
	
	
	private function _get_block_messages(){
		return array(0);
	}
	
	
	private function _get_block_users(){
		return array(0);
	}
	
	
	
	
	public function get_thumb()
	{
		if(!$this->loaded()){
			return self::DEFAULT_THUMB;
		}
		
		if(empty($this->image_url)){
			return self::DEFAULT_THUMB;
		}
		
		
		return S3_URI . S3_BUCKET_PROFILE_PHOTO . "/thumb_" . $this->image_url;
	}
	
	public function get_followee_entity_ids(){
		if(!$this->loaded()){
			return array(0);
		}
	
		$followee_entity_ids = \DB::select('followee_entity_id')
						->from(ORM::factory('entityfollow')->_table_name())
						->where("follower_entity_id","=",$this->entity_id)
						->cached(\DATE::DAY)
						->execute()
						->as_array();
	
		$followee_entity_ids = \orm::array_value_recursive("followee_entity_id",$followee_entity_ids);
		$followee_entity_ids = !empty($followee_entity_ids) ? (is_array($followee_entity_ids) ? $followee_entity_ids : array($followee_entity_ids)) : array(0);
		
		return $followee_entity_ids;
	}
	
	
		
	public function get_follower_entity_ids(){
		if(!$this->loaded()){
			return array(0);
		}
	
		$follower_entity_ids = \DB::select('follower_entity_id')
						->from(ORM::factory('entityfollow')->_table_name())
						->where("followee_entity_id","=",$this->entity_id)
						->cached(\DATE::DAY)
						->execute()
						->as_array();
	
		$follower_entity_ids = \orm::array_value_recursive("follower_entity_id",$follower_entity_ids);
		$follower_entity_ids = !empty($follower_entity_ids) ? (is_array($follower_entity_ids) ? $follower_entity_ids : array($follower_entity_ids)) : array(0);
		
		return $follower_entity_ids;
	}
	
	public function get_people_who_follows_me()
    {
		return ORM::factory('user')->where("entity_id","in",$this->follower_entity_ids)->cached(\Date::DAY);
	}
	
	public function get_people_im_following()
    {
		return ORM::factory('user')->where("entity_id","in",$this->followee_entity_ids)->cached(\Date::DAY);
	}
	
	public function get_info()
    {
        return ORM::factory('user_info')->cached(\Date::DAY)->where('id', '=', $this->id)->find();
    }
	
	public function get_photo()
	{
		if(!$this->loaded()){
			return self::DEFAULT_PHOTO;
		}
		
		if(empty($this->image_url)){
			return self::DEFAULT_PHOTO;
		}
		
		
		return S3_URI . S3_BUCKET_PROFILE_PHOTO . "/" . $this->image_url;
	}



	public function get_link()
    {
    	if($this->loaded()){
    		return "/profile/feeds/" . $this->id;
    	}
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
			$this->date_last_login = \db::expr("now()");
			$this->save();
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
			$invite = \orm::factory("invite")
							->where("receiver_emaill","=",$user->email)
							->where("client_id","=",$client->id)
							->where("token","=",!empty($form["token"]) ? $form["token"] : "")
							->find();
			
			if(!$invite->loaded()){
				return false;
			}

			
			$client = \orm::factory("client")->detect();
			
			$entity = orm::factory("entity");
			$entity->type_id = \Model_Entity::TYPE_USER; 
			$entity->client_id = $client->id; 
			$entity->save();
			
			
			$user = orm::factory("user");
			$user->email = !empty($form["email"]) ? $form["email"] : "";
			$user->password = !empty($form["password"]) ? $form["password"] : "";
			$user->department_id = !empty($form["department_id"]) ? $form["department_id"] : "";
			$user->client_id = $client->id;
			$user->display_name = !empty($form["display_name"]) ? $form["display_name"] : "";

			$user->full_name = !empty($form["full_name"]) ? $form["full_name"] : "";
			$user->first_name = !empty($form["first_name"]) ? $form["first_name"] : "";
			$user->last_name = !empty($form["last_name"]) ? $form["last_name"] : "";

			$user->image_url = !empty($form["image_url"]) ? $form["image_url"] : "";
			$user->slug = !empty($form["slug"]) ? $form["slug"] : "";
			$user->is_active = 1;
			$user->date_last_login = \db::expr("now()");
			$user->entity_id = $entity->id;
			$user->save();
			
			$role = orm::factory("role_user");
			$role->user_id = $user->id;
			$role->role_id = 1;
			$role->save();

			$userinfo = \orm::factory("user_info");
			$userinfo->id = $user->id;
			$userinfo->entity_id = $entity->id;
			$userinfo->role_id= 2;
			$userinfo->gender= !empty($form["gender"]) ? $form["gender"] : "0";
			$userinfo->save();
			
			$invite->receiver_entity_id =  $entity->id;
			$invite->status = 1;
			$invite->save();
			
			
			
			
			//auto follow the person who invited you; and vice versa
			\orm::factory("entityfollow")->follow($entity->id,$invite->sender_entity_id);
			\orm::factory("entityfollow")->follow($invite->sender_entity_id,$entity->id);		
			
			$loggedin = $this->force_logged_in($user,false);
			
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
