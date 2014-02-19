<?php
/**
 * This is the template for generating a form script file.
 * The following variables are available in this template:
 * - $this: the FormCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getModelClass(); ?>Controller */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<h1>Heading</h1>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass).'-'.basename($this->viewName)."-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
	'focus'=>array(\$model,'PLEASE_ENTER_FIELD') ,
	'htmlOptions'=>array('autocomplete'=>'off'),
)); ?>\n"; ?>

	<?php echo "<?php echo \$form->errorSummary(\$model, null, null, array('class' => 'alert warning')); ?>\n"; ?>
	
	<fieldset>
		
		<label>FIELD SET</label>
	
<?php foreach($this->getModelAttributes() as $attribute): ?>
		<section>
			<?php echo "<?php echo \$form->labelEx(\$model,'$attribute'); ?>\n"; ?>
			<div><?php echo "<?php echo \$form->textField(\$model,'$attribute', array()); ?>"; ?></div>
			<?php echo "<?php echo \$form->error(\$model,'$attribute'); ?>\n"; ?>
		</section>

<?php endforeach; ?>

		<section>
			<div><?php echo "<?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?>"; ?></div>
		</section>
		
	</fieldset>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>