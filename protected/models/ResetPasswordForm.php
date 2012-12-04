<?php

/*
 * ResetPasswordForm class
 * ResetPasswordForm is the data structure for keeping the form data
 * related to forgot password process. It is used by the 'forgotPassword'
 * action of 'UserController'.
 */

class ResetPasswordForm extends CFormModel
{
    
    /**
     * @var string the new password associated to the username
     */
    public $password;
    
    /**
     * @var string the repeat password to confirm the new password
     */
    public $password_repeat;
    
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated using the verify() method
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('password', 'required'),
            array('password', 'compare'),
            array('password, password_repeat', 'safe'),
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
			'password' => 'Password',
                        'password_repeat' => 'Confirm Password',
		);
	}
    
}