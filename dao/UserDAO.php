<?php

class UserDAO
{
	private $factory;
	private static $QUERY_ALL_USER = "SELECT * FROM user";

	private static $QUERY_ALL_USERBYTASKID = "SELECT `task`.TaskID, `user`.UserID,
													 `user`.UName, `user`.ULastName,
													 `user`.UMail, `task`.TDescription,
													 `task`.TEffort,  `task`.SprintID
													FROM `usertask`, `sprint`, `task`, `user`
													WHERE `usertask`.SprintID = `task`.SprintID
													AND `user`.UserID = `usertask`.UserID
													AND `sprint`.SprintID = `task`.SprintID
													AND `task`.TaskID = :tid
													GROUP BY `user`.UserID";

	public function UserDAO($daoFactory)
	{
		$this->factory = $daoFactory;
	}

	public function getAllUser(){
		$con = $this->factory->getConnexion();
		$reponse = $con->query(self::$QUERY_ALL_USER);
		$array = array();
		while($donnees = $reponse->fetch())
		{
			$model = new Model();
			$model->User = new User($donnees['UserID'], $donnees['UName'], $donnees['ULastName'], $donnees['UMail'], $donnees['SprintID']);
			array_push($array, $model);
		}
		return $array;
	}

	public function getAllUserByTaskID($taskID)
	{
		$con = $this->factory->getConnexion();
		$reponse = $con->prepare(self::$QUERY_ALL_USERBYTASKID);
		$reponse->execute(array(
							'tid' => $taskID
							));
		$array = array();
		while($donnees = $reponse->fetch())
		{
			$model = new Model();
			$model->Task = new Task($donnees['TaskID'], $donnees['TDescription'], $donnees['TEffort']);
			$model->User = new User($donnees['UserID'], $donnees['UName'], $donnees['ULastName'], $donnees['UMail'], $donnees['SprintID']);
			array_push($array, $model);

		}
		return $array;
	}
}
?>