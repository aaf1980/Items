<?php
require_once 'models/ConnectBD.php';

class ProductcardModel extends ConnectBD
{	   		
	public static function getProductcardList()
	{	
        $link = ConnectBD::getConnect();
		
		if (!empty($_GET['productreference'])) 
         $Reference = trim($_GET['productreference']);
				
        $str = "SELECT a.BrandId, a.Reference, a.FullRef, a.ItemName					   					   
		        FROM PL_Items AS a 
				WHERE a.Reference = '$Reference'";
		
		$result = mysqli_query($link, $str);						
	    $productList = mysqli_fetch_object($result);			
					
		return $productList;				
	}	
	
	public static function getPriceGroup()
	{	
        $link = ConnectBD::getConnect();
		
		if (!empty($_GET['productreference'])) 
         $Reference = trim($_GET['productreference']);
		
		$str = "SELECT b.ParamValCode					   
		        FROM  PL_ItemParamsVals AS b 
				WHERE b.Reference = '$Reference'
				AND b.ParamNO = 'PriceGroup'";
				
		$result = mysqli_query($link, $str);						
	    $priceGroup = mysqli_fetch_object($result);			
					
		return $priceGroup;				
	}

	public static function getProductKoef()
	{	
        $link = ConnectBD::getConnect();
		
		if (!empty($_GET['productreference'])) 
         $Reference = trim($_GET['productreference']);
		
		$str = "SELECT a.KM, a.PriRub, a.PriEur,
		               b.pri_unit_rub, b.pdb  		
		        FROM  productcard AS a, productkoef AS b
				WHERE a.Reference = '$Reference'
				AND a.Reference = b.Reference";
				
		$result = mysqli_query($link, $str);						
	    $productKoef = mysqli_fetch_object($result);			
					
		return $productKoef;				
	}	
	
	public static function getCurrency() 
	{		
		$link = ConnectBD::getConnect();
		
		$str = "SELECT * FROM currency";		
		$result = mysqli_query($link, $str);		
		$currencyList = array();
		
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$currencyList[] = mysqli_fetch_array($result);			
		}	
		
		return $currencyList;		
	}		
}

      
