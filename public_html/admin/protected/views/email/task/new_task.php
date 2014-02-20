<?php

/**
 * @file       new_task.php$
 * @created    22/10/2013 2:18:27 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>
<p style="color: #234a6b; font-size: 16px; font-weight: bold;">New Task Assigned</p>
Dear <?php echo $user->firstname; ?>,
<p>A new task with the below details has been assigned to you:
<br><b>Title</b>: <i><?php echo $task->title;?></i>
</p>
<p>Please login to the portal to access / comment on the task.</p>