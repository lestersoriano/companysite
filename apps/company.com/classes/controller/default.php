<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Default extends Controller_Layout {
	public function action_index()
	{
		$this->layout->page = 'signUp';
		$this->layout->body_class = "splash";
	}

} // End Welcome
