<?php
$path = 'agile.php';
if(!empty($_GET['page']) && $_GET['page'] != null)
{
	switch($_GET['page'])
	{
		case 'sprint' :
			$path = 'sprint.php';
			break;
		case 'edit-item':
			$path = 'edit_item.php';
			break;
		case 'edit-task':
			$path = 'edit_task.php';
			break;



	}
}

?>