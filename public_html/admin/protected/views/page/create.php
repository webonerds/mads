<?php
/* @var $this PageController */
/* @var $model Pages */
/* @var $form CActiveForm  */

/**
 * @file       create.php$
 * @created    11/11/2013 2:29:31 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */
?>

<div class='fl'>
	<h1>Create a Page</h1>
	<p>Please fill out the form below to create a new page</p>
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php $this->renderPartial('_form' ,array('model'=>$model)); ?>
