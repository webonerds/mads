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
	'htmlOptions' => array('autocomplete' => 'off','enctype'=>'multipart/form-data'),
)); ?>

<fieldset>

	<label>Basic Info</label>

	<section>
		<?php echo $form->labelEx($model, 'code'); ?>
		<div><?php echo $form->textField($model, 'code', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'code'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model,'brief'); ?>
		<div><?php echo $form->textArea($model,'brief', array('required' => 'required','cols'=>'20')); ?></div>
		<?php echo $form->error($model,'brief'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'description'); ?>
		<div><?php echo $form->textArea($model, 'description', array( 'rows' => 20)); ?></div>
		<?php echo $form->error($model, 'description'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'price'); ?>
		<div><?php echo $form->textField($model, 'price'); ?></div>
		<?php echo $form->error($model, 'price'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model,'product_picture_media_file_id'); ?>
		<div>
			<div><?php echo $form->fileField($model,'product_picture_media_file_id'); ?>
			<?php  ViewFormHelper::imageActions($this, $model, 'product_picture', array('ShowView' => true, 'ShowDelete' => true)); ?>
			<div class="clearfix"></div><span>(jpg, gif & png only, Max size: 500Kb)</span>
		</div>
		<?php echo $form->error($model,'product_picture_media_file_id'); ?>
	</section>
	<section>
		<?php echo $form->labelEx($model,'active'); ?>
		<div><?php echo $form->checkBox($model, 'active'); ?></div>
		<?php echo $form->error($model,'active'); ?>
	</section>
	
</fieldset>

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

	CKEDITOR.replace( 'Products_description',
    {
		customConfig : '{$ckeditorPath}/basic_config.js'
    });
});
JS;
$cs->registerScript('page-form', $js, CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . "/template/ckeditor/ckeditor.js", CClientScript::POS_HEAD);
