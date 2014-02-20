<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>


<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'news-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => false,
	'clientOptions' => array(
		'validateOnSubmit' => false,
	),
	'focus' => array($model, 'page_title') ,
	'htmlOptions' => array('autocomplete' => 'off'),
)); ?>

<fieldset>

	<label>Basic Info</label>

	
	
	<section>
		<?php echo $form->labelEx($model->product,'product_id'); ?>
		<div><?php echo $form->textField($model->product,'brief',array('cols'=>'20')); ?></div>
		<?php echo $form->error($model->product,'product_id'); ?>
	</section>
	<section>
		<?php echo $form->labelEx($model,'quantity'); ?>
		<div><?php echo $form->textField($model,'quantity',array('cols'=>'20')); ?></div>
		<?php echo $form->error($model,'quantity'); ?>
	</section>
	
	
	

	
	
</fieldset>

<?php //$this->renderPartial('/common/_seo', array('form' => $form, 'model' => $model)); ?>

<fieldset>	
	<section>
		<div><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>
	
</fieldset>

	
<?php $this->endWidget(); ?>
