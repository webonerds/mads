<?php
/* @var $this ActivitiesController */
/* @var $model UserActivities */

?>

<div class='fl'>
<h1>Edit a  Activity</h1>

<p>Please fill out the form below to edit an existing Activity</p>			
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>