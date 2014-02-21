<?php

/**
 * @file       _seo.php$
 * @created    23/10/2013 8:48:08 AM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>

<fieldset>

	<label>SEO Attributes</label>
	
	<section>
		<?php echo $form->labelEx($model, 'meta_title'); ?>
		<div><?php echo $form->textField($model, 'meta_title'); ?></div>
		<?php echo $form->error($model, 'meta_title'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'meta_keywords'); ?>
		<div><?php echo $form->textField($model, 'meta_keywords'); ?></div>
		<?php echo $form->error($model, 'meta_keywords'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'meta_description'); ?>
		<div><?php echo $form->textArea($model, 'meta_description', array('rows' => 2)); ?></div>
		<?php echo $form->error($model, 'meta_description'); ?>
	</section>
	
</fieldset>
