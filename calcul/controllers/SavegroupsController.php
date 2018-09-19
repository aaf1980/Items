<?php
require_once 'models/SavegroupsModel.php';

class SavegroupsController 
{
    public function actionSavegroups()
    {	  
	    if (!empty($_POST['entity_code']) AND !empty($_POST['id_product'])) {	
			$entity_code = $_POST['entity_code'];
			$id_product = $_POST['id_product'];
		} else {
			exit('ошибка:нет данных');
		}	
        $obj = new SavegroupsModel();
		$obj->saveGroups($entity_code, $id_product);
	    print '<script>document.location.href = "?uri=cardview&customer='.$entity_code.'";</script>';							
	    return true;			
    }	
}