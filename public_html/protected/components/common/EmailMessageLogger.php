<?php

/**
 * @file       EmailMessageLogger.php$
 * @created    14/10/2013 5:28:16 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of EmailMessageLogger
 *
 * @author Rohit Gupta
 */
class EmailMessageLogger
{	
	/**
	 *
	 * @var EMailer 
	 */
	private $_emailer;
	
	/**
	 *
	 * @var EmailMessages 
	 */
	private $_emailMessageModel;
	
	//***************************************************************************
	// Initialization
	//***************************************************************************
	
	/**
	 * Init method for the application component mode.
	 */
	public function init() {}

	/**
	 * Constructor. Here the instance of PHPMailer is created.
	 */
	 public function __construct()
	 {
		 $this->_emailer = Yii::app()->mailer;
		 $this->_emailMessageModel = new EmailMessages();
	 }
	 
	 /**
	  * Function to send an email and also log the email at the same time
	  * 
	  * @param string $subject
	  * @param string $toAddressEmail
	  * @param string $toAddressName
	  * @param string $viewName
	  * @param array $emailOptions array('fromName', 'fromEmail', 'viewParams', 'layoutName', 'ccArray', 'attachmentArr')
	  * @param type $logMessageOptions array('parentEmailMessageId', 'fromUserId', 'toUserId', 'sentResult', 'toEmail', 'subject', 'message', 'bodyContents')
	  */
	 public function sendLoggedEmail($subject, $toAddressEmail, $toAddressName, $viewName, $emailOptions = array(), $logMessageOptions = array())
	 {
		 $sendResult = $this->sendHTMLEmail($subject, $toAddressEmail, $toAddressName, $viewName, $emailOptions);
		 
		 $logMessageOptions['toEmail'] = $toAddressEmail;
		 $logMessageOptions['subject'] = $subject;
		 $logMessageOptions['message'] = $this->_emailer->_myMailer->Body;
		 $logMessageOptions['bodyContents'] = $this->_emailer->viewBody;
		 $logMessageOptions['sentResult'] = $sendResult;
				 
		 $this->logEmailMessage($logMessageOptions);
	 }
	 
	 /**
	  * Function to send HTML email message using EMailer extension
	  * 
	  * @param string $subject
	  * @param string $toAddressEmail
	  * @param string $toAddressName
	  * @param string $viewName
	  * @param array $emailOptions array('fromName', 'fromEmail', 'viewParams', 'layoutName', 'ccArray', 'attachmentArr')
	  * @return bool
	  */
	 public function sendHTMLEmail($subject, $toAddressEmail, $toAddressName, $viewName, $emailOptions = array())
	 {
		 $fromName = isset($emailOptions["fromName"]) ? $emailOptions["fromName"] : Yii::app()->params["email"]['name'];
		 $fromEmail = isset($emailOptions["fromEmail"]) ? $emailOptions["fromEmail"] : Yii::app()->params["email"]['from'];
		 $viewParams = isset($emailOptions["viewParams"]) ? $emailOptions["viewParams"] : array();
		 $layoutName = isset($emailOptions["layoutName"]) ? $emailOptions["layoutName"] : 'main';
		 $ccArray = isset($emailOptions["ccArray"]) ? $emailOptions["ccArray"] : array();
		 $attachmentArr = isset($emailOptions["attachmentArr"]) ? $emailOptions["attachmentArr"] : array();
		 
		 return $this->_emailer->sendHTMLEmail($fromName, 
										$fromEmail, 
										$toAddressEmail, 
										$toAddressName, 
										$subject, 
										$viewName, 
										$viewParams,
										$layoutName, 
										$ccArray, 
										$attachmentArr);
				 
	 }
	 
	 /**
	  * Function to log the emails sent out from the system
	  * 
	  * @param type $logMessageOptions array('parentEmailMessageId', 'fromUserId', 'toUserId', 'sentResult', 'toEmail', 'subject', 'message', 'bodyContents')
	  */
	 public function logEmailMessage($logMessageOptions = array())
	 {
		 $this->_emailMessageModel = new EmailMessages();
		  
		 $this->_emailMessageModel->isNewRecord = TRUE;
		 
		 if (isset($logMessageOptions["parentEmailMessageId"]))
			 $this->_emailMessageModel->parent_email_message_id = $logMessageOptions["parentEmailMessageId"];
		 
		 if (isset($logMessageOptions["fromUserId"]))
			 $this->_emailMessageModel->from_user_id = $logMessageOptions["fromUserId"];
		 
		 if (isset($logMessageOptions["toUserId"]))
			 $this->_emailMessageModel->to_user_id = $logMessageOptions["toUserId"];
		 
		 if (isset($logMessageOptions["sentResult"]))
			 $this->_emailMessageModel->sent_successful = $logMessageOptions["sentResult"];
		 
		 $this->_emailMessageModel->to_email = $logMessageOptions["toEmail"];
		 $this->_emailMessageModel->subject = $logMessageOptions["subject"];
		 $this->_emailMessageModel->message = $logMessageOptions["message"];
		 $this->_emailMessageModel->body_contents = $logMessageOptions["bodyContents"];
		 $this->_emailMessageModel->isNewRecord = true;
		 
		 $this->_emailMessageModel->save(false);
		 
	 }
}
?>
