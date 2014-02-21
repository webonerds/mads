<div class='fl'>
	<h1 >Edit a Product</h1>
	<p>Please fill out the form below to edit an existing Product</p>
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif; ?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>