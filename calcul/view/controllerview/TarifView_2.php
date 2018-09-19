<div class = "poisk">

   <form  method="POST" action="?uri=tarifpoisk">
     <ol class="form_poisk">
	  <li><input type="text" name="brandid" placeholder="BrandId"></li>
	  <li><input type="text" name="reference" placeholder="Reference"></li>
	  <li><input type="text" name="family" placeholder="Family"></li>
	  <li><input type="text" name="fullref" placeholder="FullRef"></li>
	  <li><input type="text" name="productgroup" placeholder="Price Group"></li>
	  <li><input type="submit" value="поиск"><hr></li>
	 </ol>
  </form>
  
<?php
foreach ($currency as $row) {
?>

  <form  method="POST" action="?uri=currency">
     <ol class="form_poisk">
	  <li>
	   <input type="text" id="eur" name="eur" placeholder="RUB/EUR [<?= $row['RUB_EUR'] ?>]">
	  </li>
	  <li>
	   <input type="text"  name="usd" placeholder="RUB/USD [<?= $row['RUB_USD'] ?>]">
	  </li>
	  <li><input type="submit" value="установить"><hr></li>
	 </ol>
  </form>
<?php
}
unset($row);
?>  
</div>   
<div style="clear:both;"></div>

<div class="pl_itemlist">  
  <button><a href="?uri=productpdb">таблица с коэфициентами >></a></button>   
  <hr>
<!--вывод основной таблицы-->
<table>
  <tr class="header">
   <td bgcolor="#BDBDBD"><span>BrandId</span></td>
   <td bgcolor="#BDBDBD"><span>Reference</span></td>
   <td bgcolor="#BDBDBD"><span>ItemName</span></td>
   <td bgcolor="#BDBDBD"><span>Family</span></td>
   <td bgcolor="#BDBDBD"><span>FullRef</span></td>
   <td bgcolor="#BDBDBD"><span>FamilyName</span></td>
   <td bgcolor="#BDBDBD"><span>Tarif</span></td>
   <td bgcolor="#BDBDBD"><span>Price Group</span></td> 
  </tr>
<?php
//вывод значений таблицы-------------------------

    $n = 0;   
	for ($i=0; $i < $rowCnt; $i++) {
        $classtype = " "; 
        $n++; 		
        if ($n == 2) {
	        $n = 0;
	        $classtype = 'class="even"';
        } 
	$str = implode(' | ', $dp[$i]);
	$arr = str_split($str, 150);
	
?>  
   <tr  <?= $classtype?>>           
		
		<td><?= print $arr[0] ?></td>
		     	    	   				
   </tr>    
<?php 
    }	
?>
</table>
<?php
   include 'view/panning/panning_tarif.php';
?>
</div>