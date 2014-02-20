<?php
/**
 * @file       postsByUsers.php$
 * @created    08/11/2013 4:13:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */

/* @var $this  ReportController */

$this->pageTitle = Yii::app()->name . ' - Post By Users Reports';
?>

<h1>Post by Users Stats</h1>
<p>Graph to show the number of posts created in the last 5 months</p>

<?php foreach($usersMonthsDataArr as $user_id => $userMonthsDataArr): ?>
	<?php foreach($userMonthsDataArr as $fullname => $monthsDataArr): ?>
		<h3>Posts By - <?php echo $fullname; ?></h3>
		<br>
		<table class="chart" data-type="bars" data-stack="false">
			<thead>
				<tr>
					<th></th>
					<?php foreach($monthsDataArr as $monthData): ?>
					<th><?php echo $monthData['month'];?></th>
					<?php endforeach; ?>
				</tr>	
			</thead>
			<tbody>
				<tr>
					<th>Approved</th>
					<?php foreach($monthsDataArr as $monthData): ?>
					<td><?php echo $monthData['approved'];?></td>
					</td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th>Unapproved</th>
					<?php foreach($monthsDataArr as $monthData): ?>
					<td><?php echo $monthData['unapproved'];?></td>
					<?php endforeach; ?>
				</tr>

			</tbody>

		</table>
	<?php endforeach; ?>	
<?php endforeach; ?>