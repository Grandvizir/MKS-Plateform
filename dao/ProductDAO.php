<?php
class ProductDAO
{
	private $factory;
	private static $QUERY_ALL_PRODUCT = "SELECT * FROM `product`";
	private static $QUERY_PODUCT_BYID = "SELECT * FROM `product`
											WHERE ProductID = :pid";

	private static $QUERY_UPDATE_BYID = 'UPDATE product SET PItem = :item, PDetails = :detail,
											PPriority = :priority, PEstimateValue = :estimateValue,
											PEstimateEffort = :effort, PRemaining = :remaining
											where productID=:pid';

	private static $QUERY_ADD_PRODUCT = "INSERT INTO `product`(PItem, PDetails,
											PPriority, PEstimateValue, PEstimateEffort, PRemaining)
											VALUES (:item, :detail, :priority,
											:estimateValue, :effort, :remaining)";

	public function ProductDAO($daoFactory)
	{
		$this->factory = $daoFactory;
	}

	public function AddNewProduct($model){
		$con = $this->factory->getConnexion();
		$firstStep = $con->prepare(self::$QUERY_ADD_PRODUCT);
		$firstStep->execute(array(
							'item' => $model->Product->Item,
							'detail' => $model->Product->Detail,
							'priority' => $model->Product->Priority,
							'estimateValue' => $model->Product->EstimateValue,
							'effort' => $model->Product->Effort,
							'remaining' => $model->Product->remaining
							));
	}

	public function getAllProduct()
	{
		$con = $this->factory->getConnexion();
		$reponse = $con->query(self::$QUERY_ALL_PRODUCT);
		$array = array();
		while($donnees = $reponse->fetch())
		{
			$model = new Model();
			$model->Product = new Product($donnees['ProductID'],
									$donnees['PItem'], $donnees['PDetails'],
									$donnees['PPriority'], $donnees['PEstimateValue'],
									$donnees['PEstimateEffort'],
									$donnees['PRemaining']);
			array_push($array, $model);
		}
		return $array;
	}

	public function getProductByID($id)
	{
		$con = $this->factory->getConnexion();
		$query = $con->prepare(self::$QUERY_PODUCT_BYID);
		$query->execute(array('pid' => $id));
		$model = new Model();
		if($donnees = $query->fetch())
		{

			$model->Product = new Product($donnees['ProductID'],
									$donnees['PItem'], $donnees['PDetails'],
									$donnees['PPriority'], $donnees['PEstimateValue'],
									$donnees['PEstimateEffort'],
									$donnees['PRemaining']);
		}
		return $model;
	}

	public function UpdateProductByID($model){
		$con = $this->factory->getConnexion();
		$reponse = $con->prepare(self::$QUERY_UPDATE_BYID);
		$reponse->execute(array(
							'pid' => $model->Product->ProductID,
							'item' => $model->Product->Item,
							'detail' => $model->Product->Detail,
							'priority' => $model->Product->Priority,
							'estimateValue' => $model->Product->EstimateValue,
							'effort' => $model->Product->Effort,
							'remaining' => $model->Product->remaining
							));
	}
}
?>