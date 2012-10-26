<?php

class TaskDAO
{
	private $factory;
	private static $QUERY_ADDTASK = "INSERT INTO task(TDescription, TEffort, SprintID)
										VALUES(:tdescription, :teffort, :sid)";

	private static $QUERY_RELATION_PRODUCT = "INSERT INTO sprint(ProductID)
										VALUES(:pid)";

	private static $QUERY_RELATION_USER = "INSERT INTO usertask(SprintID, UserID)
										VALUES(:sid, :uid)";
	private static $QUERY_TASK_BYID = "SELECT * FROM `task`, `sprint`
											WHERE TaskID = :tid
											AND `task`.SprintID = `sprint`.SprintID";

	private static $QUERY_UPDATE_TASkBYID = "UPDATE task SET TDescription = :tdescription, TEffort = :teffort
											where TaskID = :tid";
	private static $QUERY_DELETE_USER_RELATION = "DELETE FROM usertask where SprintID = :sid
													AND UserID = :uid
													";


	//TO-DO just one query with begin and rollback
	public function TaskDAO($daoFactory)
	{
		$this->factory = $daoFactory;
	}
	public function addTaskByProductID($model){
		$con = $this->factory->getConnexion();

		$con->beginTransaction();

		$secondStep = $con->prepare(self::$QUERY_RELATION_PRODUCT);
		$secondStep->execute(array(
						'pid' => $model->Product->ProductID
						));
		$newSprintID = $con->lastInsertId();
		$firstStep = $con->prepare(self::$QUERY_ADDTASK);
		$firstStep->execute(array(
							'tdescription' => $model->Task->Description,
							'teffort' => $model->Task->TaskEffor,
							'sid' => $newSprintID
							));
		foreach ($model->ArrayUser as $u) {
			$thirdStep = $con->prepare(self::$QUERY_RELATION_USER);
			$thirdStep->execute(array(
					'sid' => $newSprintID,
					'uid' => $u
					));
			}
	 	$con->commit();
	}
	public function getTaskByID($id)
	{
		$con = $this->factory->getConnexion();
		$query = $con->prepare(self::$QUERY_TASK_BYID);
		$query->execute(array('tid' => $id));
		$model = new Model();
		if($donnees = $query->fetch()){
			$model->Task = new Task($donnees['TaskID'],	$donnees['TDescription'], $donnees['TEffort']);
			$model->Sprint = new Sprint($donnees['SprintID']);
		}
		return $model;
	}

	public function updateTaskByID($model)
	{
		$con = $this->factory->getConnexion();

		$con->beginTransaction();

		$query = $con->prepare(self::$QUERY_UPDATE_TASkBYID);
		$query->execute(array(
						'tdescription' => $model->Task->Description,
						'teffort' => $model->Task->TaskEffor,
						'tid' => $model->Task->TaskID
						));


		$daoFactory = IDaoFactory::getInstance();
		$UserDAO = $daoFactory->getUserDAO();
		$currentUser = $UserDAO->getAllUserByTaskID($model->Task->TaskID);

		foreach ($currentUser as $u) {
		$firstStep = $con->prepare(self::$QUERY_DELETE_USER_RELATION);
		$firstStep->execute(array(
			'sid' => $model->Sprint->SprintID,
			'uid' => $u->User->getUserID()
				));
		}
		foreach ($model->ArrayUser as $i) {

			$secondStep = $con->prepare(self::$QUERY_RELATION_USER);
			$secondStep->execute(array(
					'sid' => $model->Sprint->SprintID,
					'uid' => $i
					));
		}
		$con->commit();
	}
}
?>