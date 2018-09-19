<?php
require_once 'models/TarifpoiskModel.php';

class TarifpoiskController
{
    public function actionTarifpoisk()
	{ 				
        if (!empty($_REQUEST['brandid']) OR !empty($_REQUEST['reference']) OR !empty($_REQUEST['family']) OR !empty($_REQUEST['fullref']) OR !empty($_REQUEST['productgroup'])) {			
		    $tarifPoiskList = TarifpoiskModel::getPoiskProduct();
		    $paningacia_tarif_poisk = TarifpoiskModel::getPaningaciaTarifPoisk();		  		  	  
		} else {
		    exit('error:в поле не введены данные');
		}
							
		include 'view/controllerview/TarifpoiskView.php';
		return true;
	}		
}


