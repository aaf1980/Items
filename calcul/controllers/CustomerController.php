<?php
require_once 'models/CustomerModel.php';

class CustomerController 
{
	public function actionIndex()
	{	 
	    $obj = new CustomerModel(); 
		$customerList = $obj->getCustomerList();     		
		if (!empty($_POST['entity']) OR !empty($_POST['customer']) 
				   OR !empty($_POST['type'])) {		  		
		  $customerList = $obj->getPoiskCustomer();
		} 			
		$paningacia = $obj->getPaningaciaCustomer();		
		include 'view/controllerview/CustomerView.php';								
		return true;
	}    
}