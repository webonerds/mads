<?php
/* @var $this ErrorController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h1><?php echo $code; ?></h1>
<hr>
<p><?php echo CHtml::encode($message); ?></p>