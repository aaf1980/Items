<?php	  	  	  
$base_discount =  $_POST['score1']/100;
$add_discount_1 = $_POST['score2']/100;
$add_discount_2 = $_POST['score3']/100;
$add_discount_3 = $_POST['score4']/100;
$add_discount_4 = $_POST['score5']/100;

$koef = ((1-$base_discount)*(1-$add_discount_1)*(1-$add_discount_2)*(1-$add_discount_3)*(1-$add_discount_4));
$discount = (1-$koef)*100;
$total_discount = 1-((1-$add_discount_1)*(1-$add_discount_2)*(1-$add_discount_3)*(1-$add_discount_4));
$total_discount = $total_discount*100;

echo "Koef: [{$koef}]<br>Discount: [{$discount}%]<br>Total add discount: [{$total_discount}%]<br>"; 
 