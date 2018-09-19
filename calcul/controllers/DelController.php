<?php
require_once 'models/DelgroupModel.php';

class DelController
{
    public function actionDel()
    {		
		if (!empty($_GET['customer']) AND !empty($_GET['id_product']) AND empty($_GET['customerall'])) {	
		   $entity_code = $_GET['customer'];
	       $id_product  = $_GET['id_product'];	
		   $customerall = null;
		   $followingLink = $_GET['customer'];
		} elseif (empty($_GET['customer']) AND empty($_GET['id_product']) AND !empty($_GET['customerall'])) {
		   $entity_code = null;
	       $id_product  = null;
		   $customerall = $_GET['customerall'];
		   $followingLink = $_GET['customerall'];
		}
		$obj = new DelgroupModel();
		$obj->delGroups($entity_code, $id_product, $customerall);

	    print '<script>document.location.href = "?uri=cardview&customer='.$followingLink.'";</script>';							
	    return true;	
  }	
}