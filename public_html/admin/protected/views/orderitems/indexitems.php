<?php
/* @var $this OrdersController */
/* @var $model OrdersItems */
?>

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif; ?>


<h1>Order Items  Summary</h1>
<p>Below is a summary of all the Orders Items in the system</p>			

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'Orders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,

	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	
    	'columns'=>array(
		array(
			'name' => 'order_id',
			'type' => 'raw',
			'value' => '$data->order_id',
			'filter' =>true,
		),
		
		array(
			'name' => 'product Brief',
			'type' => 'raw',
			'value' => '$data->product->brief',
			'filter' =>true,
		),
		array(
			'name' => 'quantity',
			'type' => 'raw',
			'value' => '$data->quantity',
			'filter' =>true,
		),
		array(
			'name' => 'unit_price',
			'type' => 'raw',
			'value' => '$data->unit_price',
			'filter' =>true,
		),
		array(
			'name' => 'Total Price',
			'type' => 'raw',
			'value' => '$data->total_price',
			'filter' =>true,
		),
		array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'header' => 'Edit',
            'updateButtonImageUrl' => false,
            'updateButtonLabel' => '',
            'updateButtonOptions' => array(
               'class' => 'btn small i_pencil'
            ),
			'deleteButtonImageUrl' => false,
			'deleteButtonLabel' => '',
			'deleteButtonOptions' => array(
				'class' => 'btn small i_trashcan'
			),
			'headerHtmlOptions' => array('class' => 'button-column'),
        )

	),
)); ?>

