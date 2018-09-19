<?php
require_once 'models/ConnectBD.php';
    
class DelgroupModel 
{	
    public function delGroups($customer, $id_product, $customerall) {
       if(isset($customer) AND isset($id_product) AND !isset($customerall)) {		
	        $entity_code = $_GET['customer'];
	        $id_product  = $_GET['id_product'];	  
	        $card_del    = "DELETE FROM card WHERE entity_code = {$entity_code} AND id_product = {$id_product} ";
	        ConnectBD::getConnect()->query($card_del);
            $koef_del = "DELETE FROM koef WHERE entity_code = {$entity_code} AND id_product = {$id_product} ";
	        ConnectBD::getConnect()->query($koef_del);	  
	    } elseif(!isset($customer) AND !isset($id_product) AND isset($customerall)) {		
		    $entity_code = $_GET['customerall'];	
	        $card_del    = "DELETE FROM card WHERE entity_code = {$entity_code}";
	        ConnectBD::getConnect()->query($card_del);
            $koef_del = "DELETE FROM koef WHERE entity_code = {$entity_code}";
	        ConnectBD::getConnect()->query($koef_del);
	    }		
	}   
}
