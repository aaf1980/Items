<?php
require_once 'models/TotalfactorsModel.php';

class TotalfactorsController
{
    public function actionTotalfactors()
    {	
        $obj = TotalfactorsModel::getParamsReferens();
	    $totalkoef = TotalfactorsModel::getKoefReferens(); 
        include 'view/controllerview/TotalfactorsView.php';									
	    return true;
    }	  
}