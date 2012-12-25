<?php

/*
 * ForgotPasswordForm class
 * ForgotPasswordForm is the data structure for keeping the form data
 * related to forgot password process. It is used by the 'forgotPassword'
 * action of 'UserController'.
 */

class ForgotPasswordForm extends CFormModel
{
    /**
     * @var string username of the user requesting for password reset
     */
    public $username;
 
    
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated using the verify() method
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username', 'required'),
            // username needs to be verified
            //array('username', 'exist', 'className'=>'User'),
            //array('username', 'verify'),
        );
    }
    
    /**
	 * @return array customized attribute labels (name=>label)
	 */
    public function attributeLabels()
	{
		return array(
			'username' => 'Email Address',
		);
	}

}