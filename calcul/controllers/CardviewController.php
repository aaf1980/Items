<?php
require_once 'models/CardviewModel.php';

class CardviewController
{
	public function actionCardview()
	{	
	    if (!empty($_GET['customer'])) {
          $entity_code = $_GET['customer'];
        } else {
			exit('нет данных');
		}		  
	    $obj      = CardviewModel::CustomerInformation($entity_code);		 
		$getExel  = CardviewModel::getExel($entity_code);		 
		$koefList = CardviewModel::getKoefList($entity_code);
		$tabList  = CardviewModel::getTabList($entity_code);
		$notKoef  = CardviewModel::getNotKoef($entity_code);				 		 
		include 'view/controllerview/CardviewView.php';									
		return true;
	}	
}


