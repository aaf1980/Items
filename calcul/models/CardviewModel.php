<?php   
class CardviewModel 
{	
    public static function CustomerInformation($entity_code)
	{	    		 		
		$result = ConnectBD::getConnect()->query("SELECT name,type,sort_my,entity_code FROM customer WHERE entity_code = '{$entity_code}'");
		$obj =$result->fetch_object();	 
		return $obj;
    }
	//=======================================================
	public static function getExel($entity_code)
	{	     		 				 
		$result = ConnectBD::getConnect()->query("SELECT path, name_file FROM exeldouwnload WHERE entity_code = '{$entity_code}'");		
		$row = array();			 
		for ($i = 0; $i < $result->num_rows; $i++) {
			  $row[] = $result->fetch_array(MYSQLI_ASSOC);		         
		}
	  return $row;	
	}
	//==================================================================
	public static function getKoefList($entity_code)
	{		 				
	    $str = "SELECT a.product_group, a.id_product, 
					   h.base_discount, h.add_discount_1,
					   h.add_discount_2, h.add_discount_3,
					   h.add_discount_4,
					   z.koef, z.discount,
					   z.total_add_discount   			   
			    FROM product_group AS a, card AS h, koef AS z 
			    WHERE a.id_product = h.id_product        		
				AND h.entity_code = {$entity_code}
				AND a.id_product = z.id_product
				AND z.entity_code = {$entity_code}";
	
		$result = ConnectBD::getConnect()->query($str);
		$row = array();	 
		for ($i = 0; $i < $result->num_rows; $i++) {
			 $row[] = $result->fetch_array(MYSQLI_ASSOC);		         
		}	  	 
	     return $row;		
	}
    //=================================================================			   
	public static function getTabList($entity_code)
	{	       		        						
        $str = "SELECT a.BrandId, a.Reference, a.FullRef,
					   a.ItemName, a.Family,
					   b.FamilyNo, b.FamilyName,
					   c.Tarif, z.ParamValCode,
					   l.pri_unit_rub, l.pdb
		        FROM PL_Items AS a, PL_ItemFamily AS b, 
				     SF_Tarif AS c, PL_ItemParamsVals AS z,
					 orderexel AS v, productkoef AS l
				WHERE a.Family = b.FamilyNo 
                AND a.Reference = c.ItemNO
				AND a.Reference = v.Reference 
				AND a.Reference = l.Reference				
				AND v.entity_code = {$entity_code}
				AND a.Reference = z.Reference
				AND z.ParamNO = 'PriceGroup'
                AND c.Closed = 0 				
                ORDER BY c.PriceDate DESC";		
		$result = ConnectBD::getConnect()->query($str);				
		$tabList = array();		
		for ($i = 0; $i < $result->num_rows; $i++ ) {
			$tabList[] = $result->fetch_array(MYSQLI_ASSOC);			
		}							
		return $tabList;
	}
	//===============================================================
	public static function getNotKoef($entity_code)
	{	        		        		
		$select = "SELECT h.Reference
		           FROM   orderexel AS h
			       WHERE  	
				   h.Reference NOT IN (SELECT k.Reference FROM productkoef AS k, orderexel AS v WHERE k.Reference != v.Reference )
				   AND h.entity_code = {$entity_code}";	
				   
	    $result = ConnectBD::getConnect()->query($select);								
		$res = array();
		$row = array();
		while ($row = $result->fetch_assoc()) {
		  $res[] = $row['Reference'];
		}									
		return $res;						
	}		
}
