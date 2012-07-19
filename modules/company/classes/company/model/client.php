<?php

class Company_Model_Client extends ORM
{
	public function detect(){
		return $this->where("name","=",SERVER_NAME)->find();
	}
}

?>