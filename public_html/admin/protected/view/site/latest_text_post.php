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
    'dataProvider' => UserPosts::model()->latestPicturePosts(),
	'columns' => array(
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
   