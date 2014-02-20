<?php
/* @var $this CategoriesController */
/* @var $model Categories */
?>

<h1>Categories Summary</h1>
<p>Below is a summary of all the Categories in the system</p>			

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif; ?>
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'faqs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	'afterAjaxUpdate' => 'updateDropdowns',
    	'columns'=>array(
		'title',
		'brief',
		array(
            'name' => 'active',
            'type' => 'raw',
            'value' => function($data){
					$activeIconClass = $data->active == 1 ? "i_tick" : "i_cross";
					if (Yii::app()->user->isAdmin())
					{
						echo CHtml::link("", Yii::app()->createUrl('Categories/toggleActive',array('id'=>$data->category_id)), array("class" => "btn small toggleActive " . $activeIconClass));
					} else {
						echo CHtml::link("", "javascript:;", array("class" => "btn small nolink " . $activeIconClass));
					}
            },
			'filter' => $model->getYesNoFilterArray(),
			'sortable' => true,
			'headerHtmlOptions' => array('width' => '10%'),
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
<?php  
	
$cs = Yii::app()->getClientScript();  

$js = <<<JS
function updateDropdowns(){
	$(".items select").uniform();
}
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>