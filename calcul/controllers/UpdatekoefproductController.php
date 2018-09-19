<?php
require_once 'models/ConnectBD.php';

class UpdatekoefproductController
{
    public function actionUpdatekoefproduct()
    {	
        $link = ConnectBD::getConnect();
    
        $str = "SELECT * FROM currency";		
	    $result = mysqli_query($link, $str);				
        $currency_obj = mysqli_fetch_object($result);
	
	    //переменные для вставки	
	    $reference = $_POST['reference'];
		
	    $km = $_POST['score1'];  

	    if (!empty($_POST['score4']) and empty($_POST['score5'])) {
            $pri_rub = $_POST['score4'];	
            $pri_eur = 0;
	    } elseif (!empty($_POST['score5']) and empty($_POST['score4'])) {
	        $pri_eur = $_POST['score5'];	
            $pri_rub = 0;
	    } elseif(!empty($_POST['score5']) and !empty($_POST['score4'])) {
		    $pri_eur = $_POST['score5'];
		    $pri_rub = $_POST['score4'];
	    }		
	
	    if (isset($_POST['score2']) AND !isset($_POST['score3'])) {
		    $rub_eur = $_POST['score2'];
	        $rub_usd = 0;
	    } elseif(!isset($_POST['score2']) AND isset($_POST['score3'])) {
		    $rub_eur = 0;
	        $rub_usd = $_POST['score3'];
	    }
			
//вставки и обновления таблиц productcard и productkoef
	
	    $str = "SELECT id_prod FROM productcard WHERE Reference ='$reference'";
	    $query_reference = mysqli_query($link, $str);	
	    $row = array();
	    $row = mysqli_fetch_array($query_reference);
	
	    if (!empty($row['id_prod'])) {
		
	        $update_productcard = "UPDATE productcard SET 
						           KM = '{$km}',
						           PriRub = '{$pri_rub}',
						           PriEur = '{$pri_eur}',
						           Rub_Eur = '{$rub_eur}',	
							       Rub_Usd = '{$rub_usd}'
						           WHERE Reference = '$reference'";	
	    mysqli_query($link, $update_productcard);		  
	  	  
	    } else {
	        $insert_productcard = "INSERT INTO productcard (Reference, KM, PriRub, PriEur, Rub_Eur, Rub_Usd) VALUES ('$reference', $km, $pri_rub, $pri_eur, $rub_eur, $rub_usd)";	    
	        mysqli_query($link, $insert_productcard);	  
	    }	
	
//заполнение таблицы productkoef
	
	    $currency = '';
	
	    if (isset($_POST['score2']) AND !isset($_POST['score3'])) {
		    $currency .= $_POST['score2'];
	    } elseif(!isset($_POST['score2']) AND isset($_POST['score3'])) {		
	        $currency .= $_POST['score3'];
	    }
	
	    //формулы
	    $pri_unit_rub = ($pri_rub+$pri_eur)+5*$currency;
	    $pdb = $pri_unit_rub*$km;
	
	    $str = "SELECT id_prkoef FROM productkoef WHERE Reference ='$reference'";
	    $query_reference = mysqli_query($link, $str);	
	    $row = array();
	    $row = mysqli_fetch_array($query_reference);
	
	    if (!empty($row['id_prkoef'])) {
		
	        $update_productkoef = "UPDATE productkoef SET 
						           pri_unit_rub= '{$pri_unit_rub}',
						           pdb = '{$pdb}'						     						     
						           WHERE Reference = '$reference'";	
	        mysqli_query($link, $update_productkoef);		  
	 	  
	    } else {	
	
	        $insert_productkoef = "INSERT INTO productkoef (Reference, pri_unit_rub, pdb) VALUES ('$reference', $pri_unit_rub, $pdb)";
	        mysqli_query($link, $insert_productkoef);	    
	    }
		
        echo '<script>document.location.href = "?uri=productcard&productreference='.$reference.'";</script>';	
    }	
}