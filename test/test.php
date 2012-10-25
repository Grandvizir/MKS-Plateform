<?php


include('dao/factory/IDaoFactory.php');
include('model/User.php');
include('model/Model.php');
include('model/Product.php');
include('model/Sprint.php');
include('model/Task.php');

$daoFactory = IDaoFactory::getInstance();
$modelDAO = $daoFactory->getModelDAO();


$modelDAO->getAllWithDependency();
$data = $modelDAO->getAllDependencyByProductID(1);
var_dump($data);

?>