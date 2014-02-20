<?php
/* @var $this ForgotpasswordController */
/* @var $model ForgotpasswordForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Forgot Password';

?>

<h1>Forgot Password</h1>

<p>Please fill out the following form to reset your password:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forgot-form',
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
			<div><?php echo CHtml::htmlButton('Back to Login', array('class' => '', 'id' => 'back', 'onClick' => "window.location='". Yii::app()->createUrl('login') ."'")); ?> <?php echo CHtml::htmlButton('Submit', array('class' => 'fr submit', 'type' => 'submit')); ?></div>
		</section>
	</fieldset>

<?php $this->endWidget(); ?>
</div><!-- form -->
