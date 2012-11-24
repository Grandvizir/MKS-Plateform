<?php

if(!empty($_POST['actionPostAddTask']) && $_POST['actionPostAddTask'] == 1)
{


	if(!empty($_POST['description']) && !empty($_POST['Effort'])
		&& !empty($_POST['user']) && !empty($_POST['product']))
	{
		include('../model/Model.php');
		include('../dao/factory/IDaoFactory.php');

		$daoFactory = IDaoFactory::getInstance();
		$taskDAO = $daoFactory->getTaskDAO();
		$model->Task->Description = $_POST['description'];
		$model->Task->TaskEffor = $_POST['Effort'];
		$model->ArrayUser = $_POST['user'];
		$model->Product->ProductID = $_POST['product'];
		$taskDAO->addTaskByProductID($model);
		header("location:../index.php?page=sprint");
	}
	else
		header("location:../index.php?not");
}
if(!empty($_POST['actionPostAddProduct']) && $_POST['actionPostAddProduct'] == 1){
	if(!empty($_POST['item']) && !empty($_POST['detail']) && !empty($_POST['priority']) &&
			 !empty($_POST['EstimateValue']) && !empty($_POST['effort'])
			 &&	!empty($_POST['remaining']))
	{
		include('../model/Model.php');
		include('../dao/factory/IDaoFactory.php');

		$daoFactory = IDaoFactory::getInstance();
		$productDAO = $daoFactory->getProductDAO();

		$model = new Model();
		$model->Product->Item = $_POST['item'];
		$model->Product->Detail = $_POST['detail'];
		$model->Product->Priority = $_POST['priority'];
		$model->Product->EstimateValue = $_POST['EstimateValue'];
		$model->Product->Effort = $_POST['effort'];
		$model->Product->remaining = $_POST['remaining'];
		$productDAO->AddNewProduct($model);
		header("location:../index.php?ok");
	}
	else
		header("location:../index.php?nok");


}
if(!empty($_POST['actionPostEditProduct']) && $_POST['actionPostEditProduct'] == 1){


	if(!empty($_POST['item']) && !empty($_POST['detail']) && !empty($_POST['priority']) &&
		!empty($_POST['EstimateValue']) && !empty($_POST['effort'])
		&&	!empty($_POST['remaining']) && !empty($_POST['ProductID']))
	{
		include('../model/Model.php');
		include('../dao/factory/IDaoFactory.php');

		$daoFactory = IDaoFactory::getInstance();
		$productDAO = $daoFactory->getProductDAO();

		$model = new Model();
		$model->Product->ProductID = $_POST['ProductID'];
		$model->Product->Item = $_POST['item'];
		$model->Product->Detail = $_POST['detail'];
		$model->Product->Priority = $_POST['priority'];
		$model->Product->EstimateValue = $_POST['EstimateValue'];
		$model->Product->Effort = $_POST['effort'];
		$model->Product->remaining = $_POST['remaining'];
		$productDAO->UpdateProductByID($model);
		header("location:../index.php?ok");
	}
	else
		header("location:../index.php?nok");


}
if(!empty($_POST['actionPostEditTask']) && $_POST['actionPostEditTask'] == 1){
	if(!empty($_POST['description']) && !empty($_POST['effort'])
		&& !empty($_POST['user']) && !empty($_POST['TaskID']) && !empty($_POST['SprintID']))
	{
		include('../model/Model.php');
		include('../model/Task.php');
		include('../model/User.php');
		include('../dao/factory/IDaoFactory.php');

		$daoFactory = IDaoFactory::getInstance();
		$taskDAO = $daoFactory->getTaskDAO();

		$model->Task->Description = $_POST['description'];
		$model->Task->TaskEffor = $_POST['effort'];
		$model->ArrayUser = $_POST['user'];
		$model->Task->TaskID = $_POST['TaskID'];
		$model->Sprint->SprintID = $_POST['SprintID'];
		$taskDAO->updateTaskByID($model);
		header("location:../index.php?page=sprint");
	}
	else
		header("location:../index.php?page=edit-task&id=".$_POST['TaskID']);
}
if(!empty($_POST['validate']) && is_numeric($_POST['validate']) && !empty($_POST['TaskID']))
{
	include('../model/Task.php');
	include('../dao/factory/IDaoFactory.php');

	$daoFactory = IDaoFactory::getInstance();
	$taskDAO = $daoFactory->getTaskDAO();

	$taskDAO->validateSprintByID($_POST['TaskID'], $_POST['validate']);
	header("location:../index.php?page=sprint");
}
if(!empty($_POST['comment']) && !empty($_POST['TaskID']))
{
	include('../model/Task.php');
	include('../dao/factory/IDaoFactory.php');

	$daoFactory = IDaoFactory::getInstance();
	$taskDAO = $daoFactory->getTaskDAO();
	$taskDAO->updateComment($_POST['TaskID'], $_POST['comment']);
	header("location:../index.php?page=sprint");

}
?>