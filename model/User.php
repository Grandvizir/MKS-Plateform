<?php

class User
{

	private $UserID;
	private $UserName;
	private $UserLastName;
	private $UserMail;
	private $SprintID;

	public function User($userID, $userName, $userLastName, $userMail, $sprintID)
	{
		$this->UserID = $userID;
		$this->UserName = $userName;
		$this->UserLastName = $userLastName;
		$this->UserMail = $userMail;
		$this->SprintID = $sprintID;
	}

	public function getUserID(){
		return $this->UserID;
	}

	public function setUserID($UserID){
		$this->UserID = $UserID;
	}

	public function getUserName(){
		return $this->UserName;
	}

	public function setUserName($UserName){
		$this->UserName = $UserName;
	}

	public function getUserLastName(){
		return $this->UserLastName;
	}

	public function setUserLastName($UserLastName){
		$this->UserLastName = $UserLastName;
	}

	public function getUserMail(){
		return $this->UserMail;
	}

	public function setUserMail($UserMail){
		$this->UserMail = $UserMail;
	}

	public function getSprintID(){
		return $this->SprintID;
	}

	public function setSprintID($sprintID){
		$this->SprintID = $sprintID;
	}
}
?>