<?php
require_once 'models/PgroupModel.php';

class PgroupController 
{
	public function actionPgroup()
	{	
	    $product = new PgroupModel();
	    $obj = $product->CustomerInformation();		
		$pgroupList = $product->getPgroupList();		
	    $id_product = $product->getIdProduct();						
		include 'view/controllerview/PgroupView.php';								
		return true;				
	}	
}