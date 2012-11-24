<?php

class  Task
{
	public	$TaskID;
	public	$Description;
	public	$TaskEffor;
	public	$TaskValidate;
	public	$EndTime;
	public 	$comment;

	public function Task($taskID, $description, $effort){
		$this->TaskID = $taskID;
		$this->Description = $description;
		$this->TaskEffor = $effort;
	}
}

?>