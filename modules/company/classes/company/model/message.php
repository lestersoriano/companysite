<?php 
class Company_Model_Message extends ORM
{
	protected $_table_name = 'messages';
	
	const MAX_WEIGHT = 770;
	const MAX_AFFINITY = 32767;
	const MAX_TIME_DECAY = 100;
	
	const MEDIA_TYPE_JOINED = 1;
	const MEDIA_TYPE_STATUS = 2;
	const MEDIA_TYPE_VIDEO = 3;
	const MEDIA_TYPE_LINK = 4;
	const MEDIA_TYPE_PHOTO = 5;
	const MEDIA_TYPE_LIKE = 6;
	const MEDIA_TYPE_COMMENT = 7;
	const MEDIA_TYPE_GIFT = 8;
	const MEDIA_TYPE_PM = 9;
	const MEDIA_TYPE_PROFILEPHOTO = 10;
	const MEDIA_TYPE_FOLLOW = 11;
	const MEDIA_TYPE_ACHIEVE = 12;
	const MEDIA_TYPE_POLL = 13;
	const MEDIA_TYPE_FILE = 14;
	const MEDIA_TYPE_QUESTION = 15;
	const MEDIA_TYPE_PRAISE = 16;
	const MEDIA_TYPE_EVENT = 17;
	const MEDIA_TYPE_JOIN_GROUP = 18;
	
	const ENTITY_TYPE_USER = 1;
	const ENTITY_TYPE_PAGE = 4;
    
    
    protected static $structure = array();


	protected static $weight = array(self::MEDIA_TYPE_STATUS=>"1",
									 self::MEDIA_TYPE_PHOTO=>"2",
									 self::MEDIA_TYPE_LINK=>"3",
									 self::MEDIA_TYPE_VIDEO=>"4"
                                     );

	protected static $_attachment = array(
		self::MEDIA_TYPE_STATUS => 	null,
		self::MEDIA_TYPE_PHOTO =>	'photo',
		self::MEDIA_TYPE_LINK	=> 'link',
		self::MEDIA_TYPE_VIDEO => 'video'
	);

	public static $_user_generated_content = array(
		self::MEDIA_TYPE_STATUS,
		self::MEDIA_TYPE_PHOTO,
		self::MEDIA_TYPE_LINK,
		self::MEDIA_TYPE_VIDEO
	);
	
	public static $_activities_messages = array(

	);
	
	protected static $_template = array(
		self::MEDIA_TYPE_JOINED=>'simple',
		self::MEDIA_TYPE_STATUS=>'default',
		self::MEDIA_TYPE_VIDEO=>'video',
		self::MEDIA_TYPE_LINK=>'link',
		self::MEDIA_TYPE_PHOTO=>'photo',
		self::MEDIA_TYPE_LIKE=>'like',
		self::MEDIA_TYPE_GIFT=>'gift',
		self::MEDIA_TYPE_PROFILEPHOTO=>'profilephoto',
		self::MEDIA_TYPE_FOLLOW=>'follow',
		self::MEDIA_TYPE_ACHIEVE=>'achieve',
		self::MEDIA_TYPE_POLL=>'polls',
		self::MEDIA_TYPE_QUESTION=>'question',
		self::MEDIA_TYPE_PRAISE=>'praise',
		self::MEDIA_TYPE_EVENT=>'event',
		self::MEDIA_TYPE_JOIN_GROUP=>'join'		
	);

	const PREFIX_THUMB = 'thumb_';
	const PREFIX_PREVIEW = 'preview_';
	
	public function __construct($id = null)
	{
		parent::__construct($id);

		if (empty(self::$structure))
		{
			$config = Kohana::$config->load('message');
			self::$structure = $config->structure['default'];
		}

	}
	
	
	protected $_user = null;
    
    public function user($user = false)
    {
        if (false === $user)
        {
            return $this->_user;
        }
        
        $this->_user = $user;
        return $this;
    }
    
   
	
	public function get_user(){
		
		if (empty($this->__caches['sender']))
		{
			$entity = ORM::factory('entities')->where("id","=",$this->sender_entity_id)->cached(\date::DAY)->find();
			switch($entity->type_id)
			{
				case self::ENTITY_TYPE_PAGE:
					return $this->__caches['sender'] = orm::factory("page")->where("entity_id","=",$this->sender_entity_id)->cached(\date::DAY)->find();
					break;
				case self::ENTITY_TYPE_USER:	
					return $this->__caches['sender'] = orm::factory("user")->where("entity_id","=",$this->sender_entity_id)->cached(\date::DAY)->find();
					break;
				default:
					return $this->__caches['sender'] = orm::factory("user")->where("entity_id","=",$this->sender_entity_id)->cached(\date::DAY)->find();
			}
		}
		
		return $this->__caches['sender'];
	}
	
	public function get_receiver(){
		if (empty($this->__caches['receiver']))
		{
			$entity = ORM::factory('entities')->where("id","=",$this->receiver_entity_id)->cached(\date::DAY)->find();
			switch($entity->type_id)
			{
				case self::ENTITY_TYPE_PAGE:
					return $this->__caches['receiver'] = orm::factory("page")->where("entity_id","=",$this->receiver_entity_id)->cached(\date::DAY)->find();
					break;
				case self::ENTITY_TYPE_USER:	
					return $this->__caches['receiver'] = orm::factory("user")->where("entity_id","=",$this->receiver_entity_id)->cached(\date::DAY)->find();
					break;
				default:
					return $this->__caches['receiver'] = orm::factory("user")->where("entity_id","=",$this->receiver_entity_id)->cached(\date::DAY)->find();
			}
		}
		
		return $this->__caches['receiver'];
	}

	public function is_liked(){
		if(empty($this->_user)){
			return false;
		}
	
		if($this->loaded()){
 			return orm::factory("like")
 						->where("ref_table","=","messages")
 						->where("object_id","=",$this->id)
 						->where("entity_id","=",$this->_user->entity_id)
 						->cached(\date::DAY)
 						->find()
 						->loaded();
		}else{
			return false;
		}
	}


	public function liked(){
	
		if(empty($this->_user)){
			return false;
		}
	
		
		$like = orm::factory("like")
				->cached(\date::DAY)
				->where("object_id","=",$this->id)
				->where("entity_id","=",$this->_user->entity_id)
				->find();


		if($like->loaded()){
			$like->delete();
			$like_count = orm::factory("like")
								->where("ref_table","=",$this->_table_name())
								->where("object_id","=",$this->id)
								->cached(\date::DAY)
								->count_all();
			$this->like_count = $like_count;
			$this->save();

			return false;
		}else{

			$like = orm::factory("like");
			$like->object_id=$this->id;
			$like->ref_table=$this->_table_name();
			$like->entity_id=$this->_user->entity_id;
			$like->save();


			$like_count = orm::factory("like")
								->where("ref_table","=",$this->_table_name())
								->where("object_id","=",$this->id)
								->cached(\date::DAY)
								->count_all();
								
			$this->like_count = $like_count;
			$this->save();

			
			// add notification code here
			
			// ad this message to watch list
			
			return true;
		}
	}


	

	public function get_link(){
		if($this->loaded()){
			return "/profile/message/" . $this->id;
		}else{
			return "/profile/feeds/";
		}

	}


	public function get_comment(){
        return orm::factory("message")
	                ->where("parent_id","=",$this->id)
	                ->cached(\DATE::DAY);
	}
	
	public function delete(){
	
		$messages = \DB::delete('recent_messages');
		$messages->where("parent_id","=",$this->id);
		$messages->execute();

		$messages = \DB::delete('recent_messages');
		$messages->where("id","=",$this->id);
		$messages->execute();
	
		$likes = \DB::delete('likes');
		$likes->where("object_id","=",$this->id);
		$likes->execute();
		
		$messages = \DB::delete('messages');
		$messages->where("parent_id","=",$this->id);
		$messages->execute();
		
		$id = $this->id;
		$parent_id = $this->parent_id;
		$ref_table = $this->ref_table;
		
		$object = parent::delete();

		return $object;
	}
	
	public function save(Validation $validation = NULL)
	{

		// validation
		if($this->sender_entity_id == 0 and $this->receiver_entity_id == 0){
			return $this;
		}
		
		// validation
		
		if($this->media_type_id == self::MEDIA_TYPE_STATUS and strlen(trim($this->message)) == 0){
			return $this;
		}
	
		if($this->media_type_id == self::MEDIA_TYPE_COMMENT){
			$comment_count = \DB::select(\db::expr('count(id) as count'))
									->from("messages")
									->where("parent_id","=",$this->parent_id)
									->execute()
									->cached(\Date::HOUR)
									->as_array();	
									
			$comment_count = array_pop($comment_count);
			$this->comment_count = !empty($comment_count["count"]) ? $comment_count["count"] : $this->comment_count;
			
		}else
		{
	    	$this->date_modified = \db::expr("now()");
		}

		$this->weight = (!empty(self::$weight[$this->media_type_id]) ? self::$weight[$this->media_type_id] : 0);
		
		
		$client = \orm::factory("domain")->detect();

		$this->client_id = empty($this->client_id) ? $client->id : $this->client_id;
		
		
		$object = parent::save($validation);
		
		\db::update("recent_messages")
						->set(array("message"=>$this->message))
						->set(array("status"=>$this->status))
						->set(array("weight"=>$this->weight))
						->set(array("like_count"=>$this->like_count))
						->set(array("comment_count"=>$this->comment_count))
						->set(array("share_count"=>$this->share_count))
						->set(array("date_modified"=>$this->date_modified))
						->where("id","=",$this->id)
						->execute();
		
		return $object;
    }
       
		
	
	public function get_json_data($is_assoc = false)
	{
		$data = json_decode($this->details, true);
		return $data;
	}


		

    public function save_protected(Validation $validation = NULL)
	{
		if($this->receiver_entity_id == 0 and $this->sender_entity_id == 0){
			return $this;
		}
		
		$template_id = '200';
		$post_limit = 3;
    	$time = time();

		
		if(in_array($this->media_type_id, self::$_user_generated_content)){
		
			$last_post = orm::factory("message")
						->where("receiver_entity_id","=",$this->receiver_entity_id)
						->where("sender_entity_id","=",$this->sender_entity_id)
						->where("media_type_id","in",self::$_user_generated_content)
						->order_by('id', 'DESC')
						->find();
			
			$message = orm::factory("message")->order_by('id', 'DESC')->find();
			if($message->loaded()){
				$diff = (integer)$time - (integer)strtotime($message->date_added);
	
		        if($this->sender_entity_id == $message->sender_entity_id and
		        	$this->receiver_entity_id == $message->receiver_entity_id and
		        	$diff < $post_limit){
		            return false;
		        }
	
	
		        if($this->sender_entity_id == $message->sender_entity_id and
		        	$this->receiver_entity_id == $message->receiver_entity_id and
		        	$this->message == $message->message and
		        	$diff < $post_limit){
		            return false;
		        }
			}
			
			if($last_post->loaded()){
				$diff = (integer)$time - (integer)strtotime($last_post->date_added);
				
				if($diff < (\Date::MINUTE * 5)){
					$cache = \Database_Query::$cache;
	
					$token = sha1($this->receiver_entity_id . $this->sender_entity_id);
					if (false === ($show_captcha = $cache->get($token, false)))
			        {
			            $cache->set($token, "1", \Date::MINUTE);
			        }
				}
			}
		}

        $this->like_count = !empty($this->like_count) ?  $this->like_count : 0;
        $this->share_count = !empty( $this->share_count) ?  $this->share_count : 0;
        $this->comment_count = !empty($this->comment_count) ? $this->comment_count : 0;

        $this->save();
                
        
        
        if($this->media_type_id != 5){
        	$columns = array_keys($this->_table_columns);
			$archives_message = \DB::INSERT('recent_messages',$columns);
			if(!\orm::factory("recent")->where("id","=",$this->id)->cached(\DATE::DAY)->find()->loaded())
			{
				$message = $this->as_array();
				$archives_message->values(array_values($message));
				$archives_message->execute();
			}
        }

  		// not a comment or a gift
 		if(in_array($this->media_type_id, array(self::MEDIA_TYPE_STATUS,
												self::MEDIA_TYPE_PHOTO,
												self::MEDIA_TYPE_LINK,
												self::MEDIA_TYPE_VIDEO)))
 		{
			// notity the reciever if the receiver is not you;
						
			return $this;
		}else{
			// notity the owner of the post and all of the people who posted on this message;
			return $this;
		}

								
		
		return $this;

    }

	public function get_attachment_type()
	{
		return empty(self::$_attachment[$this->media_type_id])? null: self::$_attachment[$this->media_type_id];
	}
	
	public function get_template_type()
	{
		return empty(self::$_template[$this->media_type_id])? 'default': self::$_template[$this->media_type_id];
	}
	
	public function get_attachment(){
		if(!$this->loaded()){
			return array();
		}

		$attachments = \orm::factory("attachment")->where("message_id","=",$this->id)->find_all()->as_array();
		
		if(empty($attachments)){
			return array();
		}
		
		$cache = Database_Query::$cache;
		
		$token = md5($this->id . "attachment");
		$files = array();
		
		if (false === ($files = $cache->get($token, false)))
		{
			$src = S3_URI . S3_BUCKET_WALL_IMAGES;

			do
			{	
				$attachment = array_pop($attachments);
				
				$files[] = array("type" => $attachment->type,
								 "path" => $src  . "/" . $attachment->path,
								 "thumb"=> ($attachment->type == "photo") ?  $src . "/" . self::PREFIX_THUMB . $attachment->path : "");
				
			}while(!empty($attachments));
			
			$cache->set($token, $files, \DATE::MONTH);
		}
		
		return !empty($files) ? $files : array();
	}

	public function postmessage($sender,$receiver,$type="status",$parameters=array()){
		if($type == "")
		{
			$type = "status";
		}
		
		$required_keys = array("comment"=>array("message","parent_id"),
							   "status"=>array("message"),
							   "video"=>array("message","link","title","description","icon"),
							   "photo"=>array("media"),
							   "link"=>array("message","link","title","description","icon"),
							   "others"=>array("message","link","title","description","icon"));

		$keys = array_keys($parameters); 

		if(!array_key_exists($type, $required_keys)){
			throw new \Kohana_Exception('Model `Message` Invalid post type "' . $type . '", valid post type are ' . implode(",", array_keys($required_keys)) . '.', null, 500);
		}
		
		$required_keys = $required_keys[$type];
		foreach($required_keys as $key){
			if(!array_key_exists($key, $parameters)){
				throw new \Kohana_Exception('Model `Message` Invalid parameters for type ' . $type . ', required fields are ' . implode(", ", $required_keys) . '.', null, 500);
			}
		}

		if(!is_object($receiver)  and $type != "comment"){
			throw new \Kohana_Exception('Model `Message` receiver not a object.', null, 500);
		}
		
		if(!is_object($sender)){
			throw new \Kohana_Exception('Model `Message` sender not a object.', null, 500);
		}
		
		if(!$sender->loaded()){
			throw new \Kohana_Exception('Model `Message` sender not loaded.', null, 500);
		}
		
		if(!$receiver->loaded() AND $type != 'comment'){
			throw new \Kohana_Exception('Model `Message` receiver not loaded.', null, 500);
		}

		$parameters["type"]=$type;
		
		return $this->post($sender,$receiver,$parameters);
	}
	
	
	private function post($sender,$receiver,$parameters){

		$details = self::$structure;
		
		$this->domain_id = (!empty($parameters["domain_id"]) ? $parameters["domain_id"] : \orm::factory("domain")->current);
		$this->parent_id = (!empty($parameters["parent_id"]) ? $parameters["parent_id"] : 0);
		$this->game_id = (!empty($parameters["game_id"]) ? $parameters["game_id"] : 0);
		$this->sender_entity_id = $sender->entity_id;
		$this->receiver_entity_id =  $receiver->entity_id;
		$this->message = !empty($parameters["message"]) ? $parameters["message"] : "";
		$this->ref_table = !empty($parameters["ref_table"]) ? $parameters["ref_table"] : "messages";
		
		$value=1;


		$keys = array_keys($details); 
		do{
			$key = array_shift($keys);	$details[$key] = !empty($parameters[$key]) ? $parameters[$key] : "";
		}while(!empty($keys));
		
		switch($parameters["type"]){
			case "join": 			$this->media_type_id = self::MEDIA_TYPE_JOINED; break;
			case "status": 			$this->media_type_id = self::MEDIA_TYPE_STATUS; break;
			case "video": 			$this->media_type_id = self::MEDIA_TYPE_VIDEO; break;
			case "link": 			$this->media_type_id = self::MEDIA_TYPE_LINK; break;
			case "photo": 			$this->media_type_id = self::MEDIA_TYPE_PHOTO; break;
			case "like": 			$this->media_type_id = self::MEDIA_TYPE_LIKE; break;
			case "comment": 		$this->media_type_id = self::MEDIA_TYPE_COMMENT; break;
			case "gift": 			$this->media_type_id = self::MEDIA_TYPE_GIFT; break;
			case "pm": 				$this->media_type_id = self::MEDIA_TYPE_PM; break;
			case "profilephoto": 	$this->media_type_id = self::MEDIA_TYPE_PROFILEPHOTO; break;
			case "follow": 			$this->media_type_id = self::MEDIA_TYPE_FOLLOW; break;
			case "achieve": 		$this->media_type_id = self::MEDIA_TYPE_ACHIEVE; break;
			case "poll": 			$this->media_type_id = self::MEDIA_TYPE_POLL; break;
			case "question": 		$this->media_type_id = self::MEDIA_TYPE_QUESTION; break;
			case "praise": 			$this->media_type_id = self::MEDIA_TYPE_PRAISE; break;;
			case "event": 			$this->media_type_id = self::MEDIA_TYPE_EVENT; break;
			case "group": 			$this->media_type_id = self::MEDIA_TYPE_JOIN_GROUP; break;
		}

		$this->details = json_encode($details);
		$this->save_protected();
		
		if(!empty($parameters["attachment"])){
			\orm::factory("attachment")->attach_files($this->id,$parameters["attachment"]);
		
		}
		
		
		
		return $this->saved() ? $this : false;
	}
	
	

}
