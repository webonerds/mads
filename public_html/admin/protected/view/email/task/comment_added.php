<?php

/**
 * @file       comment_added.php$
 * @created    28/10/2013 11:25:04 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>

<p style="color: #234a6b; font-size: 16px; font-weight: bold;">Task Comment Added</p>
Dear <?php echo $toUserModel->firstname; ?>,
<p>A new comment has been added to the task:-</p>
<p>Task: <?php echo $taskModel->title; ?></p>
<p>Comment: <?php echo $taskCommentModel->comment; ?></p>
<p>Posted By: <?php echo $taskCommentModel->createdBy->getFullName(); ?></p>
