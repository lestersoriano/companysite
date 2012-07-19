<?php

class Company_Model_Entity_Follow extends ORM
{
	protected $_table_name = 'entity_follows';

	public function follow($entity_id1, $entity_id2){
		$entityfollow = \orm::factory("follow")
						->where("follower_entity_id","=",$entity_id1)
						->where("followee_entity_id","=",$entity_id2)
						->find();
						
		$entityfollow->follower_entity_id = $entity_id1;
		$entityfollow->followee_entity_id = $entity_id2;
		$entityfollow->save();
		
	}
}
	
?>