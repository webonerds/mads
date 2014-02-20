<?php
/* @var $this MessageController */
/* @var $model MessageReplyForm	 */
/* @var $message EmailMessages	 */
/* @var $cs CClientScript */

/**
 * @file       reply.php$
 * @created    17/10/2013 10:50:31 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>
<h1>Reply Message</h1>
<p>Please fill out the form to send a reply</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'replymessage-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => false,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'focus' => array($model, 'subject') ,
	'htmlOptions' => array('autocomplete' => 'off'),
)); ?>

<?php echo $form->errorSummary($model, null, null, array('class' => 'alert warning')); ?>

<fieldset>

	<label>Reply</label>

	<section>
		<?php echo $form->labelEx($model, 'subject'); ?>
		<div><?php echo $form->textField($model,'subject', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'subject'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'message'); ?>
		<div><?php echo $form->textArea($model, 'message', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'message'); ?>
	</section>
	
	<section>
		<div><?php echo CHtml::htmlButton('Send', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>

</fieldset>

<fieldset class="ajax">

	<label>Original Message</label>
	
	<section>
		<label>Message</label>
		<div><?php echo $message->body_contents; ?></div>
	</section>

</fieldset>

<?php $this->endWidget(); 
