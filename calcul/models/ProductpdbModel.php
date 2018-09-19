<?php
require_once 'models/ConnectBD.php';

class TarifModel extends ConnectBD
{	   		
	public static function getTarifList()
	{	
        $link = ConnectBD::getConnect();
				
		if (isset($_GET['Pos'])) {
		  $Pos = $_GET['Pos'];	
		} else {
		 $Pos = 0; 
		}
				
        $str = "SELECT a.BrandId, a.Reference, a.FullRef,
					   a.ItemName, a.Family,
					   b.FamilyNo, b.FamilyName,
					   c.Tarif, z.ParamValCode,
					   l.pri_unit_rub, l.pdb
		        FROM PL_Items AS a, PL_ItemFamily AS b, 
				     SF_Tarif AS c, PL_ItemParamsVals AS z,
					 productkoef AS l
				WHERE a.Family = b.FamilyNo 
                AND a.Reference = c.ItemNO
				AND a.Reference = z.Reference
				AND a.Reference = l.Reference
				AND z.ParamNO = 'PriceGroup'
                AND c.Closed = 0 				
                ORDER BY c.PriceDate DESC 			
				LIMIT $Pos, 20";
		
		$result = mysqli_query($link, $str);
		
		$tarifList = array();
		
		for ($i = 0; $i < mysqli_num_rows($result); $i++ ) {
			$tarifList[] = mysqli_fetch_array($result);			
		}	
		
		return $tarifList;
	}
		
	public static function getPaningaciaTarif()
	{	
        $link = ConnectBD::getConnect();
        		
		$str = "SELECT COUNT(*)
		        FROM PL_Items AS a, SF_Tarif AS c, 
				     PL_ItemParamsVals AS z, productkoef AS l  
				WHERE a.Reference = c.ItemNO
				AND a.Reference = z.Reference
				AND a.Reference = l.Reference
				AND z.ParamNO = 'PriceGroup'
                AND c.Closed = 0 				
                ORDER BY c.PriceDate DESC";
		
		$paningacia_tarif = mysqli_query($link, $str);	
		
		return $paningacia_tarif;
	}    
}

   
