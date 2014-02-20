<?php
/* @var $this PageController */
/* @var $model Pages */
/* @var $form CActiveForm  */
/* @var $cs CClientScript */

/**
 * @file       _form.php$
 * @created    11/11/2013 2:29:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */

?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'pages-form',
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
		<?php echo $form->labelEx($model, 'page_title'); ?>
		<div><?php echo $form->textField($model, 'page_title', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'page_title'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'page_slug'); ?>
		<div><?php echo $form->textField($model, 'page_slug', array('required' => 'required')); ?><span>http://club_domain.com/</span></div>
		<?php echo $form->error($model, 'page_slug'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'page_content'); ?>
		<div><?php echo $form->textArea($model, 'page_content', array('class' => 'ckeditor', 'rows' => 20)); ?></div>
		<?php echo $form->error($model, 'page_content'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model,'active'); ?>
		<div><?php echo $form->checkBox($model, 'active'); ?></div>
		<?php echo $form->error($model,'active'); ?>
	</section>
	
</fieldset>

<?php $this->renderPartial('/common/_seo', array('form' => $form, 'model' => $model)); ?>

<fieldset>	
	<section>
		<div><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>
	
</fieldset>

<?php $this->endWidget(); 
	
$cs = Yii::app()->getClientScript();  	
$ckeditorPath = Yii::app()->baseUrl . "/template/ckeditor/";

$js = <<<JS
$(document).ready(function  (){

	$("#Pages_page_title").blur(function(){
		if ($("#Pages_page_slug").val() == '')
		{
			$("#Pages_page_slug").val(convertToSlug($(this).val()));
		}
	});	
		
	CKEDITOR.replace( 'News_description',
    {
		customConfig : '{$ckeditorPath}/basic_config.js'
    });

});
JS;
$cs->registerScript('page-form', $js, CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . "/template/ckeditor/ckeditor.js", CClientScript::POS_HEAD);