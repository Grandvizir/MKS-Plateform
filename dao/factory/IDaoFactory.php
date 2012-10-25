<?php

include('MysqlDaoFactory.php');
abstract class IDaoFactory{
	static private $instance;

	public function getInstance(){
		if(self::$instance == null)
		{
			self::$instance = new MysqlDaoFactory();
		}
		return self::$instance;
	}

	public abstract function getConnexion();

	public abstract function getProductDAO();
	public abstract function getModelDAO();
	public abstract function getSprintDAO();
	public abstract function getTaskDAO();
	public abstract function getUserDAO();

}
?>