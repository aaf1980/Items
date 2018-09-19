<div class="pl_itemlist">                                                          
 <!--вывод инфы о reference --> 
<?php
if (empty($totalkoef->total_add_discount )) {
    exit('<p>подсчитайте: total_add_discount!</p>');
} else {
?> 
  <div class="cardcustomer">     
   <ul>
	   <li class="zagolovok_c">Данные для конкретного Reference:</li> 
       <li>Entity Code:<?= $_GET['customer'] ?> | </li>
	   <li>Reference: <?= $obj->Reference ?> | </li>
	   <li>Price Group: <?= $_GET['product'] ?> | </li>
	   <li>Количества (из EXEL): <?= $obj->Quantity ?> | </li>
	   <li>Total Add Discount: <?= $totalkoef->total_add_discount ?> | </li>
       <li>PDB: <?= $obj->pdb ?> | </li>	   
	</ul>	
	
<?php
} 
    $tarif = $obj->Tarif;	
    $tatal_add_discount = $totalkoef->total_add_discount;  
    $price_dogovor = $tarif*(1-$tatal_add_discount);
    $kolichestvo = $obj->Quantity;
    $symma_po_stroke = $price_dogovor*$kolichestvo;
    $dop_skidka_po_napravlenie = 0.2;
    $konechnaia_cena = $price_dogovor*(1-$dop_skidka_po_napravlenie);
    $sum_so_skidkoi_obj = $konechnaia_cena*$kolichestvo;
    $pdb = $obj->pdb;
    $tiraj_za_ed_po_dogovory = $price_dogovor/$pdb;
    $tiraj_za_ed_so_skidkoi = $konechnaia_cena/$pdb;
?>
    <ul>
	   <li class="zagolovok_c">Коэфициенты конкретного Reference:</li> 
       <li>Цена по договору:<?= $price_dogovor ?> | </li>
	   <li>Сумма по строке: <?= $symma_po_stroke ?> | </li>
	   <li>Конечная цена: <?= $konechnaia_cena ?> | </li>
	   <li>Сумма со скидкой общая: <?= $sum_so_skidkoi_obj ?> | </li>
	   <li>Тираж за единицу по договору: <?= $tiraj_za_ed_po_dogovory ?> | </li>
	   <li>Тираж за единицу со скидкой: <?= $tiraj_za_ed_so_skidkoi ?> | </li>
	</ul>	
</div>
	<button><a href="?uri=cardview&customer=<?= $_GET['customer'] ?>"><< карточка клиента </a></button>
</div>