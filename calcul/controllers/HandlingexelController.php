<?php
require_once 'PhpExcel/Classes/PHPExcel.php';
require_once 'models/ConnectBD.php';

class HandlingexelController
{
    public function actionHandlingexel()
	{	

	    $link = ConnectBD::getConnect();
	
	    if (!empty($_GET['customer'])) {
			$entity_code = $_GET['customer'];
		} else {
			exit('данные не введены!\n');
		}
	
	    if (!empty($_POST['name_exel'])) { 
	      $from_cardview = $_POST['name_exel'];
		  $path_exel = "$from_cardview";
		} else {
			exit('данные не введены!\n');
		}
									
		$excel = PHPExcel_IOFactory::load($path_exel);
        //Далее формируем массив из всех листов Excel файла с помощью цикла
		foreach ($excel ->getWorksheetIterator() as $worksheet) {
		 		 
		    $highestRow = $worksheet->getHighestRow(); // получаем количество строк
		    $highestColumn = $worksheet->getHighestColumn(); // а так можно получить количество колонок
		 
		    for ($row = 1; $row <= $highestRow; ++ $row) {  // обходим все строки
		  
			    $cell1 = $worksheet->getCellByColumnAndRow(0, $row); //reference
			    $cell2 = $worksheet->getCellByColumnAndRow(1, $row); //количество
										
			    $sql = "INSERT INTO orderexel (Reference,Quantity,entity_code) VALUES('$cell1', $cell2, $entity_code)";
			    mysqli_query($link, $sql);										
		    }
		}
		unset($worksheet);
		
		//удаление файла Excel и таблицы exeldouwnload
		$del = "DELETE FROM exeldouwnload WHERE entity_code = {$entity_code}";
	    mysqli_query($link, $del);
		
		unlink($path_exel);
		//конец удалния файлов Excel		
		echo '<script>document.location.href = "?uri=cardview&customer='.$entity_code.'";</script>';	
	    return true;
	}			  
}