<?php
/* @var $this MessageController */
/* @var $model EmailMessages */
/* @var $cs CClientScript */

/**
 * @file       viewmessage.php$
 * @created    16/10/2013 1:56:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>
<style type="text/css">
	table.header, table.footer{display: none;}
	table.outer tr td.outercolumn {padding: 0px !important;}
	table {margin-bottom: 0px;}
</style>
<div>
	<?php echo $model->body_contents; ?>
</div>