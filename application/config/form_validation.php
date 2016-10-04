<?php
$config = array(    
	'userlogin'=>array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|callback_userLogin'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'company',
            'label' => 'Select Company',
            'rules' => 'required'
        )
    ),
    'user_registration'=>array(
        array(
            'field' => 'name',
            'label' => 'Full Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|callback_username_exists'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    'change_password'=>array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    'product_add_edit'=>array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'price',
            'label' => 'Product Price',
            'rules' => 'required'
        )
    )

);