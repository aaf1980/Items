<?php   
class CountkoefModel 
{	
    protected  function CustomerInformation()
	{
	    
		 //метод связан с контроллером PgroupController.php вывод инф о клиенте		
		if (!empty($_GET['customer']))        	 
		   $entity_code = $_GET['customer'];
		 
		$result = ConnectBD::getConnect()->query("SELECT name,type,sort_my,entity_code FROM customer WHERE entity_code = '{$entity_code}'");
		$obj = $result->fetch_object();
        		
		return $obj;
    }
	
	protected function getCountkoefList()
	{				
		if (!empty($_GET['customer'])) 
         $entity_code = $_GET['customer'];
	    if (!empty($_GET['koef'])) 
		  $entity_code = $_GET['koef'];
		if (!empty($_GET['product'])) 
		  $product_group = $_GET['product']; 	 
	    $str = "SELECT * FROM product_group WHERE product_group = '{$product_group}'";
		$query_id_product = ConnectBD::getConnect()->query($str);			
		$dp = $query_id_product->fetch_object();		
		$str_koef_2 = "SELECT koef, discount, total_add_discount				      
					   FROM koef
					   WHERE entity_code = {$entity_code}
					   AND id_product = {$dp->id_product}";					 
		$select_koef_2 = ConnectBD::getConnect()->query($str_koef_2);
		$obj_koef_2 = $select_koef_2->fetch_object();
		
	    return $obj_koef_2;	 
	}
		
	protected function getOldkoef()
	{				
		if (!empty($_GET['customer'])) 
         $entity_code = $_GET['customer'];
	    if (!empty($_GET['koef'])) 
		  $entity_code = $_GET['koef'];
		if (!empty($_GET['product'])) 
		  $product_group = $_GET['product']; 
	 
	    $str = "SELECT * FROM product_group WHERE product_group = '{$product_group}'";
		$query_id_product = ConnectBD::getConnect()->query($str);			
		$dp = $query_id_product->fetch_object();
		
		$str_koef = "SELECT base_discount, add_discount_1,
							add_discount_2, add_discount_3,
							add_discount_4
					 FROM card
					 WHERE entity_code = {$entity_code}
					 AND id_product = {$dp->id_product}";					 					 
		$select_koef = ConnectBD::getConnect()->query($str_koef);
		$old_koef = $select_koef->fetch_object();
        
	    return $old_koef;	 
	}	    		
}

      
