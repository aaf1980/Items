<?php
require_once 'models/ConnectBD.php';

class TotalfactorsModel extends ConnectBD
{	   		
	public static function getParamsReferens()
	{	
        $link = ConnectBD::getConnect();
		
		if (!empty($_GET['customer']) AND !empty($_GET['product']) AND !empty($_GET['reference'])) {
          $entity_code = $_GET['customer'];
		  $product_group = $_GET['product'];
		  $reference = $_GET['reference'];
		} else {
			 exit('нет данных'); 
		}
		
	    $str = "SELECT a.Reference, v.Quantity,
					   c.Tarif, z.ParamValCode,
					   l.pri_unit_rub, l.pdb,
					   z.ParamValCode
		        FROM PL_Items AS a, 
				     SF_Tarif AS c, PL_ItemParamsVals AS z,
					 orderexel AS v, productkoef AS l
				WHERE  a.Reference = c.ItemNO
				   AND a.Reference = v.Reference 
				   AND a.Reference = l.Reference				
				   AND v.entity_code = $entity_code
				   AND v.Reference = '$reference'
				   AND a.Reference = z.Reference
				   AND z.ParamValCode = '$product_group'
                   AND c.Closed = 0 				
                ORDER BY c.PriceDate DESC";
		
		$result = mysqli_query($link, $str);						 		
		$obj = mysqli_fetch_object($result);
		
		return $obj;
	}  
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public static function getKoefReferens()
	{	
        $link = ConnectBD::getConnect();
		
		if (!empty($_GET['customer']) AND !empty($_GET['product']) AND !empty($_GET['reference'])) {
          $entity_code = $_GET['customer'];
		  $product_group = $_GET['product'];
		  $reference = $_GET['reference'];
		} else {
			 exit('нет данных'); 
		}
		
		$str_2 = "SELECT z.total_add_discount   			   
			      FROM product_group AS a, card AS h, koef AS z 
			      WHERE a.id_product = h.id_product        		
				  AND h.entity_code = {$entity_code}
				  AND a.id_product = z.id_product
				  AND z.entity_code = {$entity_code}
				  AND a.product_group = '$product_group' ";
				
		$result_2 = mysqli_query($link, $str_2);				
		$totalkoef = mysqli_fetch_object($result_2);
		
		return $totalkoef;		
	}	
}

   
