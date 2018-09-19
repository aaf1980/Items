<?php
class CustomerModel 
{	   	   						
	public function getCustomerList()
	{	       		
		if (isset($_GET['BegPos'])) {
			$BegPos = $_GET['BegPos'];	
		} else {
			$BegPos = 0; 
		}		       		
		$result = ConnectBD::getConnect()->query("SELECT * FROM customer LIMIT $BegPos, 20");		
		$row = array();	
		$customerList = array();
        $rowCnt = $result->num_rows;	
		for ($i = 0; $i < $rowCnt; $i++ ) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$customerList[$i]['name'] = $row['name'];
			$customerList[$i]['english name'] = $row['english name'];
			$customerList[$i]['type'] = $row['type'];
			$customerList[$i]['sort_my'] = $row['sort_my'];
            $customerList[$i]['entity_code'] = $row['entity_code'];			
		}		
		return $customerList;
	}
		
	public function getPoiskCustomer()
	{	     		
        $entity = $_POST['entity'];
		$customer = $_POST['customer'];
        $type = $_POST['type'];						
		$WHS = '';
				
        if (!empty($entity)) {
			$WHS .= "entity_code = $entity";
		} elseif (!empty($customer)){		 
			$WHS .= "name LIKE '%$customer%'";
		} elseif (!empty($type)) {
			$WHS .= "type LIKE '%$type%'";
		}					      		
		$result = ConnectBD::getConnect()->query("SELECT * FROM customer WHERE $WHS");
		$row = array();
		for ($i = 0; $i < $result->num_rows; $i++ ) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$customerList[$i]['name'] = $row['name'];
			$customerList[$i]['english name'] = $row['english name'];
			$customerList[$i]['type'] = $row['type'];
			$customerList[$i]['sort_my'] = $row['sort_my'];
            $customerList[$i]['entity_code'] = $row['entity_code'];
		}		
		return $customerList;
	}
			
	public function getPaningaciaCustomer()
	{	      	
		$paningacia = ConnectBD::getConnect()->query("SELECT COUNT(1) FROM customer");		
		return $paningacia;
	}	
}

      
