<?php
require_once 'models/ProductpdbModel.php';

class ProductpdbController
{
	public function actionProductpdb()
	{		    
	    $tarifList = TarifModel::getTarifList();
	    $paningacia_tarif = TarifModel::getPaningaciaTarif();		
	    include 'view/controllerview/ProductpdbView.php';								
	    return true;
	}    
}