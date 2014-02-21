<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

?>

<div class='fl'>
<h1>Edit a  Order Items</h1>

<p>Please fill out the form below to edit an existing Order Items</p>			
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . 'orders/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>