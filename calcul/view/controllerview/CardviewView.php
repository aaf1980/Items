<div class="pl_itemlist">
<!--вывод инфы о клиенте -->                                
  <div class="cardcustomer">     
   <ul>
	   <li class="zagolovok_c">Управление карточкой клиента:</li> 
       <li>name:<?= $obj->name ?> | 
	       type: <?= $obj->type ?> | 
		   sort: <?= $obj->sort_my ?>| 
		   entity code: <?= $obj->entity_code ?>
	   </li> 
       <li><button><a href="?uri=customer"> << списк клиентов</a></button></li>   
	   <li><button><a href="?uri=pgroup&customer=<?= $obj->entity_code ?>"> << выбор групп</a></button><hr></li> 
	   <li>
	    <form method="post" action="?uri=douwnload&customer=<?= $obj->entity_code ?>" enctype="multipart/form-data">  
	     <input type="file"  name="userfile"  value="File name:">  
         <input type="submit" value="download">          		 
        </form> 
	   </li>
	</ul>	
<!--отправка файлов exel-->
<?php
if (!empty($getExel)) {	
?>
<form action="?uri=handlingexel&customer=<?= $obj->entity_code ?>" method="post">	
<select size="3" multiple name="name_exel">	
<?php	
    foreach($getExel as $row_exel) {	
?> 
<option value="<?= $row_exel['path'] ?>"> <?= $row_exel['name_file'] ?> </option>
<?php	   
    }
    unset($row_exel);
?> 	
</select>

<p><input  type="submit" value="Вывести товары"></p>
</form>
<?php
} else {
	echo('файлы exel еще не загружены');
}
?>
<!--конец отправка файлов exel--> 
   <hr>  
</div>		  
<!--конец вывода инфы о клиенте-->	  
<?php
    if (!empty($obj->entity_code)) {
        $entity_code = $obj->entity_code;
    } else {
        exit('нет данных');	
    }

    if (!empty($koefList)) {
?>
<!--расчет коэфициентов по product group-->
<div style="height:30px;"><b>Коэфициенты product group</b></div>
<table>
   <tr class="header"> 
	<td>Price <br> Group </td>
	<td>base <br> discount</td>
	<td>add <br> discount 1</td>
	<td>add <br> discount 2</td>
	<td>add <br> discount 3</td>
	<td>add <br> discount 4</td> 
	<td>koef</td>
	<td>discount</td>
	<td>total add <br> discount</td>
    <td>Del</td>
   </tr>
<?php	
        foreach ($koefList as $row_product) {
	 
            $base_discount  = $row_product['base_discount']*100 .'%';
	        $add_discount_1 = $row_product['add_discount_1']*100 .'%';
	        $add_discount_2 = $row_product['add_discount_2']*100 .'%';
	        $add_discount_3 = $row_product['add_discount_3']*100 .'%';
	        $add_discount_4 = $row_product['add_discount_4']*100 .'%';
  
            $koef = $row_product['koef'];
            $discount = $row_product['discount']*100 .'%';
            $total_add_discount = $row_product['total_add_discount']*100 .'%';
?> 
<tr>
 <td><a href="<?= "?uri=countkoef&customer={$entity_code}&product=".urlencode($row_product['product_group']).""?>"> <?= $row_product['product_group'] ?></a></td>
 <td><input type="text"  size=4 value="<?= $base_discount ?>" readonly></td>
 <td><input type="text"  size=5 value="<?= $add_discount_1 ?>" readonly></td>
 <td><input type="text"  size=5 value="<?= $add_discount_2 ?>" readonly></td>
 <td><input type="text"  size=5 value="<?= $add_discount_3 ?>" readonly></td>
 <td><input type="text"  size=5 value="<?= $add_discount_4 ?>" readonly></td>
 <td><input type="text"  size=4 value="<?= $koef ?>" readonly></td>
 <td><input type="text"  size=4 value="<?= $discount ?>" readonly></td>
 <td><input type="text"  size=4 value="<?= $total_add_discount ?>" readonly></td>
 <td><a href="<?= "?uri=del&customer={$entity_code}&id_product=".urlencode($row_product['id_product'])."" ?>">del</a></td>
</tr> 
<?php	   
        }//конец foreach
        unset($row_product);
?>  
<tr>
<td>
<button><a href="<?= "?uri=del&customerall={$entity_code}" ?>"> удалить все группы </a>
</button>
</td>
</tr>
</table>   
<hr>
<!--расчет коэфициентов по product group-->
<?php  
    } else {	
        echo '<h1>карточка незаполнена.</h1>';	
    }	
//вывод продуктов  
    if (!empty($tabList)) {
?>	

<div style="height:30px;"><b>Product group</b></div>
<form id="data" method="POST" action="?uri=rezult"> </form>
<table>
  <tr class="header">
   <td bgcolor="#BDBDBD"><span>BrandId</span></td>
   <td bgcolor="#BDBDBD"><span>Reference</span></td>
   <td bgcolor="#BDBDBD"><span>FullRef</span></td>
   <td bgcolor="#BDBDBD"><span>ItemName</span></td>
   <td bgcolor="#BDBDBD"><span>Family</span></td>
   <td bgcolor="#BDBDBD"><span>FamilyName</span></td>     
   <td bgcolor="#BDBDBD"><span>Tarif</span></td>
   <td bgcolor="#BDBDBD"><span>Price Group</span></td>
   <td>PRI unit <br> abj RUB</td>
   <td>PDB <br> abj RUB</td>
   <td bgcolor="#BDBDBD"><span>Del</span></td>
  </tr>
<?php
//вывод значений таблицы-------------------------
        $n = 0;
        foreach ($tabList as $dp) {	

        $classtype = " "; 
        $n++;  
        if ($n == 2) {
	        $n = 0;
	        $classtype = 'class="even"';
        }   
?>  
   <tr <?= $classtype?>>           
	<td><?= $dp['BrandId'] ?></td>     	    	   
	<td>
	 <a href="<?= "?uri=totalfactors&customer={$entity_code}&product=".urlencode($dp['ParamValCode'])."&reference={$dp['Reference']}"?>"><?= $dp['Reference'] ?></a>
	 <input type="hidden" name="reference[]" form="data"  value="<?= $dp['Reference'] ?>">
	</td> 	          	    
	<td><?= $dp['FullRef'] ?></td>     	    	   
	<td><?= $dp['ItemName'] ?></td> 	    
	<td><?= $dp['Family'] ?></td>
	<td><?= $dp['FamilyName'] ?></td>		
	<td align="right">
	 <?= number_format($dp['Tarif'], 2, ".", "'") ?>
	 <input type="hidden" name="tarif[]" form="data"  value="<?= $dp['Tarif'] ?>">	
	</td>
	<td>
	 <?= $dp['ParamValCode'] ?>
	 <input type="hidden" name="price_group[]" form="data"  value="<?= $dp['ParamValCode'] ?>">
	</td>	
	<td><?= $dp['pri_unit_rub'] ?></td>
	<td>
	 <?= $dp['pdb'] ?>
	 <input type="hidden" name="pdb[]" form="data"  value="<?= $dp['pdb'] ?>">
	</td>			
	<td><a href="<?= "?uri=delprod&customer={$entity_code}&reference=".$dp['Reference']."" ?>"> del </a></td>
   </tr>    
<?php 
        }
        unset($dp);   
    } else {	
        echo '<h1>Файл EXEL незагружен</h1>';	
    }	
//проверка на pdb у reference
    if (!empty($notKoef)) {	
        foreach ($notKoef as $row) {
	        echo "<tr>Для <b>Reference</b>:[{$row}] неподсчитаны [PRI unit abj RUB] и [PDB abj RUB]<br></tr>";
        }
        unset($row);
    }
?>
</table>
<input type="hidden" name="entity_code" form="data"  value="<?= $entity_code ?>">
<input type="submit" value="подсчитать"  form="data">

<hr>
</div>