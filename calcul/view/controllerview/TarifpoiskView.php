<div class="pl_itemlist"> 

<p>Найдено позиций:</p>                                                    
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
  </tr>
<?php
//вывод значений таблицы-------------------------
$n = 0;
foreach ($tarifPoiskList as $dp) {	

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
   </tr>    
<?php 
    }
    unset($dp); 
?>
</table>
<?php
    include 'view/panning/panning_tarif_poisk.php';
?>
</div>