<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller_Layout {
	public function action_index()
	{
		$this->layout->body->sidebar_left = (string) $this->_sidebar_left();
		$this->layout->body->sidebar_right = (string) $this->_sidebar_right();
		$this->layout->body->content = (string) $this->_content();
	}	
	
	public function action_feeds()
	{	
		$this->layout->body->sidebar_left = (string) $this->_sidebar_left();
		$this->layout->body->sidebar_right = (string) $this->_sidebar_right();
		$this->layout->body->content = (string) $this->_content();
	}	
	
	
	public function after(){
		$this->layout->page = 'feed';
		parent::after();
		
	}
	
	public function _sidebar_left(){
	  $sidebar = View::factory("content/profile/includes/sidebar-left");
      $sidebar->user =  $this->user;
      
      return $sidebar;
	}
	
	
	public function _sidebar_right(){
	  $sidebar = View::factory("content/profile/includes/sidebar-right");
      $sidebar->user =  $this->user;
      
      return $sidebar;
	}
	
	
	public function _content(){
	  $sidebar = View::factory("content/profile/includes/content");
      $sidebar->user =  $this->user;
      
      return $sidebar;
	}
} // End Welcome
