<?php
class PgroupModel 
{	   		
	public function getPgroupList()
	{	       					      		
		$result = ConnectBD::getConnect()->query('SELECT id_product,product_group FROM product_group');
		$row = array();
		$pgroupList = array();
		$rowCnt = $result->num_rows;
		for ($i = 0; $i < $rowCnt; $i++ ) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$pgroupList[$i]['id_product'] = $row['id_product'];
			$pgroupList[$i]['product_group'] = $row['product_group'];			
		}
        $result->free();
	    ConnectBD::getConnect()->close();		
		return $pgroupList;
	}

	public function getIdProduct()
	{	    		
	    if (!empty($_GET['customer'])) {
            $entity_code = $_GET['customer'];
        } else {
			exit('нет данных');
		}				  
	    $select_card = "SELECT id_product FROM card WHERE entity_code = {$entity_code}";			 
	    $result = ConnectBD::getConnect()->query($select_card);			
		$res = array();
		$row = array();		
		while ($row = $result->fetch_assoc()) {
		    $res[] = $row['id_product'];
		}			
		return $res;		
	}

    public function CustomerInformation()
	{	   		
		if (!empty($_GET['customer'])) {
            $entity_code = $_GET['customer'];
        } else {
			exit('нет данных');
		}	
		$queri = "SELECT name,type,sort_my,entity_code 
		          FROM customer 
				  WHERE entity_code = '{$entity_code}'"; 
		$result = ConnectBD::getConnect()->query($queri);
		$obj = $result->fetch_object();        		
		return $obj;
    }	
}

      
