<?php
/* @var $this PostController */
/* @var $model UserPosts */
/* @var $form CActiveForm  */

/**
 * @file       edit.php$
 * @created    05/02/2014 9:29:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */
?>

<div class='fl'>
	<h1 >Edit a Post</h1>
	<p>Please fill out the form below to edit an existing Post</p>
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif; ?>

<?php
		if ($model->post_type == 'story')
		{
			$this->renderPartial('_form_story' ,array('model'=>$model)); 
		}
		else if ($model->post_type == 'picture')
		{
			$this->renderPartial('_form_picture' ,array('model'=>$model)); 
		}
	?>