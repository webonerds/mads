<?php
/* @var $this ActivitiesController */
/* @var $model UserActivities */
?>

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif; ?>


<h1>User Activities Summary</h1>
<p>Below is a summary of all the User Activities in the system</p>			

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'faqs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,

	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	'afterAjaxUpdate' => 'updateDropdowns',
    	'columns'=>array(
		array(
            'name' => 'user_id',
            'type' => 'raw',
			'value'=>'$data->user->firstname ." " . $data->user->lastname',
			'sortable' => true,
        ),		
		array(
            'name' => 'post_id',
            'type' => 'raw',
			'value'=>'$data->post->comment',
			
			'sortable' => FALSE,
        ),		
	
		array(
            'name' => 'status',
            'type' => 'raw',
			'value'=>'$data->status',
			'filter' => $model->getActivitiesFilterArray(),
			'sortable' => true,
        ),		
		
		
		array(
            'name' => 'activity_type',
            'type' => 'raw',
			'value'=>'ucwords(str_replace("_"," ",$data->activity_type))',
			'filter' => $model->getActivitiesTypeFilterArray(),
			'sortable' => true,
        ),		
		array(
            'class' => 'CButtonColumn',
            'template' => '{update}',
            'header' => 'Edit',
            'updateButtonImageUrl' => false,
            'updateButtonLabel' => '',
            'updateButtonOptions' => array(
               'class' => 'btn small i_pencil'
            ),
		)

	),
)); ?>

	   
<?php  
	
$cs = Yii::app()->getClientScript();  

$js = <<<JS
function updateDropdowns(){
	$(".items select").uniform();
}
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>