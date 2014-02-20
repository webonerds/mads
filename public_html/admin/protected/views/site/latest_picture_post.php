<?php

/**
 * @file       latest_post.php$
 * @created    Feb 10, 2014 7:24:05 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */

?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'page-summary',
    'dataProvider' => UserPosts::model()->latestStoryPosts(),
	'pager'=>array('header'=>''),
	'columns' => array(
	
     array(
            'name' => 'picture_media_file_id',
            'type' => 'raw',
            'value' => function(UserPosts $data){
				if (!empty($data->picture_media_file_id))
				{
					echo '<a class="btn small fancybox" href="'. $data->getUploadedFileFullPath('picture')  
							.'"><img src="'. $data->getUploadedFileFullPath('picture')  .'" width="50"></a>';
				}
			},
			'headerHtmlOptions' => array('width' => '15%'),
			'filter' => false,
			'sortable' => false,
			'header' => 'Picture',
			'headerHtmlOptions' => array('width' => '10%'),
        ),
		array(
            'name' => 'user_id',
			'header'=>'Created by',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->user->firstname. " ". $data->user->lastname)'
        ),
		array(
            'name' => 'comment',
			'header'=>'Post Comment',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->comment)'
        ),
	

    ),
)); ?>
   