<?php
require_once 'models/ConnectBD.php';

class DelkoefController
{
    public function actionDelkoef()
    {	
    
	    $link = ConnectBD::getConnect();
	
	    if(!empty($_GET['delkoef'])) {	
	       $entity_code = $_GET['delkoef'];	  
           $koef_del = "DELETE FROM cardrezult WHERE entity_code = {$entity_code}";
	       mysqli_query($link, $koef_del); 
	    } 
		
	    echo "<script>document.location.href =\"?uri=cardview&customer=$entity_code\";</script>";							
	    return true;	
    }	
}