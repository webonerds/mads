<?php
/* @var $this CommentController */
/* @var $model UserPostComments */
/* @var $form CActiveForm  */
/* @var $cs CClientScript */


/**
 * @file       index.php$
 * @created    06/02/2014 12:13:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

/* @var $this  CommentController */
/* @var $model UserPostComments */
$this->pageTitle = Yii::app()->name . ' - Comments Summary';
?>

<h1>Comments Summary</h1>
<p>Below is a summary of all the Comments in the system</p>			

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>
	
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'page-summary',
    'dataProvider' => $model->search(),
	'filter' => $model,
	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	'afterAjaxUpdate' => 'reinstallDatePicker,',
    'columns' => array(
		
		array(
            'name' => 'created_by',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->getCreatorName($data->created_by))'
        ),
		
		array(
            'name' => 'comment',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->comment)'
        ),
		
		 array(
            'name' => 'created_on',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'created_on', 
               'language' => 'en',
                 'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy/mm/dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true), // (#4)
        ),
		array(
            'name' => 'active',
            'type' => 'raw',
            'value' => function($data){
					$activeIconClass = $data->active == 1 ? "i_tick" : "i_cross";
					if (Yii::app()->user->isAdmin())
					{
						echo CHtml::link("", Yii::app()->createUrl('comment/toggleActive',array('id'=>$data->user_post_comment_id)), array("class" => "btn small toggleActive " . $activeIconClass));
					} else {
						echo CHtml::link("", "javascript:;", array("class" => "btn small nolink " . $activeIconClass));
					}
            },
			'filter' => $model->getYesNoFilterArray(),
			'sortable' => true,
			'htmlOptions' => array('class' => 'button-column'),
			'headerHtmlOptions' => array('class' => 'button-column'),
        ),					
      
    ),
)); ?>
    
<?php  
	
$cs = Yii::app()->getClientScript();  

$js = <<<JS


   function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker();
	$("#page-summary select").uniform();
}
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>