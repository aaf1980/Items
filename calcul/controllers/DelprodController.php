<?php
require_once 'models/ConnectBD.php';

class DelprodController
{
    public function actionDelprod()
    {	
    
        $link = ConnectBD::getConnect();
	
	    if (!empty($_GET['customer']) AND !empty($_GET['reference'])) {
	        $entity_code = $_GET['customer'];
	        $reference = $_GET['reference'];
	    } else {
		    exit('Нет данных');
	    }	
	
        $koef_del = "DELETE FROM orderexel WHERE entity_code = $entity_code AND Reference = '$reference' ";
	    mysqli_query($link, $koef_del);
	
	    $koef_del_2 = "DELETE FROM cardrezult WHERE entity_code = {$entity_code} ";
	    mysqli_query($link, $koef_del_2);
		
	   echo '<script>document.location.href = "?uri=cardview&customer='.$entity_code.'";</script>';							
	   return true;	
  }	
}