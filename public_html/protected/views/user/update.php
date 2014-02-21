<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class='fl'>
	<h1>Edit an User</h1>
	<p>Please fill out the form below to edit an user</p>
</div>
<div class='clearfix'></div>

<?php if(Yii::app()->user->hasFlash('message')): ?>
	<div class="alert success"><?php echo Yii::app()->user->getFlash('message'); ?></div>
<?php endif;?>
	
<?php
$this->renderPartial('_form_update' ,array('model'=>$model, 'userRoles' => $userRoles)); ?>