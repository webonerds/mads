<?php
/* @var $this PostController */
/* @var $model UserPosts */
/* @var $form CActiveForm  */

/**
 * @file       create.php$
 * @created    11/11/2013 2:29:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */
?>

<div class='fl'>
	<h1>Create a Post</h1>
	<p>Please fill out the form below to create a new Post</p>
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

	<?php
		if ($type == 'story')
		{	$model->post_type='story';
		
			$this->renderPartial('_form_story' ,array('model'=>$model)); 
		}
		else if ($type == 'picture')
		{
			$model->post_type='picture';
			$this->renderPartial('_form_picture' ,array('model'=>$model)); 
		}
	?>

