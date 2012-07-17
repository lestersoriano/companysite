<?php
class Model_User extends Model_Auth_User
{
	const DEFAULT_PHOTO = 'https://s3-ap-southeast-1.amazonaws.com/site-assets2/images/common/profile-full.gif';
	const DEFAULT_THUMB = 'https://s3-ap-southeast-1.amazonaws.com/site-assets2/images/common/profile-50x50.gif';
	
	const NOT_FRIEND = '1';
	const ALREADY_FRIEND = '2';
	const PENDING_REQUEST = '3';
	const PENDING_REQUEST_TO_ME = '5';
	const LIMIT_REACH = '4';
	const LIMIT_REACH_YOU = '6';
	


	public $global_domain = array();
	

	const MULTIPLIER = 10000; // MULTIPLIER
	const DEFAULT_WEIGHT = 10000; // DEFAULT_WEIGHT
	const DEFAULT_AFFINITY = 10000; // DEFAULT_WEIGHT
	const MESSAGE_EXPIRY = 20160; // (14 * DATE::Minute); 
	//const MESSAGE_EXPIRY = 20; // (14 * DATE::Minute); 

	const TIME_PERCENT = 0.70; // time decay percent
	const AFFINITY_PERCENT = 0.20; // affinity percent
	const WEIGHT_PERCENT = 0.10; // weight percent 

	public function __construct($id = null)
	{
		parent::__construct($id);

		if (empty(self::$global_domain))
		{
			$config = Kohana::config('domain');
			$this->global_domain = $config;
		}

	}



	
	
	
	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('min_length', array(':value', 2)),
				array('max_length', array(':value', 35)),
				array(array($this, 'username_available'), array(':validation', ':field')),
			),
			'password' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('min_length', array(':value', 4)),
				array('max_length', array(':value', 50)),
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
			// Update the number of logins
			//$this->logins = new Database_Expression('logins + 1');

			// Set the last login date
			//$this->last_login = time();
			//$this->is_active = "1";
			// Save the user
			//$this->save();
			\Activity::create(1, $this);

			$info = $this->info;
			$info->date_last_login = date('Y-m-d H:i:s');
			$info->domain_id_last_login = \Orm::factory('domain')->current;
			$info->save();
			
			
			$real_ip = location::get_ip(); 
			$auth = \Auth::instance();
			$auth_3p = $auth->get_3p(); 
            $type = !empty ($auth_3p)?$auth_3p::MODEL:'';
			// dont  use orm to insert login times causes infinte loop.
			$insert = \DB::insert('user_login', array('user_id','ip','logintype', 'domain_id'));
  			$insert->values(array($this->id,(!empty($real_ip) ? $real_ip : $_SERVER["REMOTE_ADDR"]),$type,$info->domain_id_last_login));
			$insert->execute();
			unset($insert);
			
			if(!\orm::factory("feedschedule")->where("user_id","=",$this->id)->find()->loaded()){
				$insert = \DB::insert('feed_schedule', array('user_id','entity_id'));
	  			$insert->values(array($this->id,$this->entity_id));
				$insert->execute();
			}
			
			
			if(!\orm::factory("entities")->where("id","=",$this->entity_id)->find()->loaded()){
				$insert = \DB::insert('entities', array('id','type_id'));
	  			$insert->values(array($this->entity_id,1));
				$insert->execute();
			}
			unset($insert);
			unset($info);
			
			//$this->_init_album();
		}
	}
	
	
	public function _init_album(){
		$cache = Database_Query::$cache;
		$token = md5("_init_album" . $this->entity_id);
		if (false === $cache->get($token, false))
		{
		
			$album_profile = \orm::factory("album")
				->where("user_entity_id","=",$this->entity_id)
				->where("type_id","=",\Model_message::MEDIA_TYPE_PROFILEPHOTO)
				->cached(Date::DAY)
				->find();
			if(!$album_profile->loaded()){
				$album = \orm::factory("album");
				$album->user($this)->_migrate_albums_profile();
			}
		
			$album_profile = \orm::factory("album")
				->where("user_entity_id","=",$this->entity_id)
				->where("type_id","=",\Model_message::MEDIA_TYPE_PHOTO)
				->cached(Date::DAY)
				->find();
			if(!$album_profile->loaded()){
				$album = \orm::factory("album");
				$album->user($this)->_migrate_albums_wall();
			}
			
			$album_profile = \orm::factory("album")
				->where("user_entity_id","=",$this->entity_id)
				->where("type_id","=",\Model_message::MEDIA_TYPE_VIDEO)
				->cached(Date::DAY)
				->find();
			if(!$album_profile->loaded()){
				$album = \orm::factory("album");
				$album->user($this)->_migrate_albums_video();
			}
			
			$cache->set($token, true, \Date::DAY);
			
		}
	}
	
	
	public function has_achieved_promo($id){
		return \orm::factory("mastertransaction")->where("user_id","=",$this->id)->where("ref_id","=",$id)->find()->loaded();
	}

	public function get_link()
    {
    	if($this->loaded()){
    		return "/profile/feeds/" . $this->id;
    	}
	}
	
	public function get_link_photos()
    {
    	if($this->loaded()){
    		return "/profile/photos/" . $this->id;
    	}
	}
	

	public function get_gamescore($game_id)
    {
    	if(!$this->loaded()){
    		return \ORM::factory('highscores')
				->select(\db::expr('MAX(score) AS max_score'))
				->where('game_id', '=', 0)
				->where('user_id', '=', 0)
				->cached(false)
		        ->limit(0)
		        ->find();
    	}
    	
    	return \ORM::factory('highscores')
				->select(\db::expr('MAX(score) AS max_score'))
				->where('game_id', '=', !empty($game_id) ? $game_id : 0)
				->where('user_id', '=', $this->id)
				->cached(false)
		        ->limit(1)
		        ->find();
	}

	public function get_blocklist()
    {
		$users =  \orm::factory("userblacklist")
				->where("entity_id","=",$this->entity_id)
				->find_all();

		$entity_id = array("0");

		foreach($users as $user){
			$entity_id[] = $user->block_entity_id;
		}
		
		if(empty($entity_id) or !is_array($entity_id)){
			$entity_id = array("0");
		}

		return \orm::factory("user")->where("entity_id","in",$entity_id);
	}



	public function add_education($schoolname, $major){
		if($this->loaded()){
			$schoolname = ucwords($schoolname);
			$major = ucwords($major);

			$details = $this->info->details;

			$csv = new Csv($this->tag_ids);
			$school = orm::factory("school")->where("name","like",$schoolname)->find();
			if(!$school->loaded()){
				$school = orm::factory("school");
				$school->name = $schoolname;
				$school->save();
			}


			$tag = orm::factory("tag")->where("name","like",$schoolname)->find();
			if(!$tag->loaded()){
				$tag = orm::factory("tag");
				$tag->name = $schoolname;
				$tag->save();
			}
			$school->tag_id = $tag->id;
			$school->save();

			$usertag = $this->tags->where("id","=",$tag->id)->find();
			if(!$usertag->loaded()){
				$csv->add($tag->id);
			}

			if(!empty($major)){
				$tag = orm::factory("tag")->where("name","like",$major)->find();
				if(!$tag->loaded()){
					$tag = orm::factory("tag");
					$tag->name = $major;
					$tag->save();
				}

				$usertag = $this->tags->where("id","=",$tag->id)->find();
				if(!$usertag->loaded()){
					$csv->add($tag->id);
				}
			}
			$arrayschools = array($schoolname,
							 !empty($major) ? $major : '');

			$found = false;

			if(is_array($details["education"])){
				if(count($details["education"]) > 0){
					foreach($details["education"] as $job){
						if($job[0] == $schoolname){
							$found = true;
						}
					}
				}
			}


			if($found == false){
				if(is_array($details["education"])){
					$details["education"] [] = $arrayschools;
				}else{
					$details["education"] = array($arrayschools);
				}
			}


			$info = $this->info;
			$info->details = $details;
			$info->save();

			$entity = $this->entity;
			$entity->tag_ids = $csv->as_string();
			$entity->save();
		}
	}

	public function add_occupation($companyname, $jobtitle){
		if($this->loaded()){
			$companyname = ucwords($companyname);
			$jobtitle = ucwords($jobtitle);

			$details = $this->info->details;
			$csv = new Csv($this->tag_ids);

			$company = orm::factory("company")->where("name","like",$companyname)->find();
			if(!$company->loaded()){
				$company = orm::factory("company");
				$company->name = $companyname;
				$company->save();
			}


			$tag = orm::factory("tag")->where("name","like",$companyname)->find();
			if(!$tag->loaded()){
				$tag = orm::factory("tag");
				$tag->name = $companyname;
				$tag->save();
			}
			$company->tag_id = $tag->id;
			$company->save();

			$usertag = $this->tags->where("id","=",$tag->id)->find();
			if(!$usertag->loaded()){
				$csv->add($tag->id);
			}

			if(!empty($jobtitle)){
				$tag = orm::factory("tag")->where("name","like",$jobtitle)->find();
				if(!$tag->loaded()){
					$tag = orm::factory("tag");
					$tag->name = $jobtitle;
					$tag->save();
				}

				$usertag = $this->tags->where("id","=",$tag->id)->find();
				if(!$usertag->loaded()){
					$csv->add($tag->id);
				}
			}

			$arraycompany = array($companyname, !empty($jobtitle) ? $jobtitle : "");

			$found = false;
			if(is_array($details["occupation"])){
				if(count($details["occupation"]) > 0){
					foreach($details["occupation"] as $job){
						if($job[0] == $companyname){
							$found = true;
						}
					}
				}
			}


			if($found == false){
				if(is_array($details["occupation"])){
					$details["occupation"] [] = $arraycompany;
				}else{
					$details["occupation"] = array($arraycompany);
				}
			}

			$info = $this->info;
			$info->details = $details;
			$info->save();

			$entity = $this->entity;
			$entity->tag_ids = $csv->as_string();
			$entity->save();
		}
	}


	public function get_facebook()
    {
    	if($this->loaded()){
    		return orm::factory('facebook')->where(db::expr("FIND_IN_SET(" . $this->id . ",user_ids)"), '!=', 0)->find();
    	}else{
    		return orm::factory('facebook')->where("id","=",0)->find();
    	}
	}


	public function get_google()
    {
    	if($this->loaded()){
    		return orm::factory('google')->where(db::expr("FIND_IN_SET(" . $this->id . ",user_ids)"), '!=', 0)->find();
    	}else{
    		return orm::factory('google')->where("id","=",0)->find();
    	}
	}




	public function get_yahoo()
    {

     	if($this->loaded()){
    		return orm::factory('yahoo')->where(db::expr("FIND_IN_SET(" . $this->id . ",user_ids)"), '!=', 0)->find();
    	}else{
    		return orm::factory('yahoo')->where("id","=",0)->find();
    	}

	}

	/**
	 * Returns the starhub info associated to the user
	 *
	 * @return object|boolean
	 */
	public function get_starhub_info()
    {
     	if($this->loaded())
		{
    		return ORM::factory('starhub')->where(DB::Expr("FIND_IN_SET(" . $this->id . ", user_ids)"), '!=', 0)->find();
    	}

		return false;
	}

    public function log_activity($activity_template)
    {

	}

	public function get_activities()
    {
        return Orm::factory('activity')->cached(Date::MINUTE)->where('user_id', '=', $this->id);
	}


	public function get_public_activities()
    {
    	$ignore_list = kohana::config("activity")->showonprofile;
    	$ignore_list = array_merge($ignore_list,array("0"));

        return Orm::factory('activity')
					->select(db::expr("count(template_id) as 'count'"))
					->where("template_id","in", $ignore_list)
					->where('user_id', '=', $this->id)
					->cached(Date::DAY)
					->order_by("date_added","desc");
	}
	
	public function get_notifications()
    {
    	
        
        $cache = Database_Query::$cache;
		
		$ignore_list = kohana::config("activity")->ignore;
	    $ignore_list = array_merge($ignore_list,array("0"));
	    
		$activity_ids = array(0);
		
		$token = md5((!empty($this->entity_id) ? $this->entity_id : 0) .
					\cache::$namescope->key(Orm::factory('activity')->_table_name()) .
					\orm::factory("domain")->current .
					implode($ignore_list) .
					"notifications");
		
		if (false === ($activity_ids = $cache->get($token, false)) and $this->loaded())
		{
				    	
	    	
	    	// GET ALL NOTIFICATIONS FOR THIS USER;
	    	$activitities = \DB::select('id')
	    	 	->from(Orm::factory('activity')->_table_name())
				->where("template_id","not in",$ignore_list)
				->where("user_id","=",$this->id)
				->where('is_hidden', '=', 0)
				->where(\db::expr("date(date_added)"),">=", \db::expr("DATE_SUB(CURDATE(),INTERVAL 1 MONTH)"))
				->order_by("id","desc")
				->limit(200)
				->execute()
				->cached(\Date::DAY)
				->as_array();
				
	    	$activitities = \orm::array_value_recursive("id",$activitities);
	    	$activitities = is_array($activitities) ? $activitities : array($activitities);
	    	
	    	// broadcast
			$broadcast = \DB::select('id')
					    	 	->from(Orm::factory('activity')->_table_name())
								->where("template_id","in",((\orm::factory("domain")->current == 40) ? array('204','652') :  array('204')))
								->where("user_id","=",0)
								->where('is_hidden', '=', 0)
								->where(\db::expr("date(date_added)"),">=", \db::expr("DATE_SUB(CURDATE(),INTERVAL 1 MONTH)"))
								->order_by("id","desc")
								->limit(200)
								->execute()
								->cached(\Date::DAY)
								->as_array();
	    	
			$broadcast = \orm::array_value_recursive("id",$broadcast);
	    	$broadcast = is_array($broadcast) ? $broadcast : array($broadcast);
	        				
	        $activity_ids = array_merge($broadcast,$activitities);
	        $activity_ids = array_unique($activity_ids);
	        $activity_ids = array_filter($activity_ids, 'strlen');
			
			
			
			$cache->set($token, $activity_ids, \Date::MONTH);
		}
        
        return Orm::factory('activity')
        				->where("id","in", !empty($activity_ids) ? $activity_ids : array("0"))
        				->order_by("id","desc");
	}
	
	
	public function get_pm_notifications()
    {
        return Orm::factory('activity')
        				->where("template_id","=", "205")
        				->where('user_id', '=', $this->id)
        				->where('is_hidden', '=', 0)
        				->order_by("date_added","desc");
	}

	public function is_admin()
    {
        if(!$this->loaded())
            return false;
        $adminuser = orm::factory('adminaccess')->where('user_id', '=', $this->id)->find();
        return $adminuser->loaded();
	}

	public function get_alerts()
    {
		return array(
            'friendrequest' => 0,
            'privatemessage' => 0,
			'wallpost' => 0,
			'gamealert' => 0
        );
	}

	public function get_tags(){
		if($this->loaded()){
			return orm::factory("tag")->fetch_by_csv($this->tag_ids);
		}else
		{
			return false;
		}

	}
	public function get_entity(){
		if($this->loaded()){
			return orm::factory("entities")->where("id","=",$this->entity_id)->find();
		}
	}
	

	
	public function get_tag_ids(){
		if($this->loaded()){
			return orm::factory("entities")->where("id","=",$this->entity_id)->find()->tag_ids;
		}else{
			return "";
		}
	}
	
	public function has_checkedin()
    {
       $checkin = orm::factory("userlocation")->where("user_id","=",$this->id)->where("city_id",">",0)->order_by("date_added","desc")->find();
       
       return $checkin->loaded();
    }
	
	
	
	public function get_checkin()
    {
       return orm::factory("userlocation")->where("user_id","=",$this->id)->where("city_id",">",0);
    }
	

	public function get_people_near_you($mode="friend",$radius=null){
		
		if(!$this->loaded()){
			return orm::factory("user")->where("id","=","-1");
		}
		
		$last_location  = $this->checkin->order_by("id","desc")->limit(1)->find();
		if(!$last_location->loaded()){
			return orm::factory("user")->where("id","=","-1");
		}
		
		$latitude = $last_location->latitude; // latitude of centre of bounding circle in degrees
		$longitude = $last_location->longitude; // longitude of centre of bounding circle in degrees
		
		if(empty($radius)){
			$radius = 1.609344;  // radius of bounding circle in kilometers
		}

  		$earth_radius = 6371;  // earth's radius, km
  
		// first-cut bounding box (in degrees)
		$maxLat = $latitude + rad2deg($radius/$earth_radius);
		$minLat = $latitude - rad2deg($radius/$earth_radius);
		
		// compensate for degrees longitude getting smaller with increasing latitude
		$maxLon = $longitude + rad2deg($radius/$earth_radius/cos(deg2rad($latitude)));
		$minLon = $longitude - rad2deg($radius/$earth_radius/cos(deg2rad($latitude)));
  
  		// convert origin of filter circle to radians
  		$latitude = deg2rad($latitude);
  		$longitude = deg2rad($longitude);
  		
		$user = \DB::select('user_id');
		$user->from("user_location");
		$user->where("latitude",">",$minLat);
		$user->where("latitude","<",$maxLat);
		$user->where("longitude",">",$minLon);
		$user->where("longitude","<",$maxLon);
		$user->group_by("user_id");
		$user->order_by("id","desc");
		$user->limit("1000");
		$user = $user->execute()->cached(\Date::HOUR)->as_array();	
		$user = \orm::array_value_recursive("user_id",$user);
		if(is_array($user)){
			$user = array_unique($user);
		}else{
			$user = explode(",",$user);
		}
		
		$poeple_near_you = orm::factory("user")
									->distinct(true)
									->select("user_location.latitude")
									->select("user_location.longitude")
									->select(db::expr("user_location.date_added as 'checkin_date'"))
									->join('user_location')
									->on('user_location.user_id', '=', 'users.id')
									->where("users.id","in",$user)
									->where(\db::expr("(acos(sin($latitude)*sin(radians(latitude)) + cos($latitude)*cos(radians(latitude))*cos(radians(longitude)-$longitude))*$earth_radius)"),"<",db::expr($radius))
									->order_by("user_location.id","desc")
									->group_by("users.id")
									->cached(\Date::HOUR);
		
		$userinfo = $this->info;
		
		
		$friends = explode(",",$userinfo->friend_ids);
		$friends = array_merge(array("0"),$friends);
		
		$pending_request = $userinfo->pending_details["friend_request_sent"];
		$pending_request = explode(",", $pending_request);
		$pending_request = array_merge(array("0"),$pending_request);
		
		switch($mode){
			case "friend":				$poeple_near_you->where("users.id","in",$friends);
										break;
			case "suggested-friend":	$poeple_near_you->where("users.id","not in",array_merge($friends,$pending_request, array($this->id)));
										break; 
		}									
		
		return $poeple_near_you;				
	}


	public function get_distance(){
		$location = \location::details();
		

		if($location->latitude == "" or $location->longitude == ""){
			return ___("Distance Unknown");
		}

		$distance = number_format(\location::distance($this->latitude,$this->longitude,$location->latitude,$location->longitude,"m"),4);
		
		if($distance > 5){
			return ___("Very Far");
		}
		
		if($distance <= 5 and $distance >= 3){
			return ___("Far");
		}
		
		if($distance < 3 and $distance >= 1){
			return ___("Near");
		}
		
		if($distance < 1){
			return $distance . " Miles away";
		}
		
		if($distance < 0){
			return ___("Distance Unknown");
		}
	}
	
	
	
	
	public function has_fb_or_yahoo()
    {
        return ($this->facebook->loaded() or $this->yahoo->loaded());
    }

    public function has_photo()
    {
        return !empty($this->image_url) && $this->image_url != 'photoDefaultSmall.jpg';
    }
	
	public function get_interest_count()
    {
		return \ORM::factory('interest')->where('tag_id', 'IN', explode(',', $this->tag_ids))->cached(\Date::HOUR)->count_all();
    }
	
	public function get_interest()
    {
		return \ORM::factory('interest')->where('tag_id', 'IN', explode(',', $this->tag_ids))->cached(\Date::HOUR)->find_all();
    }
	
	public function get_registration_step()
	{
		$default_registration_step = \Kohana::config('userinfo.structure.default.registration_step');	
		$registration_step = $this->info->registration_step;
		$steps_not_done = array_intersect_assoc($registration_step, $default_registration_step);
		
		return $steps_not_done;
	}

	public function get_interest_names()
	{
		$interest = $this->interest;
		if (count($interest) > 0)
		{
			$titles = \ORM::parse($interest, 'array', 'title');
			
			return implode(', ', $titles);
		}
		
		return '';
	}
	
    public function get_photopath()
    {
        //return STATIC_SERVER . '/files/'.$this->id . '/';
        return S3_URI . "user-images2/user-images/";
    }

	public function get_photo()
    {
    	//$image = new imagelocator();
    	if($this->has_photo()){
    		//if($image->exists($this->get_photopath() . $this->image_url)){
				//return $this->get_photopath() . strtolower($this->image_url);
                //some image_url in users are upper JPG
                return $this->get_photopath() . $this->image_url;
			//}else{
			//	return self::DEFAULT_PHOTO;
			//}
    	}else{
    		return self::DEFAULT_PHOTO;
    	}
	}

	public function get_thumbnail()
    {
   	  	$prefix = 'thumb_';

    	//$image = new imagelocator();
    	if($this->has_photo()){
    		//if($image->exists($this->get_photopath() . $prefix . $this->image_url)){
				return $this->get_photopath() . $prefix . $this->image_url;
			//}else{
			//	return self::DEFAULT_THUMB;
			//}
    	}else{
    		return self::DEFAULT_THUMB;
    	}
	}

    public function get_info()
    {
        $obj = $this->_from_cache('userinfo', ORM::factory('userinfo')->cached(\Date::DAY)->where('id', '=', $this->id)->find());
        if (!$obj->loaded()) {
        	$obj = orm::factory('userinfo');
        	$obj->id = $this->id;
        }
        return $obj;
    }

	public function get_friends( $is_cache = false )
    {
    
    	if(!$this->loaded()){
    		return ORM::factory('user')->where("id","=","-1")->limit(0);
    	}

		$userinfo = $this->info;

		if('101284' == $this->id){
			return ORM::factory('user')->cached(\Date::DAY);
		}else{
			$friend_ids = explode(",",$userinfo->friend_ids);
			$friend_ids = array_filter($friend_ids, 'strlen');
			$friend_ids = array_unique($friend_ids);
			
			return ORM::factory('user')
						->cached(\Date::DAY)
						->where("users.id","in",!empty($friend_ids) ? $friend_ids : array(0));
		}
	}

	public function get_friends_count()
	{
		$userinfo = $this->get_info();

		if (!$userinfo->loaded())
        {
            return 0;
        }

        return $userinfo->friends_count;
	}

    public function get_schools()
    {
    	$userinfo = $this->get_info();

		if (!$userinfo->loaded())
        {
            return false;
        }

        return ORM::factory('school')->fetch_by_csv($userinfo->school_ids);
    }


	 public function get_companies()
     {
        $userinfo = $this->get_info();

		if (!$userinfo->loaded())
        {
            return false;
        }

        return ORM::factory('company')->fetch_by_csv($userinfo->company_ids);
    }

	public function remove_friend($friend_id){
        $userinfo = $this->get_info();

		if (!$userinfo->loaded())
        {
            return false;
        }
		// delete him from my friends list
		$csv = new \Csv($userinfo->friend_ids);
		$csv->delete($friend_id);

        $userinfo->friend_ids = $csv->as_string();
        $userinfo->friends_count = $csv->count();
        $userinfo->save();

        // delete me from his friends list
        $friend = orm::factory("userinfo")->where("id","=",$friend_id)->find();
		$csv = new CSV($friend->friend_ids);
		$csv->delete($this->id);
		$friend->friend_ids = $csv->as_string();
		$friend->friends_count = $csv->count();
		$friend->save();

        $friend = Orm::factory('user', $friend_id);

		$friend_orm = \ORM::factory('friend')->cached(false)
					->where('user_id', '=', $this->id)
					->where('friend_id', '=', $friend_id)
					->find();

		if ($friend_orm->loaded())
        {
			$friend_orm->delete();
        }

		// friends
		$friend_orm = \ORM::factory('friend')->cached(false)
					->where('user_id', '=', $friend_id)
					->where('friend_id', '=', $this->id)
					->find();

		if ($friend_orm->loaded())
        {
			$friend_orm->delete();
        }
        
        $friend = orm::factory("user")->where("id","=",$friend_id)->find();
        if($friend->loaded()){
        	$this->unwatch($friend->entity_id);
        }
	}


	public function is_friend($friend_id){
		if(!$this->loaded())
        {
            return false;
        }
        
        if($friend_id == $this->id){
            return true;
        }

        $friend_list = $this->info->friend_ids;
        $friend_list = explode(",",$friend_list);
        return in_array($friend_id, $friend_list);
    }
    
    public function can_add_friend($friend_id){

    	$userinfo = $this->get_info();
    	
    	$limit = \orm::factory("friend")->user($this)->friends_limit();

		if (!$userinfo->loaded())
        {
            return self::LIMIT_REACH;
        }
		
		if($userinfo->friends_count >= $limit){
			return self::LIMIT_REACH_YOU;
		}
		
		$friend = Orm::factory('userinfo')->where("id","=",$friend_id)->find();
		
		if($friend->friends_count >= \orm::factory("friend")->user( Orm::factory('user',$friend_id))->friends_limit()){
			 return self::LIMIT_REACH;
		}

		if($this->is_friend($friend_id)){
			return self::ALREADY_FRIEND;
		}
		
		if($this->my_pending_friend_request->where("id","=",$friend_id)->find()->loaded()){
			 return self::PENDING_REQUEST;
		}
		
		if($this->pending_friend_request->where("id","=",$friend_id)->find()->loaded()){
			 return self::PENDING_REQUEST_TO_ME;
		}
		

		
		return self::NOT_FRIEND;
	
    }
    
	public function is_friend_of_friend($friend_id)
    {
        $user = Orm::factory('user', $friend_id);
        if (!$user->loaded())
        {
            return false;
        }
        
    	return count(array_intersect(explode(',', $this->info->friend_ids),explode(",",$user->info->friend_ids))) > 0 || $this->id == $user->id;
    }
    
    public function get_total_consumption_in_domain($domain_id=null){
		return orm::factory("mastertransaction")->where("user_id","=",$this->id)->find()->total_consumption_in_domain;
    }
    
    public function get_total_consumption(){
		return orm::factory("mastertransaction")->where("user_id","=",$this->id)->find()->total_consumption;
    }
    
	public function get_mcash_transactions()
	{
		return orm::factory("mastertransaction")->where("user_id","=",$this->id);
	}

	public function get_social_game_purchases()
	{
		return orm::factory("socialgamepurchase")->where("user_id","=",$this->id);
	}


	public function get_mobile_game_transactions(){
		return orm::factory("mobilegamepurchase")->where("user_id","=",$this->id);
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
    
	public function get_privacy_setting($setting){
		$privacy = $this->privacy;
		$auth = \Auth::instance();
		$currentuser =  ($auth->logged_in()) ? $auth->get_user() : false;
		
	
		switch(array_key_exists($setting, $privacy) ? $privacy[$setting] : ""){
			case "0": //open book;
					  return true;
					  break;
			case "1": // friends only;
					  if($currentuser === false):
					  	  return false;
					  else:
					  	  if($currentuser->is_friend($this->id) or $currentuser->id == $this->id):
						  	 return true;
						  else:
						  	 return false;
						  endif;
					  endif;

					  break;
			case "2": // man is an island;
					  if($currentuser === false):
					  	  return false;
					  else:
						  if($currentuser->id == $this->id):
						  	 return true;
						  else:
						  	 return false;
						  endif;
					  endif;
					  break;
			case "3": // friend of friends
					  if($currentuser === false):
					  	  return  false;
					  else:
						  if((count(array_intersect(explode(",",$currentuser->info->friend_ids),explode(",",$this->info->friend_ids))) > 0) or $currentuser->id == $this->id ):
						  	 return true;
						  else:
						  	 return false;
						  endif;
					  endif;
					  break;
			case "4": 
					  if($currentuser === false):
					  	  return  false;
					  else:
						  return true;
					  endif;
					  break;
			case "5": 
					  if($currentuser === false):
					  	  return  false;
					  else:
						  return true;
					  endif;
					  break;
			default:
					  return false;
					  break;

		}

	}

	public function get_comment_settings(){
		$privacy = $this->privacy;
		$auth = \Auth::instance();
		$currentuser = ($auth->logged_in()) ? $auth->get_user() : false;

		switch(array_key_exists("can_be_commented_by", $privacy) ? $privacy["can_be_commented_by"] : ""){
			case "0": //open book;
					  return true;
					  break;
			case "1": // friends only;
					  if($currentuser === false):
					  	  return false;
					  else:
					  	  if($currentuser->is_friend($this->id) or $currentuser->id == $this->id):
						  	 return true;
						  else:
						  	 return false;
						  endif;
					  endif;

					  break;
			case "2": // man is an island;
					  if($currentuser === false):
					  	  return false;
					  else:
						  if($currentuser->id == $this->id):
						  	 return true;
						  else:
						  	 return false;
						  endif;
					  endif;
					  break;
			case "3": // friend of friends
					  if($currentuser === false):
					  	  return  false;
					  else:
						  if((count(array_intersect(explode(",",$currentuser->info->friend_ids),explode(",",$this->info->friend_ids))) > 0) or $currentuser->id == $this->id ):
						  	 return true;
						  else:
						  	 return false;
						  endif;
					  endif;
					  break;
			default:
					  if($currentuser === false):
					  	  return false;
					  else:
					  	  if($currentuser->is_friend($this->id) or $currentuser->id == $this->id):
						  	 return true;
						  else:
						  	 return false;
						  endif;
					  endif;
					  break;

		}

	}
	
	/**
	 * Returns the list of block users
	 *
	 * @return array
	 */
	 
	 public function _get_block_users(){
	 	$cache = Database_Query::$cache;
		//cached this list depending on my BLACK LISTED USERS and not on the entire userblacklist table
		
		$latest_block_user =  \orm::factory("userblacklist")
							->where("entity_id","=",$this->entity_id)
							->order_by("date_added","desc")
							->cached(\date::MONTH)
							->find();
		
		$token = sha1($this->entity_id . "_" . ($latest_block_user->loaded() ? $latest_block_user->id : 0));
		
		if (false === ($block_entity_id = $cache->get($token, false)))
		{
			$blockusers =  \orm::factory("userblacklist")
							->where("entity_id","=",$this->entity_id)
							->cached(\date::MONTH)
							->find_all();
	
			$block_entity_id = array("0");
	
			foreach($blockusers as $user){
				$block_entity_id[] = $user->block_entity_id;
			}
			
			if(empty($block_entity_id) or !is_array($block_entity_id)){
				$block_entity_id = array("0");
			}
			$cache->set($token, $block_entity_id, \Date::MONTH);
		}
		return $block_entity_id;
	 }
	 
	/**
	 * Returns the sort_formula
	 *
	 * @return string
	 */
	 
	public function _sort_formula(){

		$cache_system = \Kohana::$default_config['cache_system'];
		$cache = \Cache::instance($cache_system['namescope']); 

		$max_comment_count = $cache->get('MAX_COMMENT_CACHE', 0);  
		$max_share_count = $cache->get('MAX_SHARE_CACHE', 0);
		$max_like_count = $cache->get('MAX_LIKE_CACHE', 0);
		$max_weight_count = $cache->get('MAX_WEIGHT_CACHE', 5);
		$max_weight = $cache->get('MAX_COMPUTED_WEIGHT_CACHE', self::DEFAULT_WEIGHT);
		$max_affinity = $cache->get('MAX_AFFINITY_CACHE', self::DEFAULT_AFFINITY);
		
		
		$database_cache = \Database_Query::$cache;
		
		$token = sha1("SORT FORMULA" . 
					  "RECENT_MESSAGES" . 
					  "NO AFFINITY");

		if (false === ($sort_order = $database_cache->get($token, false))){
			$weight_formula = "((((COMMENT_COUNT + SHARE_COUNT + LIKE_COUNT + INITIAL_WEIGHT) / MAX) * MULTIPLIER) * PERCENT)"; 
			$decay_formula = "(((((-4.961 * pow(10,-5) ) * pow(AGE,2)) + EXPIRY) * MULTIPLIER) * PERCENT)";
			$affinity_formula = "(((AFFINITY / MAX) * MULTIPLIER) * PERCENT)";
		
			//$affinity_formula = str_replace("AFFINITY", "coalesce(associates.affinity,1)", $affinity_formula);
			$affinity_formula = str_replace("AFFINITY", 1, $affinity_formula);
			$affinity_formula = str_replace("MAX", $max_affinity, $affinity_formula);
			$affinity_formula = str_replace("MULTIPLIER", self::MULTIPLIER, $affinity_formula);
			$affinity_formula = str_replace("PERCENT", self::AFFINITY_PERCENT, $affinity_formula);
		
			$weight_formula = str_replace("COMMENT_COUNT", "recent_messages.comment_count", $weight_formula);
			$weight_formula = str_replace("SHARE_COUNT", "recent_messages.share_count", $weight_formula);
			$weight_formula = str_replace("LIKE_COUNT", "recent_messages.like_count", $weight_formula);
			$weight_formula = str_replace("INITIAL_WEIGHT", "recent_messages.weight", $weight_formula);
			$weight_formula = str_replace("MULTIPLIER", self::MULTIPLIER, $weight_formula);
			$weight_formula = str_replace("MAX", $max_weight, $weight_formula);
			$weight_formula = str_replace("PERCENT", self::WEIGHT_PERCENT, $weight_formula);
		
			$decay_formula = str_replace("EXPIRY", self::MESSAGE_EXPIRY, $decay_formula);
			$decay_formula = str_replace("AGE", "ceil( ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(recent_messages.date_added)) / 60) / 60)", $decay_formula);
		
			$decay_formula = str_replace("MULTIPLIER", self::MULTIPLIER, $decay_formula);
			$decay_formula = str_replace("PERCENT", self::TIME_PERCENT, $decay_formula);
		
			$sort_order = $weight_formula . " + " . $decay_formula . " + " . $affinity_formula;
			$database_cache->set($token, $sort_order, \Date::DAY);
		}
		
		//return "recent_messages.date_added";
		
		return $sort_order;
	}
	
	public function _get_trim_message(&$message_ids){
		$cache = Database_Query::$cache; 
		
		// group post by hour and by user
		$token = sha1($this->id . 
				 "MESSAGE" .
				 \cache::$namescope->key('ENTITY_MESSAGES') .
				 implode(",",$message_ids) . 
				 SERVER_NAME);
		
		if (false === ($trim_message_ids = $cache->get($token, false)))
		{
			$trim_message_ids = \DB::select(\db::expr('max(id) as id'))
							->select(\db::expr("ceil(UNIX_TIMESTAMP(recent_messages.date_added) / 7200)"))
							->from("recent_messages")
							->where("to_id","=",\db::expr("from_id"))
							->where("recent_messages.id","in",$message_ids)
							->where("media_type_id","in",\Model_Message::$_user_generated_content)
							->group_by(\db::expr("ceil(UNIX_TIMESTAMP(recent_messages.date_added) / 7200)"))
							->group_by("from_id")
							->group_by("media_type_id")
							->order_by(\db::expr("max(id)"),"desc")
							->limit(300)
							->cached(\DATE::HOUR)
							->execute()
							->as_array();
			if(count($trim_message_ids) > 0){
				if(count($trim_message_ids) < 200){
					$trim_message_ids = $this->_get_recent_user_generated_messages();
				}else{	
					$trim_message_ids = \orm::array_value_recursive("id",$trim_message_ids);
					$trim_message_ids = is_array($trim_message_ids) ? $trim_message_ids : array($trim_message_ids);
				}
			}else{
				$trim_message_ids = array();
			}
			
			
			
			
			$cache->set($token, $trim_message_ids, \Date::HOUR);
		}
		
		$token = sha1($this->id . 
				 "ALBUM_MESSAGE" .
				 \cache::$namescope->key('ENTITY_MESSAGES') .
				 implode(",",$message_ids) . 
				 SERVER_NAME);

		if (false === ($album_message_ids = $cache->get($token, false)))
		{
		
			$album_message_ids = \DB::select("id")
								->from("recent_messages")
								->where("to_id","=",\db::expr("from_id"))
								->where("recent_messages.id","in",$message_ids)
								->where("media_type_id","=",\Model_Message::MEDIA_TYPE_ALBUM)
								->limit(100)
								->cached(\DATE::HOUR)
								->execute()
								->as_array();

			$album_message_ids = \orm::array_value_recursive("id",$album_message_ids);
			$album_message_ids = is_array($album_message_ids) ? $album_message_ids : array($album_message_ids);

			$cache->set($token, $album_message_ids, \Date::HOUR);
		}
		
		$message_ids = array_merge($trim_message_ids,$album_message_ids);
		
		$message_ids = array_diff($message_ids,$this->_get_block_messages());	 
		 
		unset($trim_message_ids);
		unset($album_message_ids);
	}
	
	public function _get_group_game_messages(){
		$cache = Database_Query::$cache; 
		
		$gamewhitelist = \orm::factory("gamewhitelist")->domain_list;
		
		$entities = $this->friend_entity_ids;
		$entities[] = $this->entity_id;
		
		$block_entity_id = $this->_get_block_users();
		
		$entities = array_unique(array_merge(array("0"),$entities));
		$entities = array_filter($entities, 'strlen');
		$people   = array_diff($entities,$block_entity_id);
		$entities = (count($people) > 0 ? $people : $entities);		
	
		$token = sha1($this->id . 
					 "GAMEUPDATES_GROUP" .
					 implode(",",$entities) . 
					 implode(",",$gamewhitelist) .
					 SERVER_NAME);
		
		if (false === ($group_game_updates_ids = $cache->get($token, false)))
		{
			$group_game_updates_ids = \DB::select(\db::expr("max(id) as id"))
										->from("recent_messages")
										->where("to_id","=",\db::expr("from_id"))
										->where("from_id","!=",0)
										->where("to_id","!=",0)
										->where("media_type_id","=","7")
										->where("game_id","in",$gamewhitelist)
										->where(\db::expr("date(date_added)"),">=", \db::expr("DATE_SUB(CURDATE(),INTERVAL 3 DAY)"))
										->where("date_added","<=", \db::expr("DATE_SUB(NOW(),INTERVAL 4 HOUR) "))
										->where("recent_messages.from_id","in",$entities)
										->group_by("game_id")
										->cached(\DATE::DAY)
										->execute()
										->as_array();

			if(count($group_game_updates_ids) > 0){
				$group_game_updates_ids = \orm::array_value_recursive("id",is_array($group_game_updates_ids) ? $group_game_updates_ids : array($group_game_updates_ids));
				$group_game_updates_ids = is_array($group_game_updates_ids) ? $group_game_updates_ids : array($group_game_updates_ids);
				$cache->set($token, $group_game_updates_ids, \DATE::MINUTE * 5);
			}else{
				$group_game_updates_ids = array(0);
			}
		}
				
		return array_filter(array_unique($group_game_updates_ids));

	}
	private function _get_block_messages(){
		$cache = Database_Query::$cache; 
		
		$token = sha1($this->id . 
					 "BLOCK_MESSAGE" .
					  SERVER_NAME);
					  
		$group_messages_ids = array();
		
		if (false === ($group_messages_ids = $cache->get($token, false)))
		{
			$group_messages_ids = array("0");
		}
		
		return $group_messages_ids;
	}
	
	
	public function add_block_messages($id){
		$cache = Database_Query::$cache; 
		
		$token = sha1($this->id . 
					 "BLOCK_MESSAGE" .
					  SERVER_NAME);
					  
		$group_messages_ids = array();
		
		if (false === ($group_messages_ids = $cache->get($token, false)))
		{
			$group_messages_ids = array("0");
		}
		
		$group_messages_ids[] = $id;
		
		$cache->set($token, $group_messages_ids, \DATE::DAY);
		
		return true;
	}
	
	public function remove_block_messages($id){
		$cache = Database_Query::$cache; 
		
		$token = sha1($this->id . 
					 "BLOCK_MESSAGE" .
					  SERVER_NAME);
					  
		$group_messages_ids = array();
		
		if (false === ($group_messages_ids = $cache->get($token, false)))
		{
			$group_messages_ids = array("0");
		}
		
		$csv = new \Csv( implode(",",$group_messages_ids) );
		$csv->delete($id);
		$group_messages_ids = $csv->as_array();

		$cache->set($token, $group_messages_ids, \DATE::DAY);
		
		return true;
	}


	public function _get_group_system_messages(){
		$cache = Database_Query::$cache; 
	
		$entities = $this->friend_entity_ids;
		$entities[] = $this->entity_id;
		
		$block_entity_id = $this->_get_block_users();

		$entities = array_unique(array_merge(array("0"),$entities));
		$entities = array_filter($entities, 'strlen');
		$people   = array_diff($entities,$block_entity_id);
		$entities = (count($people) > 0 ? $people : $entities);		

		
		$token = sha1($this->id . 
					 "SYSTEM_UPDATES_GROUP" .
					 implode(",",$entities) . 
					 SERVER_NAME);
		

		$group_messages_ids = array();
		
		if (false === ($group_messages_ids = $cache->get($token, false)))
		{
			$group_messages_ids = array();
						
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_REVIEW,$entities,1));
			
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_PROFILEPHOTO,$entities,2));
			
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_FRIEND,$entities,3));
					
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_BOUGHT,$entities,0));
			
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_limit_recent_message(\Model_Message::MEDIA_TYPE_FAVORITE,$entities,5,1));
	
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_PROFILE_INFO,$entities,6));
	
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_ACHIEVEMENT,$entities,7));
	
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_PLAY,$entities,8));

			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_RELATIONSHIP,$entities,9));
			
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_recent_message(\Model_Message::MEDIA_TYPE_INVITES,$entities,10));
			
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_limit_recent_message(\Model_Message::MEDIA_TYPE_PAGE_JOIN,array_diff($entities,array($this->entity_id)),11,1));

			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_limit_recent_message(\Model_Message::MEDIA_TYPE_POLL,$entities,12,1));
			
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_limit_recent_message(\Model_Message::MEDIA_TYPE_HIGHSCORE,$entities,13,2));

			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_gift_message($entities,14));
		
			$group_messages_ids =  array_merge($group_messages_ids,$this->_get_group_album_message($entities));
			
			$cache->set($token, $group_messages_ids, \DATE::MINUTE * 5);
		}
		
		
		return array_filter(array_unique($group_messages_ids));
	}
	

	public function get_user_id(){
		return  ($this->loaded()) ? $this->id : 0;
	}
	
	public function get_system_generated(){
		$entities = $this->friend_entity_ids;
		

		$entities[] = $this->entity_id;

		$block_entity_id = $this->_get_block_users();

		$entities = array_unique(array_merge(array("0"),$entities));
		$entities = array_filter($entities, 'strlen');
		$people   = array_diff($entities,$block_entity_id);
		$entities = (count($people) > 0 ? $people : $entities);		
	
		$group_game_updates_ids = $this->entity_game_messages_ids;
		$group_messages_ids = $this->entity_system_messages_ids;
		
		$message_ids = array_merge($group_messages_ids,$group_game_updates_ids);
		$message_ids = array_unique($message_ids);
		
		return \orm::factory("recent")
						->where("recent_messages.id","in",$message_ids)
						->where("from_id","in",$entities)
						->where("from_id","!=","0")
						->cached(\Date::DAY)
						->order_by("id","desc");

	}
	
	/**
	 * Returns the messages that is to be displayed on the wall
	 *
	 * @return object
	 */
	public function get_feeds(){
		$cache = Database_Query::$cache; 
		
		//get the messages that you are suppose to see at the feeds page	 

		$entities = $this->friend_entity_ids;
		

		$entities[] = $this->entity_id;

		$block_entity_id = $this->_get_block_users();

		$entities = array_unique(array_merge(array("0"),$entities));
		$entities = array_filter($entities, 'strlen');
		$people   = array_diff($entities,$block_entity_id);
		$entities = (count($people) > 0 ? $people : $entities);		
		

		// get the sort order formula
		$sort_order = $this->_sort_formula(); 
		
	
		$group_game_updates_ids = $this->entity_game_messages_ids;
		$group_messages_ids = $this->entity_system_messages_ids;
		$message_ids = $this->entity_messages_ids;
		
		$message_ids = array_merge($message_ids,$group_messages_ids,$group_game_updates_ids);
		$message_ids = array_unique($message_ids);
		$message_ids = array_diff($message_ids,$this->_get_block_messages());

        $message_ids = count($message_ids) > 0 ? $message_ids : array(0);	

		
		unset($group_game_updates_ids); unset($group_messages_ids);
		
		$message_ids = array_unique($message_ids);
		$message_ids = array_splice($message_ids,0,1000);
		$entities = array_splice($entities,0,2000);

		$message_i_sent = orm::factory("recent")
						->distinct(true)
						->where("recent_messages.id","in",$message_ids)
						->where("from_id","in",$entities)
						->where("from_id","!=","0")
						/*
->join("associates","left")
						->on("associates.entity_id2","=","recent_messages.from_id")
						->on("associates.entity_id1","=",\db::expr("'" . $this->entity_id . "'"))
*/
						->cached(\Date::DAY)
						->order_by(db::expr($sort_order),"desc")
						->order_by("date_added","desc");
		

		return $message_i_sent;
	}
	
	
	public function get_entity_game_messages_ids(){
		if(!$this->loaded()){
			return array("0");
		}
		
		$entity_messages = $this->_from_cache('entitymessage', orm::factory("entitymessage")->where("entity_id","=",$this->entity_id)->cached(\Date::MINUTE * 5)->find());
		
		if(!$entity_messages->loaded()){
			return array("0");
		}
		
		$cache = \Database_Query::$cache;
		
		$token = sha1($this->id . 
					  "GAME_GROUP" .
					  SERVER_NAME);
		

		$group_messages_ids = array();
		
		if (false === ($group_messages_ids = $cache->get($token, false)))
		{
			$group_messages_ids = $this->_get_group_game_messages();
			$entity_messages->game_messages_ids = implode(",",$group_messages_ids);
			$entity_messages->date_modified = \helper_date::sql_now();
			$entity_messages->save();
			
			$cache->set($token, $group_messages_ids, \DATE::MINUTE * 10);
			
			return $group_messages_ids;
		}
				
		return array_merge(array_unique(explode(",",$entity_messages->game_messages_ids)),array("0")); 
	}
	
	
	public function get_entity_system_messages_ids(){
		if(!$this->loaded()){
			return array("0");
		}
		
		$cache = \Database_Query::$cache; 
		
		
		$entity_messages = $this->_from_cache('entitymessage', orm::factory("entitymessage")->where("entity_id","=",$this->entity_id)->cached(\Date::MINUTE * 5)->find());
		
		if(!$entity_messages->loaded()){
			return array("0");
		}
			
		$token = sha1($this->id . 
					  "SYSTEM_GROUP" .
					  SERVER_NAME);
		

		$group_messages_ids = array();
		
		if (false === ($group_messages_ids = $cache->get($token, false)))
		{	
			$group_messages_ids = $this->_get_group_system_messages();
			$entity_messages->system_message_ids = implode(",",$group_messages_ids);
			$entity_messages->date_modified = \helper_date::sql_now();
			$entity_messages->save();
			
			$cache->set($token, $group_messages_ids, \DATE::MINUTE * 10);
			
			return $group_messages_ids;
		}
				
		return array_merge(array_unique(explode(",",$entity_messages->system_message_ids)),array("0")); 
	}
	
	
	public function get_entity_messages_ids(){
		$cache = Database_Query::$cache; 
	
		if(!$this->loaded()){
			return array("0");
		}

		$entity_messages = \orm::factory("entitymessage")
								->where("entity_id","=",$this->entity_id)
								->cached(\Date::MINUTE * 5)->find();
		
		if(!$entity_messages->loaded()){
			return array("0");
		}
		
		
		$token = sha1($this->id . 
					 "MESSAGES" .
					 \cache::$namescope->key(\orm::factory("entitymessage")->_table_name()) . 
					  SERVER_NAME);
		

		$group_messages_ids = array();
		
		if (false === ($group_messages_ids = $cache->get($token, false)))
		{
			$message_ids = $this->_get_recent_user_generated_messages();
			$message_ids = is_array($message_ids) ? $message_ids : array($message_ids);
			$this->_get_trim_message($message_ids);
			
			$entity_messages->message_ids = implode(",",$message_ids);
			$entity_messages->date_modified = \helper_date::sql_now();
			$entity_messages->save();
			
			$cache->set($token, $message_ids, \DATE::MINUTE * 5);
			
			return $message_ids;
		}
		
		$token = sha1($this->id . 
					 "MESSAGES" .
					  $entity_messages->message_ids .
					  SERVER_NAME);

		
		if (false === ($message_ids = $cache->get($token, false)))
		{
			$message_ids = \DB::select('id')
								->from("recent_messages")
								->where("media_type_id","in",array("1","2","3","4"))
								->where("from_id","=",\db::expr("to_id"))
								->where("to_id","!=",0)
								->where("from_id","!=",0)
								->where("id","in",explode(",",$entity_messages->message_ids))
								->order_by("date_added","desc")
								->cached(\DATE::DAY)
								->execute()
								->as_array();
	
			$message_ids = \orm::array_value_recursive("id",$message_ids);
			$message_ids = is_array($message_ids) ? $message_ids : array($message_ids);
			$cache->set($token, $message_ids, \DATE::MINUTE * 10);
		}
				
		return array_unique($message_ids); 

	}
	
	
	
	public function get_friend_entity_ids(){
		if(!$this->loaded()){
			return array("0");
		}
		
		$cache = \Kohana::sys_cache();
		
		$entities = array("0");
		
		$user_info = $this->info;
		$friends_token = md5($user_info->friend_ids);
		
		//cached this list depending on my friends and not on the entire friends table
		$token = sha1($this->entity_id . "_" . $friends_token);

		
		if (false === ($entities = $cache->get($token, false)))
		{	
			if('101284' == $this->id){
				$entities = array("0");
				
				$user_id = \DB::select('id')
							->from("user_infos")
							->where("user_infos.date_last_login",">=", \db::expr("DATE_SUB(NOW(),INTERVAL 1 MONTH)"))
							->limit(5000)
							->execute()
							->cached(\Date::MONTH)
							->as_array();
						
				$user_id = \orm::array_value_recursive("id",$user_id);
				$user_id = is_array($user_id) ? $user_id : array($user_id);
				
				
				$result = \DB::select('entity_id')
							->from("users")
							->where("users.id","in",$user_id)
							->execute()
							->cached(\Date::MONTH)
							->as_array();
				
				$entities = \orm::array_value_recursive("entity_id",$result);
				$entities = is_array($entities) ? $entities : array($entities);
				$entities = array_filter($entities, 'strlen');

				$cache->set($token, $entities, \Date::DAY);
			}else{
				$entities = array("0");
				$friends = explode(",",$this->info->friend_ids);
				$friends = array_unique($friends);
				$friends = array_filter($friends, 'strlen');
		
				// query too big for ORM
				$max = 1000;
				$count = count($friends);
	
				for($x=0 ; $x<($count/$max); $x++) {
					$smaller_set = $friends;
					$smaller_set = array_splice($smaller_set, ($x*$max), $max);
	
					if(count($smaller_set) > 0){
						$user_id = \DB::select('id')
							->from("user_infos")
							->where("user_infos.date_last_login",">=", \db::expr("DATE_SUB(NOW(),INTERVAL 1 MONTH)"))
							->where("user_infos.id","in",$smaller_set)
							->execute()
							->cached(\Date::MONTH)
							->as_array();
						
						$user_id = \orm::array_value_recursive("id",$user_id);
						$user_id = is_array($user_id) ? $user_id : array($user_id);
						
						
						$result = \DB::select('entity_id')
									->from("users")
									->where("users.id","in",$user_id)
									->execute()
									->cached(\Date::MONTH)
									->as_array();
						
						$result = \orm::array_value_recursive("entity_id",$result);
						$result = is_array($result) ? $result : array($result);
					}
	
					$entities = array_merge($entities,is_array($result) ? $result : array($result));
	
				}
	
	
				$entities = array_unique($entities);
				$entities = array_filter($entities, 'strlen');
				$cache->set($token, $entities, \Date::DAY);

			}
		
		}
		
		$entities = array_unique($entities);

		$page_entities = $this->_following();
		
		$entities = array_splice($entities,0,5000);
		
		$entities[] = 101284;
		$entities = array_merge($entities,$page_entities);
		
		return $entities;	
	}
	
	public function get_pages_following(){
		if(!$this->loaded()){
			return false;
		}
		
		$page_entities = $this->_following();
		
		return \orm::factory("page")->where("entity_id","in",$page_entities);
	}
	
	
	private function _following(){
		if(!$this->loaded()){
			return array(0);
		}
		
		$cache = Database_Query::$cache;
		
		$token = md5($this->entity_id . 
					"following" .
					 \cache::$namescope->key('page_followers') . 
					 \cache::$namescope->key('pages'));
		
		if (false === ($page_entities = $cache->get($token, false)))
		{
			$page_entities = array("0");
			
			$following = \DB::select('page_id')->from("page_followers")->where("user_id","=",$this->id)->cached(false)->execute()->as_array();
			$following = \orm::array_value_recursive("page_id",$following);
			$following = is_array($following) ? $following : (!empty($following) ? array($following) : array(0));
			$following = array_unique($following);

			$page_entities = \DB::select('entity_id')->from("pages")->where("id","in",$following)->cached(false)->execute()->as_array();
			$page_entities = \orm::array_value_recursive("entity_id",$page_entities);
			$page_entities = is_array($page_entities) ? $page_entities : (!empty($page_entities) ? array($page_entities) : array(0));
			$page_entities = array_unique($page_entities);
						
			$cache->set($token, $page_entities, \Date::DAY);
		}
		
		return $page_entities;
	}
	
	
	private function _get_group_gift_message($entities,$hours_ago){
		$cache = Database_Query::$cache;
		
		$token = sha1($this->id .
					 "RECENT_MESSAGE" .  
					 \Model_Message::MEDIA_TYPE_SYSTEM_GIFT .
					 $hours_ago .
					 \cache::$namescope->key('ENTITY_MESSAGES') .
					 implode(",",$entities) . 
					 SERVER_NAME);		
		
		$group_message_ids = array();
		
		if (false === ($group_message_ids = $cache->get($token, false)))
		{
			$group_message_ids = \DB::select(\db::expr("max(id) as id"))
										->from("recent_messages")
										->where("from_id","!=",0)
										->where("to_id","!=",0)
										->where("media_type_id","=",\Model_Message::MEDIA_TYPE_SYSTEM_GIFT)
										->where(\db::expr("date(date_added)"),">=", \db::expr("DATE_SUB(CURDATE(),INTERVAL 3 DAY)"))
										->where("date_added","<=", \db::expr("DATE_SUB(NOW(),INTERVAL " . ($hours_ago * 60) . " MINUTE) "))
										->where("recent_messages.from_id","in",$entities)
										->order_by("date_added","desc")
										->limit(1)
										->cached(\DATE::DAY)
										->execute()
										->as_array();

			
			$group_message_ids = \orm::array_value_recursive("id",is_array($group_message_ids) ? $group_message_ids : array($group_message_ids));
			$group_message_ids = is_array($group_message_ids) ? $group_message_ids : array($group_message_ids);

			$cache->set($token, $group_message_ids, \DATE::MINUTE * 5);
		}
		
		return $group_message_ids;
	}
	
	private function _get_group_album_message($entities){
		$cache = Database_Query::$cache;
		
		$token = sha1($this->id .
					 "RECENT_MESSAGE" .  
					 \Model_Message::MEDIA_TYPE_ALBUM .
					 \cache::$namescope->key('ENTITY_MESSAGES') .
					 implode(",",$entities) . 
					 SERVER_NAME);		
		
		$group_message_ids = array();
		
		if (false === ($group_message_ids = $cache->get($token, false)))
		{
			$group_message_ids = \DB::select(\db::expr("max(id) as id"))
										->from("recent_messages")
										->where("from_id","!=",0)
										->where("to_id","!=",0)
										->where("media_type_id","=",\Model_Message::MEDIA_TYPE_ALBUM)
										->where(\db::expr("date(date_added)"),">=", \db::expr("DATE_SUB(CURDATE(),INTERVAL 3 DAY)"))
										->where("recent_messages.from_id","in",$entities)
										->group_by(\db::expr("concat(from_id,parent_id)"))
										->order_by(\db::expr("max(id)"),"desc")
										->cached(\DATE::DAY)
										->execute()
										->as_array();

			$group_message_ids = \orm::array_value_recursive("id",is_array($group_message_ids) ? $group_message_ids : array($group_message_ids));
			$group_message_ids = is_array($group_message_ids) ? $group_message_ids : array($group_message_ids);

			$cache->set($token, $group_message_ids, \DATE::MINUTE * 5);
		}
		
		return $group_message_ids;
	}

	private function _get_group_recent_message($media_type_id, $entities, $hours_ago){
		
		$cache = Database_Query::$cache;
		
		$gamewhitelist = array();
		
		if($media_type_id==9){
			$gamewhitelist = \orm::factory("gamewhitelist")->domain_list;
		}
		
		
		$token = sha1($this->id .
					 "RECENT_MESSAGE" .  
					 $media_type_id .
					 $hours_ago . 
					 \cache::$namescope->key('ENTITY_MESSAGES') .
					 implode(",",$entities) . 
					 implode(",",$gamewhitelist) .
					 SERVER_NAME);		
		
		$group_message_ids = array();
		
		if (false === ($group_message_ids = $cache->get($token, false)))
		{
			$group_message_ids = \DB::select(\db::expr("max(id) as id"))
										->from("recent_messages")
										->where("to_id","=",\db::expr("from_id"))
										->where("from_id","!=",0)
										->where("to_id","!=",0)
										->where("to_id","!=",$this->entity_id)
										->where("media_type_id","=",$media_type_id);								
			
			if(in_array($media_type_id,array(9,15,14,18,22))){
				$gamewhitelist = \orm::factory("gamewhitelist")->domain_list;
				$group_message_ids = $group_message_ids->where("game_id","in",$gamewhitelist);
			}
			
			$group_message_ids = $group_message_ids
										->where(\db::expr("date(date_added)"),">=", \db::expr("DATE_SUB(CURDATE(),INTERVAL 3 DAY)"))
										->where("date_added","<=", \db::expr("DATE_SUB(NOW(),INTERVAL " . ($hours_ago * 2) . " HOUR) "))
										->where("recent_messages.from_id","in",$entities)
										->order_by("date_added","desc")
										->limit(1)
										->cached(\DATE::DAY)
										->execute()
										->as_array();

			
			$group_message_ids = \orm::array_value_recursive("id",is_array($group_message_ids) ? $group_message_ids : array($group_message_ids));
			$group_message_ids = is_array($group_message_ids) ? $group_message_ids : array(!empty($group_message_ids) ? $group_message_ids : 0);

			$cache->set($token, $group_message_ids, \DATE::MINUTE * 5);
		}
		
		return !empty($group_message_ids) ? $group_message_ids : array(0);

	}
	
	
	private function _get_limit_recent_message($media_type_id, $entities,$hours_ago,$limit){
		
		$cache = Database_Query::$cache;
		
		$gamewhitelist = array();
		
		if($media_type_id==9){
			$gamewhitelist = \orm::factory("gamewhitelist")->domain_list;
		}
		
		
		$token = sha1($this->id .
					 "RECENT_MESSAGE" .
					 $limit .  
					 $media_type_id .
					 $hours_ago .
					 \cache::$namescope->key('ENTITY_MESSAGES') .
					 implode(",",$entities) . 
					 implode(",",$gamewhitelist) .
					 SERVER_NAME);		
		
		$group_message_ids = array();
		
		if (false === ($group_message_ids = $cache->get($token, false)))
		{
			$group_message_ids = \DB::select(\db::expr("max(id) as id"))
										->from("recent_messages")
										->where("to_id","=",\db::expr("from_id"))
										->where("from_id","!=",0)
										->where("to_id","!=",0)
										->where("to_id","!=",$this->entity_id)
										->where("media_type_id","=",$media_type_id);								
			
			if(in_array($media_type_id,array(9,15,14,18,22))){
				$gamewhitelist = \orm::factory("gamewhitelist")->domain_list;
				$group_message_ids = $group_message_ids->where("game_id","in",$gamewhitelist);
			}
										
			$group_message_ids = $group_message_ids->where(\db::expr("date(date_added)"),">=", \db::expr("DATE_SUB(CURDATE(),INTERVAL 3 DAY)"))
										->where("date_added","<=",\db::expr("DATE_SUB(NOW(),INTERVAL " . ($hours_ago * 60) . " MINUTE) "))
										->where("recent_messages.from_id","in",$entities)
										->where("date_added","<=", \db::expr("DATE_SUB(NOW(),INTERVAL 2 HOUR) "))
										->order_by(\db::expr("max(id)"),"desc")
										->group_by("from_id")
										->limit($limit)
										->cached(\DATE::DAY)
										->execute()
										->as_array();

			
			$group_message_ids = \orm::array_value_recursive("id",is_array($group_message_ids) ? $group_message_ids : array($group_message_ids));
			$group_message_ids = is_array($group_message_ids) ? $group_message_ids : array(!empty($group_message_ids) ? $group_message_ids : 0);

			$cache->set($token, $group_message_ids, \DATE::MINUTE * 5);
		}
		
		return !empty($group_message_ids) ? $group_message_ids : array(0);

	}
	
	
	public function _get_recent_user_generated_messages(){
		$cache = Database_Query::$cache;
		
		
		$entities = $this->friend_entity_ids;
		$entities[] = $this->entity_id;
		

					
		$block_entity_id = $this->_get_block_users();
		
		$entities = array_unique(array_merge(array("0"),$entities));
		$entities = array_filter($entities, 'strlen');
		$people   = array_diff($entities,$block_entity_id);
		$entities = (count($people) > 0 ? $people : $entities);		


		$token = sha1($this->id . 
					 "RECENT_MESSAGE" .
					 \cache::$namescope->key('recent_messages') .
					 implode(",",$entities) . 
					 SERVER_NAME);
		
		$message_ids = array("0");
		if (false === ($message_ids = $cache->get($token, false)))
		{
			$message_ids = \DB::select('id')
							->from("recent_messages")
							->where("media_type_id","in",\Model_Message::$_user_generated_content)
							->where("from_id","in",$entities)
							->where("from_id","=",\db::expr("to_id"))
							->where("to_id","!=",0)
							->where("from_id","!=",0)
							->order_by("date_added","desc")
							->limit(300)
							->cached(\DATE::DAY)
							->execute()
							->as_array();
			
			$message_ids = \orm::array_value_recursive("id",$message_ids);
			$message_ids = is_array($message_ids) ? $message_ids : array($message_ids);
	
			$cache->set($token, $message_ids, \DATE::DAY);
		}
		
		
		return $message_ids;
	}

	public function get_recent(){

		$cache = Database_Query::$cache;

		if(!$this->loaded()){
			return  orm::factory("recent")->where("id","=","-1")->cached(\Date::WEEK);
		}
		
		$group_game_updates_ids = $this->entity_game_messages_ids;
		$group_messages_ids = $this->entity_system_messages_ids;
		$message_ids = $this->entity_messages_ids;
		
		$message_ids = array_merge($message_ids,$group_game_updates_ids,$group_messages_ids);
		$message_ids = array_unique($message_ids);
		$message_ids = array_diff($message_ids,$this->_get_block_messages());	 
		
		unset($group_game_updates_ids); unset($group_messages_ids);
		
		
		$message_i_sent = orm::factory("recent")
						->distinct(true)
						->where("from_id","!=",0)
						->where("recent_messages.id","in",$message_ids)
						->cached(\Date::DAY)
						->order_by("date_added","desc");
		

		
		return $message_i_sent;
	}


	public function get_gameupdates(){
		$gamewhitelist = \orm::factory("gamewhitelist")->domain_list;
		$block_entity_id = $this->_get_block_users();
		
		$message_i_sent = orm::factory("message")
									->where("to_id","=",$this->entity_id)
									->where("from_id","not in",$block_entity_id)
									->where("game_id","in",$gamewhitelist)
									->where("media_type_id","=","7")
									->order_by("date_added","desc")
									->cached(\Date::DAY);

		return $message_i_sent;
	}

	public function get_privacy(){
		return $this->info->privacy;
	}
	
	
	public function get_profile_pictures(){
		$message_i_sent = orm::factory("message")
									->where("to_id","=",$this->entity_id)
									->where("media_type_id","=",'11')
									->cached(\Date::DAY);

		return $message_i_sent;
	}
	
	public function get_albums(){
		$this->_init_album();
		
		return \orm::factory("album")->where("user_entity_id","=",$this->entity_id);
	}
	
	
	public function _who_am_i(){
		if(empty($this->_user) or !$this->loaded()){
			return \Model_Album::NOT_LOGIN; // Not login
		}
		
		if($this->_user->id == $this->id){
			return \Model_Album::ONLY_ME;  // current user
		}
		
		if(method_exists($this->_user, "get_info") and method_exists($this, "get_info")){
			if($this->_user->is_friend($this->id)){
				return \Model_Album::FRIENDS_ONLY; // i am a friend
			}
		}
		
		if(method_exists($this->_user, "get_info") and method_exists($this, "get_info")){
			 if((count(array_intersect(explode(",",$this->_user->info->friend_ids),explode(",",$this->info->friend_ids))) > 0)){
			  	 return \Model_Album::FRIENDS_OF_FRIENDS; // i am a friend of a friend
			 };
		}
		
		return  \Model_Album::EVERYONE; // i am a stranger;
	}
	
	
	
	public function get_photos(){
		// get all albums;
		$auth = auth::instance();
			
		$cache = Database_Query::$cache;
		
		if(!$this->loaded()){
			return orm::factory("message")
							->where("id","=","-1");
		}

		
		if(empty($this->_user)){
			$user = $auth->get_user();
			$this->user($auth->get_user());
		}else{
			$user = $this->_user;
		}

		$who_am_i = $this->_who_am_i();
		

		$token = md5(\cache::$namescope->key(\orm::factory("album")->_table_name()) . 
					 (!empty($this->_user->id) ? $this->_user->id : 0) . 
					 $this->id . 
					 $who_am_i .
					 "album_id");
		
		if (false === ($album_ids = $cache->get($token, false)))
		{

						
			$album_ids = \DB::select('id')
					->from("albums")
					->where("user_entity_id","=",$this->entity_id)
					->where("is_published","=",1)
					->where("privacy_settings",">=",$who_am_i)
					->cached(\DATE::DAY)
					->execute()
					->as_array();
			
					
			$album_ids = \orm::array_value_recursive("id",$album_ids);
			$album_ids = is_array($album_ids) ? $album_ids : array($album_ids);
			
			$cache->set($token, $album_ids, \Date::WEEK);
		}
		
		
		
		$message_i_sent = orm::factory("message")
							->where("parent_id","in",!empty($album_ids) ? $album_ids : array(0))
							->where("ref_table","=",\orm::factory("album")->_table_name())
							->where("to_id","=",$this->entity_id)
							->where("media_type_id","in",array(\Model_Message::MEDIA_TYPE_PHOTO,
													   \Model_Message::MEDIA_TYPE_VIDEO,
													   \Model_Message::MEDIA_TYPE_PROFILEPHOTO,
													   \Model_Message::MEDIA_TYPE_ALBUM_ITEM))
							->cached(\Date::DAY);
		
		return $message_i_sent;
	}

	
	
	
	public function get_messages(){
	
		$auth = auth::instance();
		$ids = array('0');
		$block_entity_id = $this->_get_block_users();
		
		$timeline_messages = array_merge(\Model_Message::$_user_generated_content,array(\Model_message::MEDIA_TYPE_GIFT,\Model_message::MEDIA_TYPE_PAGE_INVITE));
		
		if($auth->logged_in()){
			$user = $auth->get_user();
			if($user->entity_id == $this->entity_id){
				$to_messages = \DB::select('id')
							->from("messages")
							->where("to_id","=",$this->entity_id)
							->where("media_type_id","in", $timeline_messages)
							->cached(\DATE::DAY)
							->execute();
			}else{
				$to_messages = \DB::select('id')
							->from("messages")
							->where("to_id","=",$this->entity_id)
							->where("media_type_id","in", $timeline_messages)
							->where("details","not like",'%"privacy":%')
							->cached(\DATE::DAY)
							->execute();
			}
		}else{
			$to_messages = \DB::select('id')
							->from("messages")
							->where("to_id","=",$this->entity_id)
							->where("media_type_id","in", $timeline_messages)
							->where("details","not like",'%"privacy":%')
							->cached(\DATE::DAY)
							->execute();
		}


		foreach($to_messages as $message):
			$ids[] = $message["id"];
		endforeach;
		
		unset($to_messages);	
		
		$message_i_sent = orm::factory("message")
									->where("id","in",$ids)
									->where("from_id","not in",$block_entity_id)
									->where("media_type_id","in", $timeline_messages)
									->cached(\Date::DAY);
		
		return $message_i_sent;
	}
	
	
	public function get_privatemessages(){
		
		return orm::factory("userconversation")
						->where("entity_id","=",$this->entity_id);
	}
	

	public function get_games()
	{
		$purchase = orm::factory("gamepurchase")->where("user_id","=",$this->id)->cached(\Date::DAY)->find_all();


		return  ORM::factory("game")
				->fetch_by_csv(orm::parse($purchase,"csv","game_id"));
	}

	public function get_casualgames()
	{
		return $this->games;
	}

	public function get_mutual_friends($friend_ids){
		if(!$this->loaded()){
			return false;
		}

		$my_friends = explode(",", $this->info->friend_ids);

		$his_friends = explode(",",$friend_ids);

		$mutual_friends = array_intersect($my_friends,$his_friends);

		return orm::factory("user")->fetch_by_csv((is_array($mutual_friends)) ? implode(",",$mutual_friends) : "0");
	}

	public function get_suggested_games($limit=24)
    {
		$cache = Database_Query::$cache;

		//modiefied by Romeo:
		//change to accommodate the new game white list table structure
		$white_list = ORM::factory('gamewhitelist')->get_domain_list();
		$default =  orm::factory("game")->where('id', 'IN', $white_list)->where("is_active","=","1")->limit(50)->order_by("popularity","desc")->find_all()->as_array(); 
		
    	if($this->loaded())
		{
			$token = md5(\cache::$namescope->key('SOCIAL_GAMES') . \cache::$namescope->key('CASUAL_GAMES').  $this->id. "whitelist");
			if (false === ($inactivegames = $cache->get($token, false)))
			{
				//modiefied by Romeo:
				//change to accommodate the new game white list table structure
				$inactivegames_casual = orm::factory("casualgame")->where("is_active","=","0")->cached(Date::WEEK)->find_all();
				$inactivegames_casual =  explode(",",orm::parse($inactivegames_casual));
				
				$inactivegames_social = orm::factory("socialgame")->where("is_maintenance","=","1")->cached(Date::WEEK)->find_all();
				$inactivegames_social =  explode(",",orm::parse($inactivegames_social));
				
				$inactivegames = array_unique(array_merge($inactivegames_casual, $inactivegames_social));

				$cache->set($token, $inactivegames, \Date::WEEK);
				
			}

			// PLAYED GAMES
			if (false === ($games_i_played = $cache->get('PLAYED_GAMES_' . $this->id, false)))
			{
				$i_played = $this->activities->where("template_id","=",ACTIVITY_GAME_IS_PLAYING)->find_all();

				$games_i_played = array();

				foreach($i_played as $game){
					$game = json_decode($game->data,true);
					if(!empty($game["game_id"])){
						$games_i_played[] = $game["game_id"];
					}
				}

				$cache->set('PLAYED_GAMES_' . $this->id, $games_i_played, \Date::WEEK);
			}

			$games_i_played = empty($games_i_played) ? array("0") : $games_i_played;

		    $rs_games_i_played = orm::factory("game")->available->where("id","in",$games_i_played)->limit(1000)->cached(Date::WEEK)->find_all();



    		// get all the tags of the games you played
			$tags = array(0);
			foreach($rs_games_i_played as $game){
				$tags = array_merge($tags,explode(",", $game->tag_ids));
			}
			$tags = array_unique($tags);
			$tags = array_splice($tags,0,1000);


			// get all the games that has the same tags as the games you played
			$tag_games =  orm::factory("taggame")->where("tag_id","in",$tags)->limit(1000)->cached(Date::WEEK)->find_all();
			$games = array(0);
			foreach($tag_games as $game){
				$games = array_merge($games,explode(",", $game->game_ids));
			}
			
			$games = array_splice($games,0,1000);
			
			$games = array_unique($games);

    		// subtract it from your played games
			$games = array_diff($games,$games_i_played);

    		// get all games that are tag similarly to me
    		$similar_games_list = array(0); $entities =  orm::factory("taggame")->where("tag_id","in",explode(",",$this->tag_ids))->cached(Date::WEEK)->find_all();

			foreach($entities as $entity){
            	$similar_games_list = array_merge($similar_games_list,explode(",", $entity->game_ids));
            }
            $similar_games_list = array_splice($similar_games_list,0,1000);
            $similar_games_list = array_unique($similar_games_list);
			
	
			// get the games that are in both list ( similar games that are tagged like me and games with similar tags with my played games )
			$suggested_games = array_intersect($games,$similar_games_list);
			


			// if there are no intersection just merge the two list
			$suggested_games = (count($suggested_games) >= $limit) ? $suggested_games : array_merge($games,$similar_games_list);


			$suggested_games = array_intersect($suggested_games,$white_list);
			
			$suggested_games = array_diff($suggested_games, $inactivegames);
			
			$suggested_games = array_splice($suggested_games,0, $limit * 3);
			
			$suggested_games = array_unique($suggested_games);
			
			//clean up
			unset($games);
			unset($similar_games_list);
			unset($entities);
			unset($games_i_played);
			unset($tag_games);
			unset($tags);
			unset($rs_games_i_played);
			

			if(count($suggested_games) > 0 ){
				shuffle($suggested_games);
				$suggested_games = orm::factory("game")
									->fetch_by_csv(implode(",", $suggested_games))
									->cached(\Date::WEEK)
									->limit($limit)
									->find_all()
									->as_array();
									
				if(count($suggested_games) > 0){
					return $suggested_games;
				}else{
					$suggested_games = array_slice($default, 0, $limit * 3);
					shuffle($suggested_games);
		    		$suggested_games = orm::factory("game")
							->fetch_by_csv(implode(",", $suggested_games))
							->cached(\Date::WEEK)
							->limit($limit)
							->find_all()
							->as_array();
		
					return $suggested_games;
				}

			}else{
				shuffle($suggested_games);
				$suggested_games = orm::factory("game")
									->fetch_by_csv(implode(",", $suggested_games))
									->cached(\Date::WEEK)
									->limit($limit)
									->find_all()
									->as_array();

				if(count($suggested_games) > 0){
					return $suggested_games;
				}else{
					$suggested_games = array_slice($default, 0, $limit * 3);
					shuffle($suggested_games);
		    		$suggested_games = orm::factory("game")
							->fetch_by_csv(implode(",", $suggested_games))
							->cached(\Date::WEEK)
							->limit($limit)
							->find_all()
							->as_array();
		
					return $suggested_games;
				}
			}
    	}else{
			$suggested_games = array_slice($default, 0, $limit * 3);
			shuffle($suggested_games);
    		$suggested_games = orm::factory("game")
					->fetch_by_csv(implode(",", $suggested_games))
					->cached(\Date::WEEK)
					->limit($limit)
					->find_all()
					->as_array();

			return $suggested_games;
    	}

	}

	public function get_pending_friend_request(){
		$user_ids = $this->info->pending_details["friend_request_received"];
		return orm::factory("user")->fetch_by_csv($user_ids);
	}

	public function get_my_pending_friend_request(){
		$user_ids = $this->info->pending_details["friend_request_sent"];
		return orm::factory("user")->fetch_by_csv($user_ids);
	}
	
	/**
	 * Returns the games played
	 *
	 * @param int $noofdays Number of days
	 * @param int $limit 	Number of games
	 * 
	 * @return object
	 */
	public function played_games($noofdays = 7, $limit = 10)
	{
		$start_date = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d') - $noofdays, date('Y')));
		$end_date = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
		
		return  \ORM::factory('activitygameplay')
					->select('games.title')
					->join('games', 'inner')
					->on('activities_gameplays.game_id', '=', 'games.id')
					->where('user_id', '=',  $this->id)
					->where('activities_gameplays.date_added', 'between', array($start_date, $end_date))
					->group_by('game_id')
					->cached(\Date::DAY)
					->limit($limit)
					->find_all();
	}
 	
	public function get_played_games_titles()
	{
		$played_games = $this->played_games();
		if (count($played_games) > 0)
		{
			$title = \ORM::parse($played_games, 'array', 'title');
			if (count($title) > 0)
			{
				$title = array_slice($title, 0, 5);
				return implode(',', $title);
			}
		}
		
		return '';
	}
	
	public function get_recent_played_games(){
		$cache = Database_Query::$cache;
		
		$token = md5('PLAYED_GAMES_' . 
					 $this->id .  
					 \cache::$namescope->key(\ORM::factory('activitygameplay')->_table_name()));
					
		
		if (false === ($games_he_played = $cache->get($token, false)))
		{
			$he_played = $this->activities->where("template_id","=",ACTIVITY_GAME_IS_PLAYING)->order_by("date_added","desc")->find_all();

			$games_he_played = array();

			foreach($he_played as $game){
				$game = json_decode($game->data,true);
				if(!empty($game["game_id"])){
					$games_he_played[] = $game["game_id"];
				}
			}

			$cache->set($token, $games_he_played, \Date::DAY);
		}
		
		$gamewhitelist = \orm::factory("gamewhitelist")->domain_list;
		//$games_he_played = array_intersect($games_he_played,$gamewhitelist);
		
		return \orm::factory("game")
					->join(\ORM::factory('activitygameplay')->_table_name(),"inner")
					->on(\ORM::factory('activitygameplay')->_table_name() . ".game_id","=", \orm::factory("game")->_table_name() . ".id")
					->where(\orm::factory("game")->_table_name() . ".id","in", !empty($games_he_played) ? $games_he_played : array("0"))
					->where(\orm::factory("game")->_table_name() . ".id","in",$gamewhitelist)
					->group_by(\orm::factory("game")->_table_name() . ".id")
					->order_by(\db::expr("max(" . \ORM::factory('activitygameplay')->_table_name() . ".date_added)"),"desc")
					->cached(\Date::HOUR);

		
	}

	public function get_common_games($user_id){

		$user = orm::factory("user")->where("id","=",$user_id)->find();

        $domain = Orm::factory('domain');
        $domain_id = $domain->current;

		$cache = Database_Query::$cache;
		
		//added by Romeo
		$token = md5(\cache::$namescope->key('SOCIAL_GAMES') . \cache::$namescope->key('CASUAL_GAMES'). $this->id . "whitelist");
		if (false === ($inactivegames = $cache->get($token, false)))
		{
			//modiefied by Romeo:
			//change to accommodate the new game white list table structure
			$inactivegames_casual = orm::factory("casualgame")->where("is_active","=","0")->cached(Date::WEEK)->find_all();
			$inactivegames_casual =  explode(",",orm::parse($inactivegames_casual));
			
			$inactivegames_social = orm::factory("socialgame")->where("is_maintenance","=","1")->cached(Date::WEEK)->find_all();
			$inactivegames_social =  explode(",",orm::parse($inactivegames_social));
			
			$inactivegames = array_unique(array_merge($inactivegames_casual, $inactivegames_social));

			$cache->set($token, $inactivegames, \Date::WEEK);
			
		}
		
		if (false === ($games_he_played = $cache->get('PLAYED_GAMES_' . $user_id, false)))
		{
			$he_played = $user->activities->where("template_id","=",ACTIVITY_GAME_IS_PLAYING)->order_by("date_added","desc")->find_all();

			$games_he_played = array();

			foreach($he_played as $game){
				$game = json_decode($game->data,true);
				if(!empty($game["game_id"])){
					$games_he_played[] = $game["game_id"];
				}
			}

			$cache->set('PLAYED_GAMES_' . $user_id, $games_he_played, \Date::WEEK);
		}

		if (false === ($games_i_played = $cache->get('PLAYED_GAMES_' . $this->id, false)))
		{
			$i_played = $this->activities->where("template_id","=",ACTIVITY_GAME_IS_PLAYING)->order_by("date_added","desc")->find_all();

			$games_i_played = array();

			foreach($i_played as $game){
				$game = json_decode($game->data,true);
				if(!empty($game["game_id"])){
					$games_i_played[] = $game["game_id"];
				}
			}

			$cache->set('PLAYED_GAMES_' . $this->id, $games_i_played, \Date::WEEK);

		}

		if (false === ($common_games = $cache->get('PLAYED_GAMES_' . $this->id . "_" . $user_id . "_" . $domain_id, false)))
		{
			$game_we_both_played = array_intersect($games_he_played,$games_i_played);
			$game_we_both_played = array_diff($game_we_both_played, $inactivegames);
			if(count($game_we_both_played) <= 0) $game_we_both_played = array('0');

			$common_games = orm::factory("game")
									->available
									->where('id','in',$game_we_both_played)->limit(10)->find_all()->as_array();
			$cache->set('PLAYED_GAMES_' . $this->id . "_" . $user_id . "_" . $domain_id, $common_games, \Date::WEEK);
		}



		return $common_games;

	}

    public function get_suggested_friends_by_country($country, $limit=50){
        $friends = $this->get_suggested_friends($limit * 2);
        $friend_ids = array();
        foreach($friends as $friend){
            $friend_ids[] = $friend->id;
        }

        $select = \DB::select('id');
        $select->from("user_infos");
        $select->where("user_infos.id", "in", $friend_ids);
        $select->where("user_infos.country_id", "=", $country);
        $select->limit($limit);
        $friends = $select->execute()->cached(\Date::HOUR)->as_array();
        unset($select);

        $friend_count = count($friends);

        if($friend_count == $limit){
            $result_list = $friends;
        }else{
            $sub_friends = $this->_get_friends_by_country($country, $friends, ($limit - $friend_count));
            $result_list = array_unique(array_merge($friends, $sub_friends));
            $result_list = array_slice($result_list, 0, $limit);
        }

		$friends = orm::factory("user")
						->distinct(true)
						->where("id", "in", $result_list)
	                    ->limit($limit)
						->cached(\Date::DAY)
						->find_all()
						->as_array();
		shuffle($friends);
        return $friends;
    }

	public function get_suggested_friends($limit=50, $ignore_list = array())
    {
 		$excluded_ids = array(101284,6829150,6829156,6829161);
        $active_users = $this->_get_active_users($excluded_ids, 1000);

		$exception = array(0);

    	if($this->loaded()){
    		
    		$userinfo = $this->info;
    		
    		$cache = \Database_Query::$cache;
        	$token = md5($userinfo->pending_details["friend_request_sent"] . $userinfo->friend_ids . SERVER_NAME . $limit);
    		
    		if (false === ($friends = $cache->get($token, false)))
			{
				// step 0 get exception include pending request & friend & excluded ids 
				$pending_request = explode(",", $userinfo->pending_details["friend_request_sent"]);
				$myfriendslist = explode(",", $userinfo->friend_ids);
			    $exception = array_unique(array_merge($myfriendslist, $pending_request, $excluded_ids, array($this->id)));
	
	            unset($pending_request);
	            unset($myfriendslist);
	
			    $active_users = array_diff($active_users, $exception);
	
				// step 1 get active friends of my friends
	            $friend_of_a_friend = !empty($userinfo->friend_ids) ? $this->_get_friend_of_a_friend($userinfo, $active_users, $exception, $limit * 2) : array("0");
	    		// step 2 get all users that are tag fly
	            $similar_people = !empty($this->tag_ids) ? $this->_get_similar_people($exception, $limit) : array("0");
	            // step 3 intersect the similar people
	            $result_list =  array_intersect($similar_people, $friend_of_a_friend);
	
				$result_list = (count($result_list) > 0 and $result_list[0] != 0) ? $result_list :  array_merge($similar_people, $friend_of_a_friend);
				$result_list =  array_unique($result_list);
	            
	            unset($exception);
				unset($friend_of_a_friend);
				unset($similar_people);
	
				if(count($result_list) < $limit){
	                $result_list = array_unique(array_merge($result_list, $active_users));
				}
				unset($active_users);
				
				if (count($ignore_list) > 0)
				{
					$result_list = array_diff($result_list, $ignore_list);
				}
				
				shuffle($result_list);
				$result_list = array_slice($result_list, 0, $limit);
	
				//get friend of my friends that are not my friends
				$friends =  orm::factory("user")
							->distinct(true)
							->where("id","in",!empty($result_list) ? $result_list : array("0"))
							->limit($limit)
							->cached(\Date::DAY)
							->find_all()
							->as_array();
							
	            unset($result_list);
				$cache->set($token, $friends, \Date::DAY);
			}


			shuffle($friends);
			
			return $friends;
    	}
		else
		{	
			if (count($ignore_list) > 0)
			{
				$active_users = array_diff($active_users, $ignore_list);
			}
			
    		shuffle($active_users);
    		$active_users = array_slice($active_users, 0, $limit);
    	
			$users = orm::factory("user")
						->join('user_infos')
						->on('users.id','=', 'user_infos.id')
						->distinct(true)
						->where('country_id', 'IS NOT', NULL)
						->where("users.id","in",!empty($active_users) ? $active_users : array("0"))
						->order_by("users.id","desc")
						->cached(\Date::WEEK)
						->limit($limit)
						->find_all()
						->as_array();

			unset($active_users);
			
			return $users;
    	}
	}
	
	/**
	 * Returns list of active users and friends of your friends who are not your friends
	 *
	 * @param 	int 	$limit 	No. of strangers
	 * @return 	array
	 */
	public function get_active_strangers($limit = 1000)
	{
		//removed matchmove admin and snoopdogg's admin accounts
		$excluded_ids = array(101284,6829150,6829156,6829161);
        $active_users = $this->_get_active_users($excluded_ids, 1000);
		$exception = array();
		
		$userinfo = $this->info;
		
		// step 1. get pending friend requests and your friends and $excluded_ids
		$pending_request = explode(",", $userinfo->pending_details["friend_request_sent"]);
		$myfriendslist = explode(",", $userinfo->friend_ids);
		$exception = array_unique(array_merge($myfriendslist, $pending_request, $excluded_ids, array($this->id)));

		unset($pending_request);
		unset($myfriendslist);

		$active_users = array_diff($active_users, $exception);

		// step 1 get active friends of my friends
		$friend_of_a_friend = !empty($userinfo->friend_ids) ? $this->_get_friend_of_a_friend($userinfo, $active_users, $exception, $limit * 2) : array();
		
		// step 2 get all users that are tag fly
		$similar_people = !empty($this->tag_ids) ? $this->_get_similar_people($exception, $limit) : array();
		
		// step 3 intersect the similar people
		$result_list =  array_intersect($similar_people, $friend_of_a_friend);

		$result_list = (count($result_list) > 0 and $result_list[0] != 0) ? $result_list :  array_merge($similar_people, $friend_of_a_friend);
		$result_list =  array_unique($result_list);
		
		unset($exception);
		unset($friend_of_a_friend);
		unset($similar_people);

		$result_list = array_unique(array_merge($result_list, $active_users));
		unset($active_users);

		shuffle($result_list);
		$result_list = array_slice($result_list, 0, $limit);
		
		return $result_list;
	}
	
	
	public function get_global_auto_suggest($keyword="", $sort="asc", $limit=5)
	{
		
		$cache = \Database_Query::$cache;
    	$myfriends = array();
    	$userinfo = $this->info;
		
		$results = array("0");
		
		if (false === ($peopleCollection = $cache->get('SEARCH_' . $keyword, false))){	
			
			$users = $this
					->get_filtered($keyword)
                    ->limit($limit)
                    ->find_all()
                    ->as_array();
			
			$peopleCollection = array();
			foreach ($users as $user) {
					$peopleCollection[] = array(
						'value'  => $user->id,
						'name'  => ucwords(\text::limit_chars($user->full_name,25,"..")),
						'link'  => $user->link,
						'image'  => $user->thumbnail,
						'desc'  =>   $user->info->country_name
					);
			}
			
			unset($users);
			$cache->set('SEARCH_' . $keyword, $peopleCollection , \Date::MONTH);
		}

		return $peopleCollection;
	}
	
	

	public function _preloadfriends(){
		
		if(!$this->loaded()){
			return array("0");
		}
		
		$cache = Database_Query::$cache;
    	$myfriends = array();

    	$token = md5('FRIENDS' .
    	    	 $this->info->friend_ids .  
    			 $this->id);
    
    	if (false === ($myfriends = $cache->get($token, false)))
		{	
			$userinfo = $this->info;
			$entities = array("0");
			$friends = explode(",",$userinfo->friend_ids);
			$friends = array_unique($friends);
			$friends = array_filter($friends, 'strlen');

			// query too big for ORM
			$max = 1000;
			$count = count($friends);
			
			for($x=0 ; $x<($count/$max); $x++) {
				$smaller_set = $friends;
				$smaller_set = array_splice($smaller_set, ($x*$max), $max);

				if(count($smaller_set) > 0){
					$select = \DB::select('id','full_name');
					$select->from("users");
					$select->where("id","in",$smaller_set);
					$results = $select->execute()->cached(\Date::MONTH)->as_array();	
					
					unset($select);
					
					foreach($results as $friend){
						$myfriends[] = $friend;
					}
				}
			}
			$cache->set($token, $myfriends, \Date::DAY);
		}
		
		return $myfriends;

	}

	

	public function _quick_search_friend($keyword){
		$cache = Database_Query::$cache;

		if(!$this->loaded()){
			return array("0");
		}

		
		
		$results = array("0");
		
		$myfriends = $this->_preloadfriends();
		
		$token = md5('FRIENDS SEARCH' .
	    	    	 $this->info->friend_ids .  
	    	    	 $keyword . 
	    			 $this->id);

		if (false === ($results = $cache->get($token, false))){	
			foreach($myfriends as $friend){
				if(strpos(strtolower($friend["full_name"]), strtolower($keyword)) !== false){
					$results[] = $friend["id"];
				}
			}
			$results = is_array($results) ? $results : array($results);
			$cache->set($token, $results , \Date::DAY);
		}

		return $results;
	}
	
	

	public function get_friends_auto_suggest($keyword="", $sort="asc", $limit=5)
	{
		
		$cache = Database_Query::$cache;
    	$myfriends = array();
    	$userinfo = $this->info;
    	$token = sha1($userinfo->friend_ids . $this->id);
    	
		$results = $this->_quick_search_friend($keyword);
				
        $users = orm::factory("user")->where("id","in",$results)
        			->order_by('full_name', $sort)
                    ->cached(\Date::MONTH)
                    ->limit($limit)
                    ->find_all()
                    ->as_array();
			
		$peopleCollection = array();
		foreach ($users as $user) {
				$peopleCollection[] = array(
					'value'  => $user->id,
					'name'  => ucwords(\text::limit_chars($user->full_name,25,"..")),
					'link'  => $user->link,
					'image'  => $user->thumbnail,
					'desc'  =>   $user->info->country_name
				);
		}
			


		return $peopleCollection;
	}



    public function save(Validation $validation = NULL)
    {
        if (array_key_exists('password', $this->_changed))
        {
            $this->_object['password'] = Auth::instance()->hash_password($this->_object['password']);
        }

        return parent::save($validation);
    }

	public function is_tester()
	{
		if(!$this->loaded()){
			return false;
		}

	   $o_testuser = orm::factory('testuser')->cached(\Date::DAY)->where('user_id', '=', $this->id)->find();
	   return $o_testuser->loaded();
	}

	public function set_affinity($mode){
		if(!$this->loaded()){
			return false;
		}

		$auth = auth::instance();
		$entity_id = $auth->logged_in() ? $auth->get_user()->entity_id : 0;

		if($entity_id == 0){
			return false;
		}

		if($entity_id == $this->entity_id)
		{
			return false;
		}

		switch($mode){
			case "add":
							$value = 4;
							$associate = orm::factory("associate")
								->where("entity_id1","=",$entity_id)
								->where("entity_id2","=",$this->entity_id)
								->cached(\DATE::MINUTE)
								->find();

							if(!$associate->loaded()){
								$associate = orm::factory("associate");
								$associate->affinity = $value;
							}
							
							
							$associate->entity_id1 = $entity_id;
							$associate->entity_id2 = $this->entity_id;
							if($entity_id != $this->entity_id){
								$associate->affinity = $associate->affinity + ($value);
							}
							$associate->save();
							return true;
							break;
			case "comment":
							$value = 3;
							break;
			case "post":
							$value = 5;
							break;
			case "visit":
							$value = 1;
							break;
			case "like":
							$value = 2;
							break;
			case "unlike":
							$value = -2;
							break;
			default:
							$value = 1;
							break;
		}

		$associate = orm::factory("associate")
					->where("entity_id1","=",$entity_id)
					->where("entity_id2","=",$this->entity_id)
					->cached(\DATE::MINUTE)
					->find();

		if($associate->loaded()){
		
			if($entity_id != $this->entity_id){
				$associate->affinity = $associate->affinity + ($value);
				$associate->auto_flush(false);
				$associate->save();

			}
		}
	}



	/**
	 * search players based on given keyword
	 *
	 * @param	string	needle
	 * @return	object	ORM result object (sorted by recency via the id column)
	 *
	 */
	public function get_filtered( $s_needle )
	{
		$o_return = orm::factory('user')
				->cached(\Date::DAY)
				->where('full_name','like','%'.$s_needle.'%')
				->where('is_searchable','=','1')
				->where('is_active','=','1')
				->order_by('users.id','DESC');


		return $o_return;
	}

	public function search($needle, $field = 'full_name')
	{
		return $this->cached(\Date::DAY)
            ->where($field,'like','%'. $needle .'%')
            ->searchables;
    }

    public function get_searchables()
	{
		return $this->where('is_searchable','=','1')
            ->where('is_active','=','1');
    }

	/**
	 * search players based on given keyword AND school/workplace/other tag names
	 *
	 * @param	string	needle
	 * @param	string	tag name (school, workplace)
	 * @param	string	tag type (school, workplace)
	 * @return	object	ORM result object (sorted by recency via the id column)
	 *
	 */
	public function get_filtered_tag( $s_needle, $s_tag, $s_type )
	{
		$o_tags = orm::factory($s_type)
				->where('name','like','%'.$s_tag.'%');
		$a_tags = $o_tags->cached(\Date::DAY)->find_all()->as_array();

		$a_tag_ids = array();

		for ( $i = 0 ; $i < count( $a_tags ) ; $i++ )
		{
			if ( $a_tags[$i]->tag_id )
			{
				$a_tag_ids[] = $a_tags[$i]->tag_id;
			}
		}

		$a_entity_ids = array();
		if ( count($a_tag_ids) )
		{
			$o_entities = orm::factory('tagentities');
			$a_entities	= $o_entities->where('tag_id','IN',$a_tag_ids)->cached(\Date::DAY)->find_all()->as_array();
			for ( $i = 0 ; $i < count( $a_entities ) ; $i++ )
			{
				 $a_ids = explode(',',trim($a_entities[$i]->entity_ids,', '));
				 if ( count($a_ids) )
				 {
				 	$a_entity_ids = array_unique( array_merge( $a_entity_ids, $a_ids ) );
				 }
			}

		}

		if ( count($a_entity_ids) )
		{
			$a_user_entities = orm::factory('entities')->where('type_id','=','1')->where('id','IN',$a_entity_ids)->cached(\Date::DAY)->find_all()->as_array();
			$a_includes = array();
			for ( $i = 0; $i < count($a_user_entities); $i++ )
			{
				$a_includes[] = $a_user_entities[$i]->id;
			}
		}
		if ( empty($a_includes) )
		$o_return = false;
		else
		$o_return = orm::factory('user')
				->where('full_name','like','%'.$s_needle.'%')
				->where('is_searchable','<>','0')
				->where('is_active','=',1)
				->where('entity_id','IN',$a_includes);
		return $o_return;
	}


	/**
	 * search players based on given keyword AND country code (iso2)
	 *
	 * @param	string	needle
	 * @param	string	country code iso2
	 * @return	object	ORM result object (sorted by recency via the id column)
	 *
	 */
	public function get_filtered_country( $s_needle, $s_country_code )
	{
		return $this
				->get_filtered( $s_needle )
				->join('user_infos','LEFT')
				->on('user_infos.id', '=', 'users.id')
				->join('countries','LEFT')
				->on('user_infos.country_id', '=', 'countries.id')
				->where('iso2', '=', $s_country_code);
	}

	public function get_affinity(){
		if(!$this->loaded()){
			return false;
		}

		$auth = auth::instance();
		$entity_id = $auth->logged_in() ? $auth->get_user()->entity_id : 0;

		if($entity_id == 0){
			return false;
		}

		$associate = orm::factory("associate")->where("entity_id1","=",$entity_id)->where("entity_id2","=",$this->entity_id)->find();
		if($associate->loaded()){
			return $associate->affinity;
		}else{
			$associate = orm::factory("associate");
			$associate->entity_id1 = $entity_id;
			$associate->entity_id2 = $this->entity_id;
			$associate->affinity = 0;
		}
		$associate->save();
		return $associate->affinity;
	}


    public function add_pending_friend($friend_id) {
		if(!$this->loaded()){
			return false;
		}
		

		
		$friend = orm::factory("userinfo")->where("id","=",$friend_id)->find();
		$userinfo = $this->info;
		
		if($userinfo->friends_count <= \ORM::factory('friend')->user( $this )->friends_limit() and 
		   $friend->friends_count   <= \ORM::factory('friend')->user( orm::factory("user",$friend_id) )->friends_limit()){
		
            $a_friend = $userinfo->pending_details;
            $c_csv = new \CSV($a_friend['friend_request_sent']);
            $c_csv->add($friend->id);
            $s_friend = $c_csv->as_string();
            $a_friend['friend_request_sent'] = $s_friend;
            $userinfo->pending_details = $a_friend;
            $userinfo->save();

			$a_friend = $friend->pending_details;
            $c_csv = new \CSV($a_friend['friend_request_received']);
            $c_csv->add($userinfo->id);
            $s_friend = $c_csv->as_string();
            $a_friend['friend_request_received'] = $s_friend;
            $friend->pending_details = $a_friend;
            $friend->save();
		
			$friend = orm::factory("user")->where("id","=",$friend_id)->find();
			$friend->affinity ="add";
            $friend->save();
			
			//this will removed the entry on suggested_friends table
			$recommended_friends = \ORM::factory('suggestedfriend')
									->where('user_id', '=', $this->id)
									->where('friend_id', '=', $friend_id)
									->find();
			if ($recommended_friends->loaded())
			{
				$recommended_friends->delete();
			}
			
			\Cache::$namescope->flush(\ORM::factory('suggestedfriend')->_table_name());
            \Activity::create('100',$this,$friend,\Helper_date::sql_now());
		}
    }

    public function remove_pending_friend($friend_id) {
    	if(!$this->loaded()){
			return false;
		}

		//stp 1 remove from friend request
		$userinfo = $this->info;
		$pending = $userinfo->pending_details;
		$csv = new CSV($pending["friend_request_received"]);
		$csv->delete($friend_id);
		$pending["friend_request_received"] = $csv->as_string();
		$userinfo->pending_details = $pending;
		$userinfo->save();

		// remove  me from the sent friend request since i already rejected
		$friend = orm::factory("userinfo")->where("id","=",$friend_id)->find();
        if($friend_id > 0 && $friend->loaded()){
		    $pending = $friend->pending_details;
		    $csv = new CSV($pending["friend_request_sent"]);
		    $csv->delete($this->id);
		    $pending["friend_request_sent"] = $csv->as_string();
		    $friend->pending_details = $pending;
		    $friend->save();
        }

    }


    public function add_friend($friend_id) {
        $userinfo = $this->info;
		
		$this->remove_pending_friend($friend_id);
		
		if (!$userinfo->loaded())
        {
            return false;
        }
        
        if($userinfo->friends_count <= \ORM::factory('friend')->user($this)->friends_limit()){
        
	        $csv = new \Csv($userinfo->friend_ids);
	        $csv->add($friend_id);
	        $userinfo->friend_ids = $csv->as_string();
	        $userinfo->friends_count = $csv->count();
	        $userinfo->save();
	
	
			 // add me to his or her friends list
			$friend = orm::factory("userinfo")->where("id","=",$friend_id)->find();
			$csv = new CSV($friend->friend_ids);
			$csv->add($this->id);
			$friend->friend_ids = $csv->as_string();
			$friend->friends_count = $csv->count();
			$friend->save();
	
	
	
	        // friends
	        $friend_orm = \ORM::factory('friend')->cached(false)
	                    ->where('user_id', '=', $this->id)
	                    ->where('friend_id', '=', $friend_id)
	                    ->find();
	
	        if (!$friend_orm->loaded()) {
	        	$friend_orm = \ORM::factory('friend');
	            $friend_orm->user_id = $this->id;
	            $friend_orm->friend_id = $friend_id;
	            $friend_orm->save();
	        }
	
	        // friends
	        $friend_orm = \ORM::factory('friend')->cached(false)
	                    ->where('user_id', '=', $friend_id)
	                    ->where('friend_id', '=', $this->id)
	                    ->find();
	
	        if (!$friend_orm->loaded()) {
	        	$friend_orm = \ORM::factory('friend');
	            $friend_orm->user_id = $friend_id;
	            $friend_orm->friend_id = $this->id;
	            $friend_orm->save();
	        }
	
	
	        // add my recent 10 post to his message watch list;
	        $friend = orm::factory("user")->where("id","=",$friend_id)->find();
	        $this->watch($friend->entity_id);
	        // add his recent 10 post to my message watch list;
			$friend->watch($this->entity_id);
			
			$friend = orm::factory("user")->where("id","=",$friend_id)->find();
			$friend->affinity ="add";
            $friend->save();
			
			\Activity::create('101',$this,$friend,\Helper_date::sql_now());
        }else{
        	return false;
        }
        
        return true;
    }


	public function unwatch($entity_id){
    	if(!$this->loaded()){
			return false;
		}

    	$entitymessage = orm::factory("entitymessage")->where("entity_id","=",$this->entity_id)->find();

		$select = \DB::select('id');
		$select->from("messages");
		$select->where("id","in",explode(",",!empty($entitymessage->message_ids) ? $entitymessage->message_ids : ""));
		$select->where("from_id","=",$entity_id);
		$select->where("from_id","=",db::expr("to_id"));
		$select->where("parent_id","=","0");
		$select->where("media_type_id","not in",array("5"));
		$result = $select->execute()->cached(\Date::HOUR)->as_array();
		
		unset($select);
		
		if(count($result) == 0){
			return false;
		}
						
		$result = \orm::array_value_recursive("id",$result);
		
		if(!is_array($result)){
			$result = array($result);
		}
		
		$csv = array("0");
		
		if(count($result) > 0){
			if($entitymessage->loaded()){
				$csv = explode(",",$entitymessage->message_ids);
			}

			$csv = array_diff($csv,$result);
			$csv = is_array($csv) ? $csv : array("0");
			
			if(count($csv) > 1){
				$entitymessage->message_ids = implode(",", $csv);
				$entitymessage->save();
			}
			
		}
	}


    public function watch($entity_id){
    	if(!$this->loaded()){
			return false;
		}

    	$entitymessage = orm::factory("entitymessage")->where("entity_id","=",$this->entity_id)->find();

		$select = \DB::select('id');
		$select->from("messages");
		$select->where("from_id","=",$entity_id);
		$select->where("from_id","=",db::expr("to_id"));
		$select->where("parent_id","=","0");
		$select->where("media_type_id","not in",array("5"));
		$select->limit(10);
		$select->order_by("id","desc");
		$result = $select->execute()->cached(\Date::HOUR)->as_array();
		
		unset($select);
		
		if(count($result) == 0){
			return false;
		} 
		
		$result = \orm::array_value_recursive("id",$result);
		
		if(!is_array($result)){
			$result = array($result);
		}
		
		
		$csv = array("0");
		if(count($result) > 0){
			if($entitymessage->loaded()){
				$csv = explode(",",$entitymessage->message_ids);
			}else{
				$entitymessage = orm::factory("entitymessage");
				$entitymessage->entity_id = $this->entity_id;
			}
			
			$csv = array_merge($csv,$result);
			$csv = is_array($csv) ? $csv : array("0");
			
			if(count($csv) > 1){
				$entitymessage->message_ids = implode(",", $csv);
				$entitymessage->save();
			}
			
		}
	}


    public function get_user_by_id( $user_id ){
		if($this->loaded()){
			$this->clear();
		}

        $users = $this
            ->where( "id", "=", $user_id )
            ->find();

        if( !isset ( $users->id ))
            return false;

        return $users;
	}

    public function get_user_by_username( $username )
    {
        if($this->loaded()){
			$this->clear();
		}

        $users = $this
            ->where( "username", "=", $username )
            ->find();

        if( !isset ( $users->id ))
            return false;

        return $users;
    }

	public function get_recently_joined()
	{
		return $this
			->cached(\Date::WEEK)
			->where('image_url', '!=', 'photoDefaultSmall.jpg')
			->where('image_url', '!=', '')
			->order_by('id', 'desc');
	}

    public function get_user_by_username_or_userid( $username )
    {
        if($this->loaded()){
			$this->clear();
		}

        $users = $this
            ->where( "username", "=", $username )
            ->or_where( 'id', "=", $username )
            ->find();

        if( !isset ( $users->id ))
            return false;

        return $users;
    }
    
    public function get_suggested_friends_usa($limit=50)
    {
    	$domain = array(42,49,50,51);
    	return $this->get_suggested_friends_by_domains($limit, $domain);
    }

    public function get_suggested_friends_dst($limit=50)
    {
        $domain = array(27);
    	return $this->get_suggested_friends_by_domains($limit, $domain);
    }

    public function get_suggested_friends_uk($limit=50)
    {
        $domain = array(70);
    	return $this->get_suggested_friends_by_domains($limit, $domain);
    }

    /**
	 * get the limit users from users table by domain 
	 *
	 * @param	int     the limit user
	 * @return	array   the user array
	 *
	 */
    public function get_suggested_friends_by_domains($limit=50, $domain = array(0)){
    
        $exception = array(0);
    	if($this->loaded()){
    		// get user info
    		$userinfo = \orm::factory("userinfo")->where("id","=",$this->id)->cached(false)->find();
			$pending_request = json_decode($userinfo->pending, true);
			$pending_request = $pending_request["friend_request_sent"];
			$pending_request = explode(",", $pending_request);
			
			
						// step 1 get all friends of my friends
			$myfriendslist = array(0);

			if(!empty($userinfo->friend_ids)){
				$myfriendslist = explode(",",$userinfo->friend_ids);

				$exception = array_merge($myfriendslist,$pending_request,array($this->id));

				$friends = orm::factory("userinfo")
						->select("users.id")
                        ->join("users")
                        ->on("users.id", "=", "user_infos.id")
						->where("users.id", "in", array_slice($myfriendslist,0,$limit * 2))
                        ->where("users.domain_id", "in", $domain)
						->find_all();

				$acquaintance = array(0);
				foreach($friends as $user)
	            {
	            	$acquaintance = array_merge($acquaintance,explode(",", $user->friend_ids));
	            }


	            shuffle($acquaintance);


	            // step 2 exclude your friends from the list to get the "friend of a friend that are not my friends"
	    		$friend_of_a_friend =  array_diff($acquaintance, $exception);

	            unset($friends);


			}else{
				$friend_of_a_friend = array(0);
				$exception = array_merge($pending_request,array($this->id));
			}

			// ********************************* //
    		// step 5 get all users that are tag similarly
    		$similar_people_list = array(0);


    		if(!empty($this->tag_ids)){
				$tagids = explode(",",$this->tag_ids); shuffle($tagids);
	    		$tagids = array_slice($tagids,0,$limit * 2);
	    		$entities =  orm::factory("tagentities")
	    					->where("tag_id","in",$tagids)
	    					->cached(\Date::DAY)
	    					->find_all();


				foreach($entities as $entity)
	            {
	            	$similar_people_list = array_merge($similar_people_list,explode(",", $entity->entity_ids));
	            }
	            shuffle($similar_people_list);

				unset($entities);


	            $similar_people =  orm::factory("user")
	    							->where("entity_id","in",$similar_people_list)
	    							->where("domain_id", "in", $domain)
	    							->where("id","not in", $exception)
	    							->cached(\Date::DAY)
	    							->find_all();



	    		$similar_people = count($similar_people) > 0 ? orm::parse($similar_people,'array') : array(0);

	    		$similar_people =  array_diff($similar_people, $exception);

    		}else{
    			$similar_people = array(0);
    		}

            // intersect the similar people
            $result_list =  array_intersect($similar_people, $friend_of_a_friend);
			$result_list =  array_unique($result_list);

			$result_list = (count($result_list) > 0 and $result_list[0] != 0) ? $result_list :  array_merge($similar_people,$friend_of_a_friend);
			$result_list =  array_unique($result_list);

			unset($similar_people);
			unset($friend_of_a_friend);
			if(count($result_list) == 1 and $result_list[0] == 0)
			{
				$users = orm::factory("user")
						->where("image_url","!=","photoDefaultSmall.jpg")
						->where("image_url","!=","")
                        ->where("domain_id", "in", $domain)
						->where("id","not in",$exception)
						->order_by("id","desc")
						->cached(\Date::WEEK)
						->limit(30)
						->find_all()
						->as_array();

	    		shuffle($users);

				return array_slice($users,0,$limit);
			}else{

                shuffle($result_list);

                $result_list = array_slice($result_list,0,$limit * 2);

                //get friend of my friends that are not my friends
                $friends =  orm::factory("user")
							->fetch_by_csv(implode(",", $result_list))
                            ->where("domain_id", "in", $domain)
                            ->where("id","not in",$exception)
							->limit($limit * 2)
							->cached(\Date::DAY)
							->find_all()
							->as_array();
				shuffle($friends);
						
				return array_slice($friends,0,$limit);

			}
    	}else{
			$users = orm::factory("user")
					->where("image_url","!=","photoDefaultSmall.jpg")
					->where("image_url","!=","")
                    ->where("domain_id", "in", $domain)
                    ->where("users.id","not in",$exception)
					->order_by("id","desc")
					->cached(\Date::WEEK)
					->limit($limit * 2)
					->find_all()
					->as_array();

			shuffle($users);

			return array_slice($users,0,$limit);
    	}
	}

    public function get_mcash_request()
    {
    	if(!$this->loaded()){
    		return false;
    	}
    	$o_tum = \orm::factory('testusermcash')->where('user_id', '=', $this->id)->find();
    	return $o_tum;
    }

	public function get_domain() {
        $obj = \ORM::factory('domain', $this->domain_id);
        if (!$obj->loaded()) {
        	$obj = orm::factory('domain');
        	$obj->id = $this->domain_id;
        }
        return $obj;
	}

	public function get_date_added_as_friend($friend_id) {
		$obj = \ORM::factory('friend')->where('user_id', '=', $this->id)->where('friend_id', '=', $friend_id)->find();
        if ($obj->loaded()) {
        	$date_added = $obj->date_added;
        } else {
			$obj = \ORM::factory('friend')->where('user_id', '=', $friend_id)->where('friend_id', '=', $this->id)->find();
	        if ($obj->loaded()) {
	        	$date_added = $obj->date_added;
	        } else {
		        $date_added = '';
	        }
        }
		return $date_added;
	}
	
	/**
	 * This function will return a list of users who recently logged in, else recently joined.
	 *
	 * @return object
	 */
	public function recently_logged_in($limit = 11)
	{
		$result = $this->join('user_infos')
					->on('users.id', '=', 'user_infos.id')
					->where(DB::Expr('DATE(user_infos.date_last_login)'), '=', DB::Expr('DATE(NOW())'))
					->cached(\Date::HOUR)
					->order_by('user_infos.date_last_login', 'DESC')
					->limit($limit)
					->find_all();
					
		if(count($result) > 0)
		{
			return $result;
		}
		else
		{
			return $this->cached(\Date::WEEK)
				->where('image_url', '!=', 'photoDefaultSmall.jpg')
				->where('image_url', '!=', '')
				->cached(\Date::HOUR)
				->order_by('id', 'desc')
				->limit(8)
				->find_all();
		}
	}


    // Get users with avatars orderby last login time 
    private function _get_active_users($excluded_ids, $limit = 5000){
    	//$cache = \Kohana::sys_cache();
		$cache = Database_Query::$cache; 

    	if (false === ($active_users = $cache->get('ACTIVE_USER_WITH_PHOTO', false))){
    	
			$user_id = \DB::select('id')
						->from("user_infos")
						->where("user_infos.date_last_login",">=", \db::expr("DATE_SUB(NOW(),INTERVAL 1 MONTH)"))
						->limit(5000)
						->execute()
						->cached(\Date::MONTH)
						->as_array();
					
			$user_id = \orm::array_value_recursive("id",$user_id);
			$user_id = is_array($user_id) ? $user_id : array($user_id);
			
			
			$active_users = \DB::select('id')
						->from("users")
						->where("users.id","in",$user_id)
						->where("users.image_url","!=","photoDefaultSmall.jpg")
						->where("users.image_url","!=","")
						->limit($limit)
						->execute()
						->cached(\Date::MONTH)
						->as_array();
			
			$active_users = \orm::array_value_recursive("id",$active_users);
			$active_users = is_array($active_users) ? $active_users : array($active_users);
			$active_users = array_filter($active_users, 'strlen');
			shuffle($active_users);

			$cache->set('ACTIVE_USER_WITH_PHOTO', $active_users, \Date::DAY);

			unset($select);
		}

        return array_diff($active_users, $excluded_ids);

    }

    private function _get_friend_of_a_friend($userinfo, $active_users, $exception, $limit = 100){
        $acquaintance = array(0);
        $friends = $this->_get_friends($userinfo, $limit);
        foreach($friends as $user){
            $user_friends = explode(',', $user['friend_ids']);

            if(count($user_friends) > $limit){
                shuffle($user_friends);
                $user_friends = array_slice($user_friends, 0, $limit);
            }
            $acquaintance = array_merge($acquaintance, $user_friends);
            $acquaintance = array_unique($acquaintance); 
        }

        $acquaintance = array_intersect($acquaintance, $active_users);

        $acquaintance = array_diff($acquaintance, $exception);
        shuffle($acquaintance);

        return array_slice($acquaintance, 0, $limit);
    }

    private function _get_friends($userinfo, $limit){

    	//$cache = \Kohana::sys_cache();
		$cache = Database_Query::$cache; 
        $cache_key = 'FRIEND_OF_FRIEND_' . $this->id . MD5($userinfo->friend_ids);
        if (false === ($friends = $cache->get($cache_key, false))){

			$myfriendslist = explode(",", $userinfo->friend_ids);
            shuffle($myfriendslist);
            $myfriendslist = array_splice($myfriendslist, 0, $limit);
            // change to query builder orm to slow for big queries
            $select = \DB::select('friend_ids');
            $select->from("user_infos");
            $select->where("user_infos.id", "in", !empty($myfriendslist) ? $myfriendslist : array(0));
            $select->limit($limit);
            $friends = $select->execute()->cached(\Date::HOUR)->as_array();

            $cache->set($cache_key, $friends, \Date::HOUR);

        }
        return $friends;
    }

    private function _get_similar_people($exception, $limit){
        $similar_people_list = array("0");
        $tagids = explode(",", $this->tag_ids); 
        shuffle($tagids);
        $tagids = array_slice($tagids, 0, $limit * 3);
	    		
		$entities = \DB::select('entity_ids');
		$entities->from("tag_entities");
		$entities->where("tag_id", "in", $tagids);
		$entities = $entities->execute()->cached(\Date::HOUR)->as_array();	
		foreach($entities as $entity){
       	    $similar_people_list = array_merge($similar_people_list, explode(",", $entity["entity_ids"]));
        }
        $similar_people_list = array_unique($similar_people_list);

        if(count($similar_people_list) > $limit * 10){
            shuffle($similar_people_list);
            $similar_people_list = array_slice($similar_people_list, 0, $limit * 10);
        }

        $select = \DB::select('id');
        $select->from("users");
        $select->where("users.id", "in", !empty($similar_people_list) ? $similar_people_list : array("0"));
        $select->where("users.id", "not in", $exception);
        $select->where("image_url","!=","photoDefaultSmall.jpg")->where("users.id","not in",$excluded_ids);
        $select->where("image_url","!=","");
        $select->limit($limit * 2);
        $similar_people = $select->execute()->cached(\Date::HOUR)->as_array();

        $similar_people = \orm::array_value_recursive("id",$similar_people);
	    return is_array($similar_people) ? $similar_people : array("0");
    }

    private function _get_friends_by_country($country, $exception, $limit){

    	//$cache = \Kohana::sys_cache();
		$cache = Database_Query::$cache; 

    	if (false === ($users = $cache->get('COUNTRY_USER_WITH_PHOTO_'.$country, false))){
			$select = \DB::select('users.id');
			$select->from("user_infos");
			$select->join("users","inner");
			$select->on("users.id","=","user_infos.id");
            $select->where('user_infos.country_id', '=', $country);
			$select->where("users.image_url","!=","photoDefaultSmall.jpg");

			$select->where("users.image_url","!=","")->limit($limit * 100);
            $select->order_by('user_infos.date_last_login', 'desc');
			$users = $select->execute()->as_array();
			
			$users = \orm::array_value_recursive("id",$users);
			$users = is_array($users) ? $users : array("0");
			$cache->set('COUNTRY_USER_WITH_PHOTO_'.$country, $users, \Date::DAY);
			unset($select);
		}


        $excluded_ids = array(101284,6829150,6829156,6829161);
        $users = array_diff($users, $excluded_ids);
        unset($excluded_ids);

    	if($this->loaded()){
            $userinfo = $this->info;
			$pending_request = explode(",", $userinfo->pending_details["friend_request_sent"]);
			$myfriendslist = explode(",", $userinfo->friend_ids);
		    $exception = array_unique(array_merge($exception, $myfriendslist, $pending_request, array($this->id)));
            unset($pending_request);
            unset($myfriendslist);
        }
        $users = array_diff($users, $exception);

        if(count($users) >= $limit){
            $result_list = $users;

        }else{
            $sub_count = $limit - count($users);
			$select = \DB::select('user_infos.id');
			$select->from("user_infos");
            $select->where('user_infos.country_id', '=', $country);
            if(count($users) > 0)
			    $select->where("user_infos.id", "not in", $users);
            if(count($exception) > 0)
                $select->where("user_infos.id", "not in", $exception);
            unset($exception);

            $select->limit($sub_count);
            $select->order_by('user_infos.date_last_login', 'desc');
			$sub_users = $select->execute()->as_array();
			unset($select);
			$sub_users = \orm::array_value_recursive("id", $sub_users);
			$sub_users = is_array($sub_users) ? $sub_users : array("0");
            $result_list = array_merge($users, $sub_users); 
        }

        $result_list = array_unique($result_list);
        shuffle($result_list);
        return array_slice($result_list, 0, $limit);
    }

    public function get_specific_name(){
        $info = $this->info;
        $temp = json_decode($info->specific_name);
        $name = (isset($temp->name) && $temp->name) ? $temp->name : '';
        unset($info);
        return $name;
    }

    public function is_enable_specific_name(){
        $info = $this->info;
        $temp = json_decode($info->specific_name);
        $enable = (isset($temp->enable) && $temp->enable) ? $temp->enable : 0;
        unset($info);
        return $enable;
    }

    public function clear_full_name_cache(){
 		$cache = Database_Query::$cache;
		$token = $this->fullname_token;
    	$cache->delete($token);
    }

    protected function get_fullname_token(){
		return md5(\I18n::lang() . 
						 \cache::$namescope->key('users') . 
						 \cache::$namescope->key('languages') . 
						 $this->info->specific_name . 
						 $this->id .
						 "full_name" );

    }
    
    public function get_followers(){
		if(!$this->loaded()){
			return false;
		}
			
		
		return \orm::factory("follower")
						->where("user_id1","=",$this->id);

		
		
    }

    
    
    public function follow($user){
		if(!$this->loaded()){
			return false;
		}
			
		if(empty($user)){
			return false;
		}
		
		if($this->id == $user->id){
			return false;
		}
		
		$follower = \orm::factory("follower")
						->where("user_id1","=",$this->id)
						->where("user_id2","=",$user->id)
						->find();
		
		$follower->date_modified = \db::expr("now()");
		$follower->user_id1 = $this->id;
		$follower->user_id2 = $user->id;
		$follower->count = (int)$follower->count + 1;
		$follower->save();
		
		
    }
    
    public function get_first_name(){
        $name = $this->full_name;
            
        if($this->loaded()){
        	
		    $user = \DB::select('first_name');
		    $user->from("users");
		    $user->where("id","=",$this->id)->cached(\DATE::MONTH);
		    $user = $user->execute()->as_array();	
		    $user = array_shift($user);
		    $name = !empty($user["first_name"]) ? $user["first_name"] : $name;
		    $name = explode(" ", $name);
		    $name = array_shift($name);
		    
		}
        return $name;
    }

	
    public function get_full_name(){
        $name = 'Somebody';
            
        if($this->loaded()){
        	
     		$cache = Database_Query::$cache;

		    $token = $this->fullname_token;

        	if (false === ($name = $cache->get($token, false)))
			{
        
			    $user = \DB::select('full_name');
			    $user->from("users");
			    $user->where("id","=",$this->id)->cached(\DATE::MONTH);
			    $user = $user->execute()->as_array();	
	            if(is_array($user) && count($user) == 1){
	                $name = isset($user[0]['full_name']) ? $user[0]['full_name'] : 'Somebody';
	            }
	            if($this->is_enable_specific_name()){
	                $cur_lang = \orm::factory('language')->where('iso2', '=', \I18n::lang())->cached(\DATE::MONTH)->find();
	                if($cur_lang->loaded() && $cur_lang->id == $this->info->lang_id){
	                    $specific_name = $this->get_specific_name();
	                    if($specific_name){
	                        $name = $specific_name;
	                    }
	                }
	            }
            	
            	$cache->set($token, $name, \DATE::DAY);
            }
        }
        return $name;
    }
	
    
    public static function assoc_by_email($party_model, $email)
    {
        $user = ORM::factory('user')->where('email', '=', $email)->find();

        if (!$user->loaded())
        {
            return false;
        }
        
        $users = new \CSV(str_replace(' ', '', $party_model->user_ids));
        
        $party_model->user_ids = $users->add($user->id)->as_string();
        
        $party_model->save();
        
        return $user;
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
