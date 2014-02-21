<?php
/* @var $model EmailMessages */

/**
 * @file       index.php$
 * @created    14/10/2013 12:13:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/* @var $this  AssetController */
/* @var $model Assets */

$this->pageTitle = Yii::app()->name . ' - Message Inbox Summary';
?>

<h1>Inbox</h1>
<p>Below is a summary of all the email messages received</p>			

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>
	
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
	'filter' => $model,
	'rowCssClass' => array('gradeB odd', 'gradeB even'),
	'rowCssClassExpression'=>'$data->mark_as_read==0?"black-row":""',
	'afterAjaxUpdate'=>'afterAjaxUpdate',
    'columns' => array(
		array(
            'name' => 'from_user_id',
            'type' => 'raw',
            'value' => 'CHtml::value($data,"fromUser.fullName")',
			'filter' => false
        ),
		array(
            'name' => 'subject',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->subject)'
        ),
        array(
            'name' => 'created_on',
            'type' => 'raw',
            'value' => 'GeneralUtilities::convertMysqlDateFormat($data->created_on, \'dd/MM/yyyy HH:mm\')',
			'header' => 'Received On',
			'filter' => false
        ),
		array(
            'class' => 'CButtonColumn',
            'template' => '{update}',
            'header' => 'View Message',
            'updateButtonImageUrl' => false,
            'updateButtonLabel' => '',
			'updateButtonUrl' => 'array(\'message/view\',\'id\'=>$data->email_message_id, \'ajax\'=>1)',
            'updateButtonOptions' => array(
                 'class' => 'btn small i_magnifying_glass fancybox'
            ),
			'headerHtmlOptions' => array('class' => 'button-column'),
        ),
		array(
            'name' => 'message_replied',
            'type' => 'raw',
            'value' => function($data){
                echo '<a class="btn small nolink ' . (($data->message_replied == 1) ? 'i_tick' : 'i_cross') . '" href="javascript:;"></a>';
            },
			'filter' => $model->getYesNoFilterArray(),
			'sortable' => true,
			'htmlOptions' => array('class' => 'button-column'),
			'headerHtmlOptions' => array('class' => 'button-column'),
        ),
		array(
            'header' => 'Reply',
			'type' => 'raw',
            'value' => '($data->from_user_id != null) ? CHtml::link(\'\', array(\'message/reply\', \'id\'=>$data->email_message_id), array(\'class\' => \'btn small i_bended_arrow_left	\')) : \'\'',
			'htmlOptions' => array('class' => 'button-column'),
			'headerHtmlOptions' => array('class' => 'button-column'),
        )
    ),
)); ?>
    
<?php 
$cs = Yii::app()->getClientScript();  	

$js = <<<JS
$(document).ready(function(){
		
	$(".toggleApproved").live('click', function(e){
		e.preventDefault();
		var obj = $(this);
		$.post($(this).attr('href'), function(data){
			if (data.approved)
				$(obj).removeClass('i_cross').addClass('i_tick');
			else
				$(obj).removeClass('i_tick').addClass('i_cross');
		});
		return false;
    });
});
		
function afterAjaxUpdate(id, data){
	$("select").uniform();
}
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>
