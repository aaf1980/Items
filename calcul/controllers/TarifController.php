<?php
require_once 'models/TarifModel.php';

class TarifController 
{
	public function actionTarif()
	{ 	
        if (isset($_GET['Pos'])) {
		  $Pos = $_GET['Pos'];	
		} else {
		 $Pos = 0; 
		}
				
        $obj = new TarifModel($Pos);	       				
		$currency = $obj->getCurrency();		
		$rowCnt = $obj->rowCnt();	
		$dp =  $obj->getTarifList();
		
        $obj2 = new PriceGroup();
		$priceGroup = $obj2->getPriceGroup();
		print_r($priceGroup);
		//$paningacia_tarif = TarifModel::getPaningaciaTarif();	       		
		//include 'view/controllerview/TarifView.php';		  															
	    return true;              		 						
	}	
}


