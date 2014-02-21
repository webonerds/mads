<?php
/**
 * @file       create.php$
 * @created    Feb 7, 2014 7:29:43 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Ajij Attar
 */


?>
<div class='fl'>
	<h1>Create a News</h1>
	<p>Please fill out the form below to create a new News</p>
</div>
<a class='i_bended_arrow_left btn icon fr backSummary' href='<?php echo Yii::app()->createUrl($this->uniqueId . '/index'); ?>'>Back to Summary</a>
<div class='clearfix'></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
