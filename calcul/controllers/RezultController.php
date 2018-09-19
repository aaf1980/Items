<?php
require_once 'models/ConnectBD.php';

class RezultController
{
    public function actionRezult()
    {	
        $link = ConnectBD::getConnect();
    	
	    //переменные для вставки	
	    $reference = $_POST['reference'];
	    $tarif = $_POST['tarif'];      
        $price_group = $_POST['price_group'];	
        $pdb = $_POST['pdb'];	
	    $entity_code = $_POST['entity_code'];
	
	    //var_dump($price_group);
	
	    echo '<br>';
		
	    //echo '<div style="height:120px;">entity_code: '.$entity_code.'<br></div>';
	
	    echo '<div style="posihion:relative; margin-left:170px;">
	          <div style="color:red;">Entity Code: '.$entity_code.'<br><br></div>';
	
	    for ($i = 0; $i < count($reference); $i++) {
			
		    $str = "SELECT a.Reference, v.Quantity,
					   c.Tarif, z.ParamValCode,
					   l.pri_unit_rub, l.pdb
		            FROM PL_Items AS a, 
				       SF_Tarif AS c, PL_ItemParamsVals AS z,
					   orderexel AS v, productkoef AS l
				    WHERE  a.Reference = c.ItemNO
				       AND a.Reference = v.Reference 
				       AND a.Reference = l.Reference				
				       AND v.entity_code = $entity_code
				       AND v.Reference = '$reference[$i]'
				       AND a.Reference = z.Reference
				       AND z.ParamValCode = '$price_group[$i]'
                       AND c.Closed = 0 				
                    ORDER BY c.PriceDate DESC";
								
		    $result = mysqli_query($link, $str);						 		
		    $obj = mysqli_fetch_object($result);
				
		    $get_koef = "SELECT z.total_add_discount   			   
			             FROM product_group AS a, card AS h, koef AS z 
			             WHERE a.id_product = h.id_product        		
				         AND h.entity_code = {$entity_code}
				         AND a.id_product = z.id_product
				         AND z.entity_code = {$entity_code}
				         AND a.product_group = '$price_group[$i]'";
				  
		    $koef = mysqli_query($link, $get_koef);				
		    $queri_koef = mysqli_fetch_object($koef);
		
			  	
		    $tarif = $obj->Tarif;        		
		    $pdb = $obj->pdb;
		    $kolichestvo = $obj->Quantity;
		
            if (!empty ($queri_koef)) {		
		        $tatal_add_discount = $queri_koef->total_add_discount;
		    } else {
			    print "<button><a href=\"?uri=cardview&customer=$entity_code \"> << вернуться назад</a></button><br>";
			    exit('<p>расчитайте total_add_discount!</p>');
		    }
                  		 
		    $price_dogovor = $tarif*(1-$tatal_add_discount);		
		    $symma_po_stroke = $price_dogovor*$kolichestvo;		
		    $dop_skidka_po_napravlenie = 0.2;
		    $konechnaia_cena = $price_dogovor*(1-$dop_skidka_po_napravlenie);
		    $sum_so_skidkoi_obj = $konechnaia_cena*$kolichestvo;
		    $tiraj_za_ed_po_dogovory = $price_dogovor/$pdb;
		    $tiraj_za_ed_so_skidkoi = $konechnaia_cena/$pdb;
				
	    echo "Reference: $reference[$i]<br>
              Price Group: $price_group[$i]<br>
              Количество: $kolichestvo<br> 
			  PDB: $pdb<br> 
			  Цена по договору: [$price_dogovor]<br>
			  Cумма по строке: <b>$symma_po_stroke</b><br>
			  Конечная цена: <b>$konechnaia_cena</b><br>
			  Сумма со скидкой общая: <b>$sum_so_skidkoi_obj</b><br>
			  Тираж за единицу по договору: <b>$tiraj_za_ed_po_dogovory</b><br>
			  Тираж за единицу со скидкой: <b>$tiraj_za_ed_so_skidkoi</b><br>
              --------------- <br>
			  <hr>";	

        //вставка в таблицу cardrezult
		
        $str = "SELECT id FROM cardrezult WHERE  Reference = '$reference[$i]' AND entity_code = $entity_code";
	    $query = mysqli_query($link, $str);	
	    $row = array();
	
	    $row = mysqli_fetch_array($query);
	
		if (empty($row['id'])) {
			
			$insert =  "INSERT INTO cardrezult (Reference, Price_group, entity_code, Quantity, price_dogovor, symma_po_stroke, sum_so_skidkoi_obj, pdb) 
			            VALUES ('$reference[$i]', '$price_group[$i]',
       					        $entity_code, $kolichestvo,
								$price_dogovor, $symma_po_stroke,
								$sum_so_skidkoi_obj,
								$pdb)";
								
		    mysqli_query($link, $insert);	
			
		} else {		
		  // exit('Данные Reference уже в таблице есть.');
		    $update =  "UPDATE cardrezult SET 
						Reference = '$reference[$i]',
						Price_group = '$price_group[$i]',
						entity_code = $entity_code,
						Quantity = $kolichestvo,
						price_dogovor = $price_dogovor,
						symma_po_stroke = $symma_po_stroke,
						sum_so_skidkoi_obj = $sum_so_skidkoi_obj,
						pdb = $pdb
						WHERE 
						entity_code = $entity_code
                        AND Reference = $reference[$i]";
						
			mysqli_query($link, $update);			 
		}	
        // конецвставки в таблицу cardrezult  			
	}
			  
	    $str = "SELECT SUM(w.symma_po_stroke), SUM(w.sum_so_skidkoi_obj), 
	                 w.Price_group, w.symma_po_stroke, 
					 w.sum_so_skidkoi_obj				   
			    FROM cardrezult AS w
			    WHERE  w.entity_code = $entity_code
			    GROUP BY w.Price_group";
		
		$result = mysqli_query($link, $str);				
		$tabList = array();
		
        echo '<table>
		      <tr class="header">
			   <td>Price_group</td>
			   <td>Сумма по договору<br> по направлению</td>
			   <td>Сумма со скидкой <br> по направлению</td>
			   <td> Сумма скидки <br> по каждому направлению </td>
			   <td> Сумма дополнительной скидки </td>
			  </tr>';		
		for ($i = 0; $i < mysqli_num_rows($result); $i++ ) {
			
		    $tabList = mysqli_fetch_array($result);
		    $m = $tabList[0] - $tabList[1]; 
		    $s = $tabList['symma_po_stroke'] - $tabList['sum_so_skidkoi_obj'];
		 
		    echo "<tr>  		 
		          <td>".$tabList['Price_group']."</td>
	              <td>".$tabList[0]."</td>
		          <td>".$tabList[1]."</td>
		          <td>".$m."</td>
		          <td>".$s."</td>		  
                  </tr>";		
		}		
	    echo '</tr></table><hr>';	
	  
	  //=================================================
	    $str = "SELECT w.Reference, w.Price_group,  
					  w.pdb, w.Quantity, w.symma_po_stroke,
                      w.sum_so_skidkoi_obj 					  
			    FROM cardrezult AS w
			    WHERE  w.entity_code = $entity_code";
		
		$result = mysqli_query($link, $str);				
		$tabList = array();
		
        echo '<table>
		      <tr class="header">
			   <td>Reference</td>
			   <td>Price_group</td>
			   <td>Общее PDB</td>
			   <td>Сумма Тиража по договору </td>
			   <td>Сумма Тиража со скидкой</td>
			  </tr>';		
		for ($i = 0; $i < mysqli_num_rows($result); $i++ ) {
			
		    $tabList = mysqli_fetch_array($result);		 
		    $c = $tabList['Quantity']*$tabList['pdb'];
		    $h = $tabList['symma_po_stroke']/$c;
		    $z = $tabList['sum_so_skidkoi_obj']/$c;
		    echo "<tr>  		 		   
		          <td>".$tabList['Reference']."</td>
		          <td>".$tabList['Price_group']."</td>
		          <td>".$c."</td>
		          <td>".$h."</td>
		          <td>".$z."</td>
                 </tr>";		
		 }		
	    echo '</tr></table><hr>';	
	  
	    echo "<button><a href=\"?uri=delkoef&delkoef=$entity_code \">очистить временную таблицу </a></button> <br><br>
              <button><a href=\"?uri=cardview&customer=$entity_code \">карточка клиента >></a></button>";
	  
	    echo '</div>';
   }	
}
?>

