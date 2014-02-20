<?php
/* @var $this ProductsController */
/* @var $model Products */
?>
<h1>Deleted Products  Summary</h1>
<p>Below is a summary of all the deleted products in the system</p>			

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>
	
<?php 
	
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	'afterAjaxUpdate' => 'updateDropdowns',
    'columns'=>array(
		 array(
            'name' => 'product_picture_media_file_id',
            'type' => 'raw',
            'value' => function(Products $data){
				if (!empty($data->product_picture_media_file_id))
				{
					echo '<a class="btn small fancybox" href="'. $data->getUploadedFileFullPath('product_picture')  
							.'"><img src="'. $data->getUploadedFileFullPath('product_picture')  .'" width="70"></a>';
				}
			},
			'headerHtmlOptions' => array('width' => '15%'),
			'filter' => false,
			'sortable' => false,
			'header' => 'Picture',
			'headerHtmlOptions' => array('width' => '10%'),
        ),
		array(
			'name'=>'code',
			'type'=>'raw',
			'value'=>'$data->code',
			'htmlOptions'=>array('width'=>'15%')
			),
		array(
			'name'=>'brief',
			'type'=>'raw',
			'value'=>'$data->brief',
			'htmlOptions'=>array('width'=>'35%')
			),
	
		array(
			'name'=>'price',
			'type'=>'raw',
			'value'=>'$data->price',
			'htmlOptions'=>array('width'=>'10%')
			),
		array(
            'name' => 'active',
            'type' => 'raw',
            'value' => function($data){
					$activeIconClass = $data->active == 1 ? "i_tick" : "i_cross";
					if (Yii::app()->user->isAdmin())
					{
						echo CHtml::link("", Yii::app()->createUrl('product/toggleActive',array('id'=>$data->product_id)), array("class" => "btn small toggleActive " . $activeIconClass));
					} else {
						echo CHtml::link("", "javascript:;", array("class" => "btn small nolink " . $activeIconClass));
					}
            },
			'filter' => $model->getYesNoFilterArray(),
			'sortable' => true,
			'headerHtmlOptions' => array('width' => '8%'),
        ),		

		array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'header' => 'Restore',
			'deleteConfirmation' => false,
            'buttons' => array(
				'delete' =>array(
					'imageUrl'=>false,
                    'label' => '',
                    'options' => array(// this is the 'html' array but we specify the 'ajax' element
						'confirm' => 'Are you sure you want to restore this item?',
						'class' => 'btn small i_tick',
                    ),
                ),
				'update' =>array(
					'imageUrl'=>false,
                    'label' => '',
                    'options' => array(// this is the 'html' array but we specify the 'ajax' element
                        'class' => 'btn small i_pencil',
                    ),
                ),
                

        
        ),
	
	),
)));
			
$cs = Yii::app()->getClientScript();  

$js = <<<JS
function updateDropdowns(){
	$(".items select").uniform();
}
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>