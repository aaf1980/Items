<div class="pl_itemlist">                                                          
<!--вывод инфы о продукте -->                                
  <div class="cardcustomer">     
   <ul>
	   <li class="zagolovok_c">Карточка товара:</li> 
       <li>BrandId:[<?= $productList->BrandId ?>] |              
	       Reference: [<?= $productList->Reference ?>] | 
		   FullRef: [<?= $productList->FullRef ?>] |
 		   ItemName: [<?= $productList->ItemName ?>]
	   </li>  
	</ul>	
    <hr style="width:700px;margin-left:10px;">
	
<?php
if (empty($priceGroup) ) {
?>	
	<p>PriceGroup:[Для данного товара price group не установлена ]</p>
<?php
} else {
?>
  <p>PriceGroup:[<?= $priceGroup->ParamValCode ?>]</p>
<?php
} 
?>	
  </div>		  
<!--конец вывода инфы о продукте-->
<?php
    if (!empty($_GET['productreference']) )
	    $productreference = $_GET['productreference'];

    if (empty($productKoef)) {	
?>

<table style="float:left;">

    <tr class="header"> 
	 <td>KM Firelec</td>
	 <td>PRI unit <br>adj RUB</td>
	 <td>PRI unit adj<br>(part in RUB)</td>
	 <td>PRI unit adj<br>(part in EUR)</td>
	 <td>PDB adj RUB</td>	     	
    </tr>

	<tr>
	 <td><input type="text"  size=6 value="" readonly></td>
	 <td><input type="text"  size=4 value="" readonly></td>
	 <td><input type="text"  size=9 value="" readonly></td>
	 <td><input type="text"  size=9 value="" readonly></td>
	 <td><input type="text"  size=9 value="" readonly></td>
	</tr> 
	
</table>

<?php	
    } else  {
?>

<table style="float:left;">

    <tr class="header"> 
	 <td>KM Firelec</td>
	 <td>PRI unit <br>adj RUB</td>
	 <td>PRI unit adj<br>(part in RUB)</td>
	 <td>PRI unit adj<br>(part in EUR)</td>
	 <td>PDB adj RUB</td>	     	
    </tr>

	<tr>
	 <td><input type="text"  size=6 value="<?= $productKoef->KM ?>" readonly></td>
	 <td><input type="text"  size=4 value="<?= $productKoef->pri_unit_rub ?>" readonly></td>
	 <td><input type="text"  size=9 value="<?= $productKoef->PriRub ?>" readonly></td>
	 <td><input type="text"  size=9 value="<?= $productKoef->PriEur ?>" readonly></td>
	 <td><input type="text"  size=9 value="<?= $productKoef->pdb ?>" readonly></td>
	</tr> 
	
</table>
<?php
    } 
?>
<div style="height:70px;"></div>
<div id="aas_2"> 
 <form id="data" method="POST" action="?uri=updatekoefproduct"></form> 
<ul id="count_koef">  	  	   	   	   
<?php
    foreach ($currency as $row) {
?>	   	   	   
	   <li>
	    <span>RUB/EUR&nbsp;:</span>
	    <input type="checkbox"  name="score2" form="data" value="<?= $row['RUB_EUR'] ?>">			
        <span style="padding-left:15px;"></span>
	   </li>
	   
	   <li>
	    <span>RUB/USD&nbsp;:</span>
	    <input type="checkbox"  name="score3" form="data" value="<?= $row['RUB_USD'] ?>" >		
        <span style="padding-left:15px;"><hr></span>		
	   </li>
<?php
    }
    unset($row);
?> 	   
	   <li>
	    <span>KM Firelec:&nbsp;&nbsp;&nbsp;</span>
	    <input name="score1" form="data" type="text"  size=4 required>    		
        <span style="padding-left:15px;"></span>	  
	   </li>
	   
	   <li>
	    <span>PRI unit adj<br>(part in RUB):</span>
	    <input  name="score4" form="data" type="text"  size=4>	     		
        <span style="padding-left:15px;"></span>
	   </li>
	   
	   <li>
	    <span>PRI unit adj<br>(part in EUR):</span>
	    <input  name="score5" form="data" type="text"  size=4>	    		
        <span style="padding-left:15px;"></span>
	   </li>
	   
	   <li>
	    <input type="hidden" name="reference" form="data"  value="<?= $productreference ?>">	    
	   </li> 
	   
       <li>	 
	    <input type="submit" value="Подсчитать"  form="data">
	   </li>	
	   
	  </ul>   	  
    </div>	 

</div>

                  