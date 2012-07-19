<?php


return array(
    'invalid_landing_page' => '/login', //page to go when no access

    'success_landing_page' => '/profile', //page to go when logged out
    
    'account_login_page' => '/', //page to go when logged out

    'public_only' => array(
        'signup' => array(
            'index'
        ),
        'login' => array(
            'index',
        ),
        'default' => array(
            'index',
        )
    ),

    'public_access' => array(
        'default' =>  array(
			'index'
		),
	),
    
);
