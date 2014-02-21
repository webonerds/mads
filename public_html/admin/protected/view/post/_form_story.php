<?php
/* @var $this PostController */
/* @var $model UserPosts */
/* @var $form CActiveForm  */
/* @var $cs CClientScript */

/**
 * @file       _form.php$
 * @created    03/02/2014 2:29:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij
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
<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'post_type'); ?>
	
	<section>
		<?php echo $form->labelEx($model, 'category_id'); ?>
		<div><?php echo $form->dropDownList($model, 'category_id',CHtml::listData(Categories::model()->findAll(),'category_id','title'), array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'category_id'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'comment'); ?>
			<div><?php echo $form->textArea($model, 'comment', array( 'rows' => 5)); ?></div>
		<?php echo $form->error($model, 'comment'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'story_bacground_color'); ?>
		<div><?php echo $form->dropDownList($model, 'story_background_colour',AppConstants::$USERPOST_STORY_BACKGROUND_COLOUR, array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'story_bacground_color'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'story_font_style'); ?>
		<div><?php echo $form->dropDownList($model, 'story_font_style',AppConstants::$USERPOST_STORY_FONT_STYLE, array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'story_font_style'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model,'is_public'); ?>
		<div><?php echo $form->checkBox($model, 'is_public'); ?></div>
		<?php echo $form->error($model,'is_public'); ?>
	</section>
	
	
	<section>
		<?php echo $form->labelEx($model,'active'); ?>
		<div><?php echo $form->checkBox($model, 'active'); ?></div>
		<?php echo $form->error($model,'active'); ?>
	</section>
	
</fieldset>

<fieldset>	
	<section>
		<div class="g6"><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
		<div class="g6">
			<span class='st_sharethis_large'  displayText='ShareThis'></span>
			<span class='st_facebook_large'  displayText='Facebook'></span>
			<span class='st_googleplus_large' displayText='Google +'></span>
			<span class='st_twitter_large' displayText='Tweet'></span>
			<span class='st_linkedin_large' displayText='LinkedIn'></span>
			<span class='st_pinterest_large' displayText='Pinterest'></span>
			<span class='st_email_large' displayText='Email'></span>

		</div>
	</section>
	
</fieldset>



<?php $this->endWidget(); 
	
?>

