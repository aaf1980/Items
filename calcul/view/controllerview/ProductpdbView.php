<div class = "poisk">
   <form  method="POST" action="?uri=tarifpoisk">
     <ol>
	  <li><input type="text" name="brandid" placeholder="BrandId"></li>
	  <li><input type="text" name="reference" placeholder="Reference"></li>
	  <li><input type="text" name="family" placeholder="Family"></li>
	  <li><input type="text" name="fullref" placeholder="FullRef"></li>
	  <li><input type="text" name="productgroup" placeholder="Price Group"></li>
	  <li><input type="submit" value="поиск"><hr></li>
	 </ol>
  </form> 
</div>   

<div class="pl_itemlist"> 
 <button><a href="?uri=tarif"><< таблица товаров</a></button> 
                                                   
<!--вывод основной таблицы-->
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
   <td bgcolor="#BDBDBD"><span>PRI unit adj RUB</span></td>
   <td bgcolor="#BDBDBD"><span>PDB adj RUB</span></td>
  </tr>
<?php
//вывод значений таблицы-------------------------
$n = 0;
foreach ($tarifList as $dp) {	

    $classtype = " "; 
    $n++;  	
    if ($n == 2) {
	  $n = 0;
	  $classtype = 'class="even"';
    } 
?>  
   <tr  <?= $classtype?>>           
		<td><?= $dp['BrandId'] ?></td>     	    	   
		<td><a href="<?= "?uri=productcard&productreference={$dp['Reference']}" ?>"><?= $dp['Reference'] ?></a></td> 	          	    
		<td><?= $dp['FullRef'] ?></td>     	    	   
		<td><?= $dp['ItemName'] ?></td> 	    
		<td><?= $dp['Family'] ?></td>
		<td><?= $dp['FamilyName'] ?></td>		
		<td align="right"><?= number_format( $dp['Tarif'] , 2 , "." , "'" ) ?></td>
		<td><?= $dp['ParamValCode'] ?></td>
		<td><?= $dp['pri_unit_rub'] ?></td>
		<td><?= $dp['pdb'] ?></td>
   </tr>    
<?php 
}
unset($dp); 
?>
</table>
<?php
    include 'view/panning/panning_tarif_pdb.php';
?>
</div>