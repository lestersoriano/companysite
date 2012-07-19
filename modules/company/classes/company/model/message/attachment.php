<?php

class Company_Model_Message_Attachment extends ORM
{
	protected $_table_name = 'message_attachments';
	
	
	public function attach_files($message_id, $attachments){
		if(empty($attachments) or empty($message_id)){
			return false;
		}
		$file = \orm::factory("message_attachment");

		do
		{
			$attachment = array_shift($attachments);
			$file->message_id = $message_id;
			$file->path = $attachment["path"];
			$file->type = $attachment["type"];
			$file->save();
			
		}while(!empty($attachments));
		
		return true;
	}
}

?>