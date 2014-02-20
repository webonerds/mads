<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */

/**
 * @file       _form.php$
 * @created    07/10/2013 12:13:40 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-create-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
	'focus'=>array($model,'username') ,
	'htmlOptions'=>array('autocomplete'=>'off', 'enctype' => 'multipart/form-data'),
)); ?>

<fieldset>

	<label>Basic Info</label>

	<section>
		<?php echo $form->labelEx($model, 'username'); ?>
		<div><?php echo $form->textField($model, 'username', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'username'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'password'); ?>
		<div><?php echo $form->passwordField($model, 'password', array()); ?></div>
		<?php echo $form->error($model, 'password'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'firstname'); ?>
		<div><?php echo $form->textField($model, 'firstname', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'firstname'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'lastname'); ?>
		<div><?php echo $form->textField($model, 'lastname', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'lastname'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'private_email'); ?>
		<div><?php echo $form->emailField($model, 'private_email', array('required' => 'required', 'type' => 'email')); ?></div>
		<?php echo $form->error($model, 'private_email'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'profile_picture_media_file_id'); ?>
		<div>
			<?php echo $form->fileField($model, 'profile_picture_media_file_id'); ?>
			<?php ViewFormHelper::imageActions($this, $model, 'profile_picture', array('ShowView' => true)); ?>
			<div class="clearfix"></div><span>(jpg, gif & png only, Max size: 500Kb)</span>
		</div>
		<?php echo $form->error($model, 'profile_picture_filename'); ?>
	</section>
	
	
	<section>
		<?php echo $form->labelEx($model, 'active'); ?>
		<div><?php echo $form->checkBox($model, 'active'); ?></div>
		<?php echo $form->error($model, 'active'); ?>
	</section>

</fieldset>

<fieldset>

	<label>Roles</label>

	<section>
		<label>Select user roles</label>
		<div>
			<?php
				$data=CHtml::listData(Roles::model()->findAll(),'role_id', 'role_name');
				$selected_keys = array_keys(CHtml::listData(UserRoles::model()->findAllByAttributes(array('user_id'=>$model->user_id)),'role_id', 'role_name'));
				echo CHtml::checkBoxList('Users[roles][]', $selected_keys, $data,array(
					'separator'=>''
					,'labelOptions'=>array('style'=>'display:inline'),
					'template'=>'{input}{label}&nbsp; '
					));
				
				
				?>
		</div>
		
		
		
	</section>

	<section>
		<div><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>

</fieldset>

<?php $this->endWidget(); 