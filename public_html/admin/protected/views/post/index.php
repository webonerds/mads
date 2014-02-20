<?php
/**
 * @file       index.php$
 * @created    05/02/2014 12:13:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

/* @var $this  PageController */
/* @var $model Pages */
$this->pageTitle = Yii::app()->name . ' - Posts Summary';
?>

<h1>Post Summary</h1>
<p>Below is a summary of all the Post in the system</p>			

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
            'name' => 'picture_media_file_id',
            'type' => 'raw',
            'value' => function(UserPosts $data){
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
        array(
            'name' => 'post_type',
            'type' => 'raw',
            'value' => 'ucfirst($data->post_type)',
			'filter' => array('' => 'All', 'picture' => 'Picture', 'story' => 'Story'),
			'htmlOptions'=>array('width'=>'10%')
        ),
		array(
            'name' => 'comment',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->comment)',
			'htmlOptions'=>array('width'=>'20%')
			
        ),
		array(
            'name' => 'total_likes',
            'type' => 'raw',
            'value' => '$data->total_likes',
			'filter' => false,
			'headerHtmlOptions' => array('width' => '10%'),
        ),
		array(
            'name' => 'total_comments',
            'type' => 'raw',
            'value' => 'CHtml::link($data->numComments,Yii::app()->createUrl("comment/index",array("user_post_id"=>$data->user_post_id)))',
			'filter' => false,
			'headerHtmlOptions' => array('width' => '10%'),
        ),
		array(
            'name' => 'total_shares',
            'type' => 'raw',
            'value' => '$data->total_shares',
			'filter' => false,
			'headerHtmlOptions' => array('width' => '10%'),
        ),		
		array(
            'name' => 'active',
            'type' => 'raw',
            'value' => function($data){
					$activeIconClass = $data->active == 1 ? "i_tick" : "i_cross";
					if (Yii::app()->user->isAdmin())
					{
						echo CHtml::link("", Yii::app()->createUrl('post/toggleActive',array('id'=>$data->user_post_id)), array("class" => "btn small toggleActive " . $activeIconClass));
					} else {
						echo CHtml::link("", "javascript:;", array("class" => "btn small nolink " . $activeIconClass));
					}
            },
			'filter' => $model->getYesNoFilterArray(),
			'sortable' => true,
			'htmlOptions' => array('class' => 'button-column','width' => '10%'),
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
			'htmlOptions' => array('width' => '10%'),
		
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