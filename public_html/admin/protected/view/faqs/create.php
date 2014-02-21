<?php
/* @var $this PageController */
/* @var $model Pages */
/* @var $form CActiveForm  */

/**
 * @file       create.php$
 * @created    01/02/2014 2:29:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Webonerds
 */
?>

<div class='fl'>
	<h1>Create a Faq</h1>
	<p>Please fill out the form below to create a new Faq</p>
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>