<?php
require_once 'models/ProductcardModel.php';

class ProductcardController
{
	public function actionProductcard()
	{	       			
		$productList = ProductcardModel::getProductcardList();
		$priceGroup = ProductcardModel::getPriceGroup();
		$productKoef = ProductcardModel::getProductKoef();
		$currency = ProductcardModel::getCurrency();
		
		include 'view/controllerview/ProductcardView.php';								
		return true;
	}    
}