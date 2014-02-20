<?php
/* @var $this LoginController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/* @var $cs CClientScript  */

$this->pageTitle=Yii::app()->name . ' - Login';

?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
	'focus'=>array($model,'username') ,
	'htmlOptions'=>array('autocomplete'=>'off')
)); ?>
	
	<fieldset>
		<section>
			<?php echo $form->labelEx($model,'username'); ?>
			<div><?php echo $form->textField($model,'username', array('required'=>'required', 'data-errortext' => 'Please enter username')); ?></div>
			<?php echo $form->error($model,'username'); ?>
		</section>
		<section>
			<label for="LoginForm_password">Password <span class="required">*</span> <a href="../user/forgotpassword" tabindex="-1">lost password?</a></label>
			<div><?php echo $form->passwordField($model,'password', array('required'=>'required', 'data-errortext' => 'Please enter password')); ?></div>
			<?php echo $form->error($model,'password'); ?>
		</section>
		<section>
			<div><?php echo CHtml::htmlButton('Login', array('class' => 'fr submit', 'type' => 'submit')); ?></div>
		</section>
	</fieldset>

<?php $this->endWidget(); ?>
</div><!-- form -->

<?php
$cs=Yii::app()->clientScript;

$cs->scriptMap=array(
	'jquery.js' => false
);
?>
