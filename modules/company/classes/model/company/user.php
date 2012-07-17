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
