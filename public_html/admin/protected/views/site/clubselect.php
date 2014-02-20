<?php
/* @var $this SiteController */
/* @var $model Clubs */
/* @var $form CActiveForm */
/* @var $cs CClientScript */

/**
 * @file       clubselect.php$
 * @created    17/10/2013 1:36:59 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

?>

<h1>Select Club</h1>
<p>Please select the club you would like to be operating in.</p>

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>

<?php $this->beginWidget('CActiveForm', array(
	'id' => 'clubs-create-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => false,
	'clientOptions' => array(
		'validateOnSubmit' => false,
	),
	'htmlOptions' => array('autocomplete' => 'off'),
)); ?>

<fieldset>

	<label>Select Club</label>

	<section>
		<?php echo CHtml::label('Select Club', 'club_id'); ?>
		<div><?php echo CHtml::dropDownList('club_id', $clubId, $clubsList, array('prompt' => 'Choose One', 'required' => 'required')); ?></div>
	</section>

	<section>
		<div><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>

</fieldset>

<?php $this->endWidget(); ?>
