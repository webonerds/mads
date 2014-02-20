<?php

/**
 * MessageReplyForm class.
 */
class MessageReplyForm extends CFormModel
{
	public $subject;
	public $message;
	public $to_user_id;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('subject, message', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'message'=>'Message',
		);
	}
}
