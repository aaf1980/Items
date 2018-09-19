<script type="text/javascript" src="js/count_koef.js"></script>
<div class="pl_itemlist">
  <div class="cardcustomer">     
      <ul>
	   <li class="zagolovok_c">Расчет product_group:</li> 
       <li>name:<?= $obj->name ?> | 
	       type: <?= $obj->type ?> | 
		   sort: <?= $obj->sort_my ?>| 
		   entity code: <?= $obj->entity_code ?>
	   </li> 
	   <li><a href="?uri=customer"><button> << списк клиентов</button></a></li>
	   <li><a href="?uri=pgroup&customer=<?= $obj->entity_code ?>"><button> << выбор групп</button></a><hr></li>  
	   <li><a href="?uri=cardview&customer=<?= $obj->entity_code ?>"><button> << карточка</button></a><hr></li>
	  </ul>	  	         
  </div>	

<?php

if (!empty($_GET['customer']) AND !empty($_GET['product'])) {
    $entity_code = $_GET['customer'];
    $product_group = $_GET['product'];
} else {
	exit('Произошла ошибка!');
}

    $koef_view = $obj_koef_2->koef;
    $discount_view = $obj_koef_2->discount*100;
    $total_add_discount_view = $obj_koef_2->total_add_discount*100;

    $base_discount_view = $old_koef->base_discount*100;
    $add_discount_1_view = $old_koef->add_discount_1*100;
    $add_discount_2_view = $old_koef->add_discount_2*100;
    $add_discount_3_view = $old_koef->add_discount_3*100;
    $add_discount_4_view = $old_koef->add_discount_4*100;
?>				
  <div id="aas"> 
   <form id="data" method="POST" action="?uri=updatekoef"> </form>
      <ul id="count_koef">      	
       <li>
	    <span>price group:</span>
        <?= $product_group ?>	  
	   </li>
	   <li>
	   <span>результирующие коэфициенты:</span>
	    koef = [<?= $koef_view ?>] |
		discount = [<?= $discount_view ?>%] |
		total_add_discount = [<?= $total_add_discount_view ?>%]
	   </li>
	   <li>изменяемые коэфиценты | действующие </li>
	   <li>
	    <span>base discount  &nbsp;:</span>
	    <input id="score1" name="score1" form="data" type="text"  size=4>    		
        <span style="padding-left:15px;"><?= $base_discount_view ?>%</span>	  
	   </li>
	   <li>
	    <span>add discount 1:</span>
	    <input id="score2" name="score2" form="data" type="text"  size=4>	     		
        <span style="padding-left:15px;"><?= $add_discount_1_view ?>%</span>
	   </li>
	   <li>
	    <span>add discount 2:</span>
	    <input id="score3" name="score3" form="data" type="text"  size=4>	    		
        <span style="padding-left:15px;"><?= $add_discount_2_view ?>%</span>
	   </li>
	   <li>
	    <span>add discount 3:</span>
	    <input id="score4" name="score4" form="data" type="text"  size=4>	     		
        <span style="padding-left:15px;"><?= $add_discount_3_view ?>%</span>
	   </li>
	   <li>
	    <span>add discount 4:</span>
	    <input id="score5" name="score5" form="data" type="text"  size=4>     		
        <span style="padding-left:15px;"><?= $add_discount_4_view ?>%</span>
	   </li>
	   <li>
	    <input type="hidden" name="entity_code" form="data"  value="<?= $entity_code ?>">
	    <input type="hidden" name="product_group" form="data"  value="<?= $product_group ?>">
	   </li>
       <li>
	   <button onclick="askServer()">Подсчитать</button>
	   <input type="submit" value="отправить"  form="data">
	   </li>	   
	  </ul>      	   	
      <div id="result"></div>
	  
      </div>	                                                           
</div>

