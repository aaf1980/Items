<?php
require_once 'models/ConnectBD.php';

class TarifpoiskModel extends ConnectBD
{	   					
	public static function getPoiskProduct()
	{
		$link = ConnectBD::getConnect();
		
		if (isset($_GET['Pos'])) {
		  $Pos = $_GET['Pos'];	
		} else {
		 $Pos = 0; 
		}
		
		$BrandId = "";
		$Family = "";
		$Reference = "";
		$FullRef = "";
		$ProductGroup = "";
		
		if (!empty($_REQUEST['brandid']) and empty($BrandId)) {
		 $BrandId = $_REQUEST['brandid'];
		} elseif (!empty($_REQUEST['family']) and empty($Family)) {
		 $Family = $_REQUEST['family'];
		} elseif (!empty($_REQUEST['reference']) and empty($Reference)) {
		 $Reference = $_REQUEST['reference'];	
		} elseif (!empty($_REQUEST['fullref']) and empty($FullRef)) {
		 $FullRef = $_REQUEST['fullref'];	
		} elseif (!empty($_REQUEST['productgroup']) and empty($ProductGroup)) {
		 $ProductGroup = $_REQUEST['productgroup'];	
		}			
						
		$WHS = '';		
		
		if (!empty($BrandId)) {
			$WHS .= "a.BrandId = '$BrandId'";					
		} elseif (!empty($Family)) {
			$WHS .= "a.Family = '$Family'";
		} elseif (!empty($Reference)) {
			$WHS .= "a.Reference = '$Reference'";
		} elseif(!empty($FullRef)) {
			$WHS .= "a.FullRef = '$FullRef'";
		} elseif(!empty($ProductGroup)) {
			$WHS .= "z.ParamValCode = '$ProductGroup'";
		}
				
		$str = "SELECT a.BrandId, a.Reference,
					   a.ItemName, a.FullRef,
					   a.Family, b.FamilyName,
					   c.Tarif, z.ParamValCode
		        FROM PL_Items AS a, PL_ItemFamily AS b, SF_Tarif AS c, PL_ItemParamsVals AS z				     
				WHERE $WHS   
				AND a.Family = b.FamilyNo
				AND a.Reference = c.ItemNO
				AND a.Reference = z.Reference
				AND z.ParamNO = 'PriceGroup'
                AND c.Closed = 0 				                
				LIMIT $Pos, 20";
		
		$result = mysqli_query($link, $str);
		
		$tarifPoiskList = array();
		
		for ($i = 0; $i < mysqli_num_rows($result); $i++ ) {
			$tarifPoiskList[] = mysqli_fetch_array($result);	            			
		}
		
		return $tarifPoiskList;
	}
		
	public static function getPaningaciaTarifPoisk()
	{	
        $link = ConnectBD::getConnect();
						
		$BrandId = "";
		$Family = "";
		$Reference = "";
		$FullRef = "";
		$ProductGroup = "";
		
		if (!empty($_REQUEST['brandid']) and empty($BrandId)) {
		 $BrandId = $_REQUEST['brandid'];
		} elseif (!empty($_REQUEST['family']) and empty($Family)) {
		 $Family = $_REQUEST['family'];
		} elseif (!empty($_REQUEST['reference']) and empty($Reference)) {
		 $Reference = $_REQUEST['reference'];	
		} elseif (!empty($_REQUEST['fullref']) and empty($FullRef)) {
		 $FullRef = $_REQUEST['fullref'];	
		} elseif (!empty($_REQUEST['productgroup']) and empty($ProductGroup)) {
		 $ProductGroup = $_REQUEST['productgroup'];	
		}	
		
		$WHS = '';		
		
		if (!empty($BrandId)) {
			$WHS .= "a.BrandId = '$BrandId'";					
		} elseif (!empty($Family)) {
			$WHS .= "a.Family = '$Family'";
		} elseif (!empty($Reference)) {
			$WHS .= "a.Reference = '$Reference'";
		} elseif(!empty($FullRef)) {
			$WHS .= "a.FullRef = '$FullRef'";
		} elseif(!empty($ProductGroup)) {
			$WHS .= "z.ParamValCode = '$ProductGroup'";
		}
		
		$str = "SELECT COUNT(*)
		        FROM PL_Items AS a, PL_ItemFamily AS b, SF_Tarif AS c, PL_ItemParamsVals AS z				     
				WHERE $WHS 
				AND a.Family = b.FamilyNo
				AND a.Reference = c.ItemNO
				AND a.Reference = z.Reference
				AND z.ParamNO = 'PriceGroup'
                AND c.Closed = 0";
						
		$paningacia_tarif_poisk = mysqli_query($link, $str);
		
		return $paningacia_tarif_poisk;
	}		
}

   
