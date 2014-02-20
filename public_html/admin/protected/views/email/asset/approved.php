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
<p style="color: #234a6b; font-size: 16px; font-weight: bold;">Asset Approved</p>
Dear <?php echo $userModel->getFullname(); ?>
<p>Your asset with following details has been approved:-</p>
<p>Title: <?php echo $assetModel->title; ?></p>
<p>Caption: <?php echo $assetModel->caption; ?></p>
<p>Description: <?php echo $assetModel->description; ?></p>
