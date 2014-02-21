<?php
/**
 * @file       index.php$
 * @created    11/11/2013 12:13:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */

/* @var $this  PageController */
/* @var $model Pages */
$this->pageTitle = Yii::app()->name . ' - Pages Summary';
?>

<h1>Pages Summary</h1>
<p>Below is a summary of all the pages in the system</p>			

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>
	
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'page-summary',
    'dataProvider' => $model->search(),
	'filter' => $model,
	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	'afterAjaxUpdate' => 'updateDropdowns',
    'columns' => array(
        array(
            'name' => 'page_title',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->page_title)'
        ),
		array(
            'name' => 'active',
            'type' => 'raw',
            'value' => function($data){
					$activeIconClass = $data->active == 1 ? "i_tick" : "i_cross";
					if (Yii::app()->user->isAdmin())
					{
						echo CHtml::link("", "index.php?r=page/toggleActive&id=" . $data->page_id, array("class" => "btn small toggleActive " . $activeIconClass));
					} else {
						echo CHtml::link("", "javascript:;", array("class" => "btn small nolink " . $activeIconClass));
					}
            },
			'filter' => $model->getYesNoFilterArray(),
			'sortable' => true,
			'htmlOptions' => array('class' => 'button-column'),
			'headerHtmlOptions' => array('class' => 'button-column'),
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
			'headerHtmlOptions' => array('class' => 'button-column'),
        )
    ),
)); ?>
    
<?php  
	
$cs = Yii::app()->getClientScript();  

$js = <<<JS
function updateDropdowns(){
	$("#page-summary select").uniform();
}
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>