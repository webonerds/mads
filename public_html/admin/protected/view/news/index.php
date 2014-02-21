<?php
/* @var $this NewsController */
/* @var $model News */
?>
<h1>News Summary</h1>
<p>Below is a summary of all the News in the system</p>			

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>
	
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	'afterAjaxUpdate' => 'updateDropdowns',
    'columns'=>array(
		 array(
            'name' => 'picture_media_file_id',
            'type' => 'raw',
            'value' => function(News $data){
				if (!empty($data->picture_media_file_id))
				{
					echo '<a class="btn small fancybox" href="'. $data->getUploadedFileFullPath('picture')  
							.'"><img src="'. $data->getUploadedFileFullPath('picture')  .'" width="70"></a>';
				}
			},
			'headerHtmlOptions' => array('width' => '15%'),
			'filter' => false,
			'sortable' => false,
			'header' => 'Picture',
			'headerHtmlOptions' => array('width' => '10%'),
        ),
		'news_title',
		'brief',
		array(
			'name' => 'display_order',
			'type' => 'raw',
			'value' => $model->display_order,
			'filter' =>false,
			'headerHtmlOptions' => array('width' => '8%'),
		),
			
		array(
            'name' => 'active',
            'type' => 'raw',
            'value' => function($data){
					$activeIconClass = $data->active == 1 ? "i_tick" : "i_cross";
					if (Yii::app()->user->isAdmin())
					{
						echo CHtml::link("", Yii::app()->createUrl('news/toggleActive',array('id'=>$data->news_id)), array("class" => "btn small toggleActive " . $activeIconClass));
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