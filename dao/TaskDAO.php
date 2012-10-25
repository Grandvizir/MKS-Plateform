<?php


class TaskDAO
{
	private $factory;
	private static $QUERY_ADDTASK = "INSERT INTO task(TDescription, TEffort, SprintID)
										VALUES(:tid, :tdescription, :teffort, :sid)";

	private static $QUERY_RELATION_PRODUCT = "INSERT INTO sprint(ProductID)
										VALUES(pid)";

	private static $QUERY_RELATION_USER = "INSERT INTO usertask(SprintID, UserID)
										VALUES(:sid, :uid)";
	//TO-DO just one query with begin and rollback
	public function TaskDAO($daoFactory)
	{
		$this->factory = $daoFactory;
	}

	public function addTaskByProductID($model){
		$con = $this->factory->getConnexion();

	//	$con->beginTransaction();


		$secondStep = $con->prepare("INSERT INTO sprint (ProductID)
										VALUES(:pid)");
		$secondStep->execute(array(
						'pid' => $model->Product->ProductID
						));
		//	$con->commit();
		$newSprintID = $con->lastInsertId();
		//ID


		$firstStep = $con->prepare("INSERT INTO task(TDescription, TEffort, SprintID)
										VALUES(:tdescription, :teffort, :sid)");
		$firstStep->execute(array(
							'tdescription' => $model->Task->Description,
							'teffort' => $model->Task->TaskEffor,
							'sid' => $newSprintID
							));


		// foreach for add many User
		foreach ($model->ArrayUser as $u) {
			$thirdStep = $con->prepare("INSERT INTO usertask(SprintID, UserID)
										VALUES(:sid, :uid)");
			$thirdStep->execute(array(
					'sid' => $newSprintID,
					'uid' => $u
					));
			}
		//$con->commit();
	}
}
?>