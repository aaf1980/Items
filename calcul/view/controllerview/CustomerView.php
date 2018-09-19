<div class = "poisk">
   <form  method="POST" action="?uri=customer">
     <ol>
	  <li><input type="text" name="entity" placeholder="entity_code"></li>
	  <li><input type="text" name="customer" placeholder="name"></li>
	  <li><input type="text" name="type" placeholder="type"></li>
	  <li><input type="submit" value="поиск"></li>
	 </ol>
  </form> 
</div>   

<div class="pl_itemlist">                                                     
<!--вывод основной таблицы-->
<table>
  <tr class="header">
   <td bgcolor="#BDBDBD"><span>name</span></td>
   <td bgcolor="#BDBDBD"><span>english name</span></td>
   <td bgcolor="#BDBDBD"><span>type</span></td>
   <td bgcolor="#BDBDBD"><span>sort</span></td>
   <td bgcolor="#BDBDBD"><span>entity code</span></td>
  </tr>
<?php
    //вывод значений таблицы-------------------------
	$n = 0;
	foreach ($customerList as $dp) {	
		$classtype = ''; 
		$n++;  
		if ($n == 2) {
			$n = 0;
			$classtype = 'class="even"';
		}
?>  
   <tr  <?= $classtype?>>     
	 <td><a target="_blank" href="<?= "?uri=pgroup&customer={$dp['entity_code']}" ?>"><?= $dp['name'] ?></a></td>           	    
	 <td><?= $dp['english name'] ?></td>     	    	   
	 <td><?= $dp['type'] ?></td> 	    
	 <td><?= $dp['sort_my'] ?></td> 	    	   
	 <td><a target="_blank" href="<?= "?uri=cardview&customer={$dp['entity_code']}" ?>"><?= $dp['entity_code'] ?></a></td>     		  		 		  
   </tr>    
<?php
   } //конец foreach
   unset($dp); 
?>
</table>
<?php
    if (empty($_POST['entity']) AND empty($_POST['customer']) AND empty($_POST['type'])) {
        include_once 'view/panning/panning_customer.php';
    } 
?>
</div>