<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>



<div class='fl'>
	<h1>Create an User</h1>
	<p>Please fill out the form below to create a new user</p>
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php $this->renderPartial('_form' ,array('model'=>$model,
	
	)); ?>