<?php
/* @var $userModel Users*/
/**
 * @file       approved.php$
 * @created    11/10/2013 6:32:53 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */
?>
<p style="color: #234a6b; font-size: 16px; font-weight: bold;">Post Approved</p>
Dear <?php echo $userModel->getFullname(); ?>
<p>Your post with following details has been approved:-</p>
<p>Title: <?php echo $postModel->post_title; ?></p>
<p>Content: <?php echo $postModel->post_content; ?></p>
