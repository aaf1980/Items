<?php
class TarifModel 
{	 
  	public $position;
		
	function __construct($position)
	{
		$this->position = $position;		
	}
	
	public function rowCnt()
	{
		$str = "SELECT  a.Reference					                       				   
		        FROM PL_Items AS a              			
				ORDER BY a.Reference											               			
				LIMIT {$this->position}, 20";
				
		$result =ConnectBD::getConnect()->query($str);
		$rowCnt = $result->num_rows;
		return $rowCnt;
	}
		
	public function getTarifList()
	{	        						  	
        $str = "SELECT a.BrandId, a.Reference, a.ItemName, 
					   a.Family, a.FullRef,  b.FamilyName                     				   
		        FROM PL_Items AS a
				LEFT JOIN  PL_ItemFamily AS b
                ON a.Family = b.FamilyNo			
				ORDER BY a.Reference											               			
				LIMIT {$this->position}, 20";
				
		$result = ConnectBD::getConnect()->query($str);		
		$tarifList = array();      	
		for ($i = 0; $i < $result->num_rows; $i++ ) {		
			$tarifList[] = $result->fetch_array(MYSQLI_ASSOC); 			
		}			
		return $tarifList;
	}
			
		 
    public function getCurrency() 
	{						
		$str = "SELECT * FROM currency";			
		$result = ConnectBD::getConnect()->query($str);		
		$currencyList = array();
		for ($i = 0; $i < $result->num_rows; $i++) {
			$currencyList[] = $result->fetch_array(MYSQLI_ASSOC);			
		}			
		return $currencyList;		
	}	

	public static function getPaningaciaTarif()
	{	       	
		$str = "SELECT COUNT(a.Reference) AS CNT FROM PL_Items AS a ORDER BY a.Reference";		
		$paningacia_tarif =ConnectBD::getConnect()->query($str);			
		return $paningacia_tarif;
	} 
}

class PriceGroup 
{
	public $getReference;
	
	public function getReference()
	{
		$reference = "SELECT Reference FROM PL_Items ORDER BY Reference";
		$resultGetReference = ConnectBD::getConnect()->query($reference);
		$row = array();
	    $row = $resultGetReference->fetch_array(MYSQLI_ASSOC);		 	
		$this->getReference = $row['Reference'];
		//$val = '001190';
		return $this->getReference;
	}
			
	public function getPriceGroup()
	{
		
		$reference = "SELECT Reference FROM PL_Items ORDER BY Reference";
		$resultGetReference = ConnectBD::getConnect()->query($reference);
		$row = array();
	    $row = $resultGetReference->fetch_array(MYSQLI_ASSOC);		 	
			
		$queri = "SELECT z.ParamValCode FROM  PL_ItemParamsVals AS z WHERE z.Reference = '{$row['Reference']}' AND z.ParamNO = 'PriceGroup'";	  
		$result = ConnectBD::getConnect()->query($queri);
		$priceGroup = array();					    
		$priceGroup = $result->fetch_array(MYSQLI_ASSOC);					
		return $priceGroup['ParamValCode']; 
	}
}
   
