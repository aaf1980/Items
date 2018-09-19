<?php
require_once 'models/ConnectBD.php';

class CurrencyController
{
    public function actionCurrency()
    {	
        $link = ConnectBD::getConnect();
		
	    $rub_eur = $_POST['eur'];
	    $rub_usd = $_POST['usd'];	
	
        $str = "SELECT id_currency FROM currency ";
	    $query = mysqli_query($link, $str);	
	    $row = array();
	    $row = mysqli_fetch_array($query);
	
	    if (!empty($row['id_currency'])) {	
	        $update = "UPDATE currency SET RUB_EUR = '{$rub_eur}', RUB_USD = '{$rub_usd}'";	
	        mysqli_query($link, $update);		    	  
	    } else {
	        $insert = "INSERT INTO currency (RUB_EUR, RUB_USD) VALUES ($rub_eur, $rub_usd)";
	        mysqli_query($link, $insert);	  
	    }
		
    echo '<script>document.location.href = "?uri=tarif";</script>';	
    } 
}