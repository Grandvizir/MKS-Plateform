<?php

class ModelDAO
{
	private $factory;
	private static $QUERY_ALL_DEPENDECY = "SELECT *
											FROM `product`, `sprint`, `task`, `user`
											where `product`.ProductID = `sprint`.ProductID
											AND `sprint`.SprintID = `task`.SprintID
											GROUP BY  `task`.TaskID";

	private static $QUERY_PRODUCTID_DEPENDECY = "SELECT *
											FROM `product`, `sprint`, `task`, `user`
											where `product`.ProductID = `sprint`.ProductID
											AND `sprint`.SprintID = `task`.SprintID
											AND `product`.ProductID = :productID
											GROUP BY `task`.TaskID";


	public function ModelDAO($daoFactory)
	{
		$this->factory = $daoFactory;
	}

	public function getAllWithDependency()
	{
		$con = $this->factory->getConnexion();
		$reponse = $con->query(self::$QUERY_ALL_DEPENDECY);
		$array = array();

		while($donnees = $reponse->fetch())
		{
			$model = new Model();
			$model->Product = new Product($donnees['ProductID'],
									$donnees['PItem'], $donnees['PDetails'],
									$donnees['PPriority'], $donnees['PEstimateValue'],
									$donnees['PEstimateEffort'],
									$donnees['PRemaining']);

			$model->Task = new Task($donnees['TaskID'], $donnees['TDescription'], $donnees['TEffort']);
			$model->Task->TaskValidate = $donnees['validate'];
			$model->Task->EndTime = $donnees['endTime'];

			$model->Sprint = new Sprint($donnees['SprintID']);
			//$model->User = new User($donnees['UserID'], $donnees['UName'], $donnees['ULastName'], $donnees['UMail']);
			array_push($array, $model);
		}
		return $array;
	}

	public function getAllDependencyByProductID($productID)
	{
		$con = $this->factory->getConnexion();
		$reponse = $con->prepare(self::$QUERY_PRODUCTID_DEPENDECY);
		$reponse->execute(array('productID' => $productID));

		$array = array();
		while($donnees = $reponse->fetch())
		{
			$model = new Model();
			$model->Product = new Product($donnees['ProductID'],
									$donnees['PItem'], $donnees['PDetails'],
									$donnees['PPriority'], $donnees['PEstimateValue'],
									$donnees['PEstimateEffort'],
									$donnees['PRemaining']);

			$model->Task = new Task($donnees['TaskID'], $donnees['TDescription'], $donnees['TEffort']);
			$model->Task->TaskValidate = $donnees['validate'];
			$model->Task->EndTime = $donnees['endTime'];
			$model->Task->comment = $donnees['comment'];
			$model->Sprint = new Sprint($donnees['SprintID']);
			//$model->User = new User($donnees['UserID'], $donnees['UName'], $donnees['ULastName'], $donnees['UMail'], $donnees['SprintID']);
			array_push($array, $model);
		}
		return $array;
	}
}

?>