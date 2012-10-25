<?php
include($_SERVER['DOCUMENT_ROOT'].'MKS/mks/plateform/dao/TaskDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'MKS/mks/plateform/dao/UserDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'MKS/mks/plateform/dao/ProductDAO.php');
include($_SERVER['DOCUMENT_ROOT'].'MKS/mks/plateform/dao/ModelDAO.php');

class MySqlDaoFactory{
	private static $PROPERTY_CONNEXION = "mysql:host=localhost;dbname=mks";
	private static $PROPERTY_PASSWORD = "";
	private static $PROPERTY_USERNAME = "root";

	public function getConnexion(){
		$bdd = new PDO(self::$PROPERTY_CONNEXION, self::$PROPERTY_USERNAME, self::$PROPERTY_PASSWORD);
		return $bdd;
	}

	public function getTaskDAO(){
		return new TaskDAO($this);
	}
	public function getUserDAO() {
		return new UserDAO($this);
	}
	public function getProductDAO() {
		return new ProductDAO($this);
	}
	public function getModelDAO() {
		return new ModelDAO($this);
	}

}
?>