<?php

/**
 * @file       feedback_msg.php$
 * @created    28/10/2013 9:43:04 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>

<p style="color: #234a6b; font-size: 16px; font-weight: bold;">Post Feedback Added</p>
Dear <?php echo $toUserModel->firstname; ?>
<p>A new feedback has been added to the post:-</p>
<p>Title: <?php echo $postModel->post_title; ?></p>
<p>Feedback: <?php echo $postFeedback->feedback; ?></p>
<p>Posted By: <?php echo $postFeedback->createdBy->getFullName(); ?></p>
