<?php
$config = array(    
	'userlogin'=>array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|valid_email|callback_userLogin'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    )
);