<?php
require_once 'models/ConnectBD.php';

class UpdatekoefController
{
    public function actionUpdatekoef()
    {	
       $link = ConnectBD::getConnect();
    	
        if (!empty($_POST['entity_code']) AND !empty($_POST['product_group'])) {
		
	        $entity_code = $_POST['entity_code'];
	        //$product_group = array();
	        $product_group = $_POST['product_group'];
    
	        //$product_group = mb_convert_encoding($product_group, "ASCII", "UTF-8");	
	        //echo mb_detect_encoding($product_group);echo '|';
	        //var_dump($product_group); echo '|';
	    } else {
		    exit('ошибка:нет данных');
	    }	
	
	    $base_discount  = ($_POST['score1'])/100;	  
	    $add_discount_1 = ($_POST['score2'])/100;	  
	    $add_discount_2 = ($_POST['score3'])/100;
	    $add_discount_3 = ($_POST['score4'])/100;
	    $add_discount_4 = ($_POST['score5'])/100;
					
	    //вставки и обновления таблиц card и koef
	    $str = "SELECT id_product FROM product_group WHERE product_group = '$product_group'";
	
	    $query_id_product = mysqli_query($link, $str);
	
	    $row = mysqli_fetch_array($query_id_product);
	
	    //var_dump($row['id_product']);		  
	    $update_card_coef = "UPDATE card SET 
						     base_discount = '{$base_discount}',
						     add_discount_1 = '{$add_discount_1}',
						     add_discount_2 = '{$add_discount_2}',
						     add_discount_3 = '{$add_discount_3}',
						     add_discount_4 = '{$add_discount_4}'
						     WHERE 
						     entity_code = '{$entity_code}' 
						     AND id_product = '{$row['id_product']}'";					 										 

	    //переменные из формул	
	    $koef = ((1-$base_discount)*(1-$add_discount_1)*(1-$add_discount_2)*(1-$add_discount_3)*(1-$add_discount_4));
	    $discount = (1-$koef);
	    $total_discount = 1-((1-$add_discount_1)*(1-$add_discount_2)*(1-$add_discount_3)*(1-$add_discount_4));
	    //конец формул коефициентов
		
	    $str_2 = "SELECT id_product FROM product_group WHERE product_group = '{$product_group}'";
	    $query_id_product_2 = mysqli_query($link, $str_2);
	    $row_2 = mysqli_fetch_array($query_id_product_2);
		
	    $update_koef = "UPDATE koef SET 
					    koef = '{$koef}',
					    discount = '{$discount}',
					    total_add_discount = '{$total_discount}'
					    WHERE 
					    entity_code = '{$entity_code}' 
					    AND id_product = '{$row_2['id_product']}'";

	    if (mysqli_query($link, $update_card_coef) AND mysqli_query($link, $update_koef)) {
		    echo '<script>document.location.href = "?uri=cardview&customer='.$entity_code.'";</script>';
	    } else {
		    echo 'вставка не прошла';
	    }			
												 	
	return true;				
    }	
}