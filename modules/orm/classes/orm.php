<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {

	/**
     * Map a get function to a property call.
     */
	public function __get($property)
	{	
		$spec_property = 'get_' . $property;
		
		if (method_exists($this, $spec_property)){
			return $this->$spec_property();
		}else{
			//if (array_key_exists($property, $this->_object))
			//{
				return parent::__get($property);
			//}else{
			//	\Kohana::$log->add(LOG_DEBUG, "Property does not exist. TABLE:::" . $this->_table_name . " PROPERTY:::" . $property);
			//	return "";
			//}
		}
		
    }

}
