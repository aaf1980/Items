<div class="pl_itemlist"> 
<!--вывод инфы о клиенте -->                                
  <div class="cardcustomer">     
   <ul>
	   <li class="zagolovok_c">Управление карточкой клиента:</li> 
       <li>
	    name:<?= $obj->name ?> | 
	    type: <?= $obj->type ?> | 
		sort: <?= $obj->sort_my ?>| 
		entity code: <?= $obj->entity_code ?>
	   </li>
       <li><button><a target="_blank" href="?uri=cardview&customer=<?= $obj->entity_code ?>">карточка клиента >></a></button><hr></li> 	   
	</ul>   	
  </div>		  
<!--конец вывода инфы о клиенте-->                                                       
<form class="form_pg"  method="POST" action="?uri=savegroups"> 
<?php
$entity_code = $obj->entity_code;
 
    foreach ($pgroupList as $row) {      
    
	    $n = 0;
        $classtype = ''; 	
	    $n++; 	 
	    if ($n <= 20) 	 
	        $classtype = 'class="even1"';     	
        if (20 < $n and $n <= 40) 
		    $classtype = 'class="even2"';        			
	    if (40 < $n and $n <= 60) 
		    $classtype = 'class="even3"';        			
	    if (60 < $n and $n <= 77) 
		    $classtype = 'class="even4"';        			
    //маркировка имеющихся продуктовых групп    	
        if (in_array($row['id_product'], $id_product)) {	    
		    $input_properties = 'class="color_pg"';
		    $r = 'disabled';
	    } else {	  
	        $input_properties = '';
		    $r = '';
	    }	 
?> 	
<div id="even_id" <?= $classtype ?>>   
  <input id="prodgroup" type="checkbox"  <?= $r ?> name="id_product[]"  value="<?= $row['id_product'] ?>">		
  <label for="prodgroup" <?= $input_properties ?>> <?= $row['product_group'] ?></label>     
</div> 
<?php 
   } 
   unset($row);  
?>	

<p style="clear:both;padding-top:4px;">
  <input type="hidden" name="entity_code" value="<?= $entity_code ?>">               
  <input type="submit" value="добавить группу">	   
</p>		 
</form>		 
</div>

