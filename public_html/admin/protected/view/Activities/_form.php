<?php
/* @var $this ActivitiesController */
/* @var $model UserActivities */
/* @var $form CActiveForm */
?>


<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'activity-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => false,
	'clientOptions' => array(
		'validateOnSubmit' => false,
	),
	'focus' => array($model, 'page_title') ,
	'htmlOptions' => array('autocomplete' => 'off'),
)); ?>

<fieldset>


	<section>
		<?php echo $form->labelEx($model,'user_id'); ?>
		<div><lable><?php echo ucfirst($model->user->firstname).' ' .ucfirst($model->user->lastname);?></lable></div>
	</section>
	<section>
		<?php echo $form->labelEx($model,'post_id'); ?>
		<div><lable><?php echo ucfirst($model->post->comment);?></lable></div>
	</section>
	
	<section>
		<?php echo $form->labelEx($model,'activity_type'); ?>
		<div><lable><?php echo ucfirst($model->activity_type);?></lable></div>
	</section>
	
	<section>
		<?php echo $form->labelEx($model,'status'); ?>
		<div><?php echo $form->dropDownList($model, 'status',$model->getActivitiesStatusFilterArray()); ?></div>
		<?php echo $form->error($model,'status'); ?>
	</section>
	
</fieldset>

<?php //$this->renderPartial('/common/_seo', array('form' => $form, 'model' => $model)); ?>

<fieldset>	
	<section>
		<div><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>
	
</fieldset>

	
<?php $this->endWidget(); ?>

