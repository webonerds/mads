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

$this->pageTitle = Yii::app()->name . ' - Message Sent Summary';
?>

<h1>Sent</h1>
<p>Below is a summary of all the sent email messages</p>			

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>
	
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
	'filter' => $model,
	'rowCssClass' => array('gradeB odd', 'gradeB even'),
    'columns' => array(
		array(
            'name' => 'to_user_id',
            'type' => 'raw',
            'value' => 'CHtml::value($data,"toUser.fullName")',
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
			'header' => 'Sent On',
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
            )
        ),
		array(
            'header' => 'Sent Success',
			'type' => 'raw',
            'value' => '$data->sent_successful ? CHtml::link(\'\', \'javascript:;\', array(\'class\' => \'btn small i_tick nolink\')) : CHtml::link(\'\', \'javascript:;\', array(\'class\' => \'btn small i_cross nolink\'))',
			'htmlOptions' => array('class' => 'button-column')
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
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>
