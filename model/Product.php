<?php

class Product{
	public	$ProductID;
	public	$Item;
	public	$Detail;
	public	$Priority;
	public	$EstimateValue;
	public  $Effor;
	public	$Remaining;
	public function Product($productID, $item, $detail, $priority, $estimateValue, $effort, $remaining){
		$this->ProductID = $productID;
		$this->Item = $item;
		$this->Detail = $detail;
		$this->Priority = $priority;
		$this->EstimateValue = $estimateValue;
		$this->Effor = $effort;
		$this->Remaining = $remaining;
	}
}

?>