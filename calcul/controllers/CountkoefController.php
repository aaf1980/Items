<?php
require_once 'models/CountkoefModel.php';

class CountkoefController extends CountkoefModel
{
	public function actionCountkoef()
	{	
        $obj = $this->CustomerInformation();	
		$obj_koef_2 = $this->getCountkoefList();		
		$old_koef = $this->getOldkoef();								
		include 'view/controllerview/CountkoefView.php';								
		return true;				
	}	
}