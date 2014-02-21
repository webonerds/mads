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
		<?php echo $form->labelEx($model,'faq_title'); ?>
		<div><?php echo $form->textField($model,'faq_title',array('size'=>60,'required'=>'required')); ?></div>
		<?php echo $form->error($model,'faq_title'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model,'brief'); ?>
		<div><?php echo $form->textArea($model,'brief',array('required' => 'required','cols'=>'20')); ?></div>
		<?php echo $form->error($model,'brief'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'description'); ?>
		<div><?php echo $form->textArea($model, 'description', array( 'rows' => 20)); ?></div>
		<?php echo $form->error($model, 'description'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model,'display_order'); ?>
		<div><?php echo $form->textField($model,'display_order',array('size'=>60,'required'=>'required')); ?></div>
		<?php echo $form->error($model,'display_order'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model,'active'); ?>
		<div><?php echo $form->checkBox($model, 'active'); ?></div>
		<?php echo $form->error($model,'active'); ?>
	</section>
	
</fieldset>

<?php //$this->renderPartial('/common/_seo', array('form' => $form, 'model' => $model)); ?>

<fieldset>	
	<section>
		<div><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>
	
</fieldset>

	
<?php $this->endWidget(); ?>

<?php
$cs = Yii::app()->getClientScript();  	
$ckeditorPath = Yii::app()->baseUrl . "/template/ckeditor/";
$js = <<<JS
$(document).ready(function  (){


	CKEDITOR.replace( 'Faqs_description',
    {
		customConfig : '{$ckeditorPath}/basic_config.js'
    });
});
JS;
$cs->registerScript('page-form', $js, CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . "/template/ckeditor/ckeditor.js", CClientScript::POS_HEAD);
