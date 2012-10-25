<?php

class UserTask
{

	public $UserTaskID;
	public $SprintID;
	public $TaskID;

	public function UserTask($userTaskID, $sprintID, $taskID){
		$this->UserTaskID = $userTaskID;
		$this->SprintID = $sprintID;
		$this->TaskID = $taskID;
	}
}

?>