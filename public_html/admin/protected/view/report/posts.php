<?php
/**
 * @file       posts.php$
 * @created    04/11/2013 4:13:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/* @var $this  ReportController */

$this->pageTitle = Yii::app()->name . ' - Post Reports';
?>

<h1>Post Stats</h1>


	<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'interval-form',
	)); ?>

		<?php echo CHtml::dropDownList('interval',$interval, array('select'=>'select','WEEK'=>'Week','MONTH'=>'Month','YEAR'=>'Year'));?>

	<?php $this->endWidget(); ?>



		

<div class="g6">
						<h3>User Post Status Report</h3>
						
						<table class="chart" data-type="pie" data-orientation="vertical">
							<thead>
								<tr>
									<th></th>
									<th>Active</th>
									<th>Inactive</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>User Posts</th>
									
										<?php
										
										foreach($postStatsArr as $monthData): ?>
										<td><?php echo $monthData['active'];?></td>
										<td><?php echo $monthData['inactive'];?></td>
										<?php endforeach; ?>

								</tr>
								
							</tbody>
						</table>
						</div>
						



<div class="g12">
<h1>Post Stats</h1>
<p>Graph to show the number of posts created </p>


<table class="chart" data-type="bars" data-stack="true">
		<thead>
			<tr>
				<th></th>
				<?php foreach($chartData as $monthData): ?>
				<th><?php echo $monthData['month'];?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>First Label</th>
				<?php foreach($chartData as $monthData): ?>
				<td><?php echo $monthData['active'];?></td>

				<?php endforeach; ?>
			</tr>$$$$
			<tr>
					<th>Second Label</th>
					<?php foreach($chartData as $monthData): ?>
					<td><?php echo $monthData['inactive'];?></td>
					<?php endforeach; ?>
			</tr>

		</tbody>
	</table>

<br/>
<br/>

<?php 
$cs = Yii::app()->getClientScript();  

$js = <<<JS
		
$(function() {
    $('#interval').change(function() {
        this.form.submit();
    });
});
		
JS;
$cs->registerScript('form', $js, CClientScript::POS_END);
?>


