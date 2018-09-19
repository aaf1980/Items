<?php
require_once 'models/ConnectBD.php';

class DouwnloadController
{
	public function actionDouwnload()
	{	
       
	    $link = ConnectBD::getConnect();
	
	    if (!empty($_GET['customer'])) {
			$entity_code = $_GET['customer'];
		} else {
			exit('данные не введены!\n');
		}
	    
		date_default_timezone_set('UTC');
		$addName= date("Y-m-d:his");
		$uploadfile = '/var/www/html/calcul/files/';
		$filename = $_FILES['userfile']['name'];		
		$new_name = $addName.'_entity_'.$entity_code.'.xlsx';
        $path = '/var/www/html/calcul/files/'.$new_name.''; 		
		$filename = $new_name; 

		if (!empty($entity_code) AND !empty($new_name)) {	
		   $insert_exel = "INSERT INTO exeldouwnload (path, entity_code, name_file) VALUES ('$path', $entity_code, '$new_name')";
		   mysqli_query($link, $insert_exel);	
		   
		} else {
			exit('данные не введены!\n');
		}
	
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile.$filename)) {		
			echo '<script>document.location.href = "?uri=cardview&customer='.$entity_code.'";</script>';		
		} else {		
			exit('Загрузка не прошла!\n');
		}		
						
	    return true;
	}    
}