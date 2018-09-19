<?php

if (isset($_GET['Pos'])) {
    $Pos = $_GET['Pos'];	
} else {
    $Pos = 0; 
}

    if (!empty($_REQUEST['brandid'])) {	  
        $FullRef = "brandid=".$_REQUEST['brandid']."";
    } elseif(!empty($_REQUEST['family'])) {
        $FullRef = "family=".$_REQUEST['family']."";
    } elseif(!empty($_REQUEST['reference'])) {
        $FullRef = "reference=".$_REQUEST['reference']."";	
    } elseif(!empty($_REQUEST['fullref'])) {
        $FullRef = "fullref=".$_REQUEST['fullref']."";	
    } elseif(!empty($_REQUEST['productgroup'])) {
        $FullRef = "productgroup=".urlencode($_REQUEST['productgroup'])."";
    }
    //сколько строк таблицы  выводиться на странице
    $LN = 20;            
    $CntLines = 0;

    if ($dp = mysqli_fetch_array($paningacia_tarif_poisk)) {
        //вывод количества строк	
       $CntLines = $dp[0];
    }  

    $CurrPage = round($Pos/$LN)+1;
    $LastPage = floor($CntLines/$LN)+1;

    $PredPage = $Pos-$LN;
        if ($PredPage < 0) 
            $PredPage = 0; 

    $LastPage1 = floor($CntLines/$LN) * $LN;

    echo '<table><tr class="paning">';
	
    if ($CurrPage > 1) 
        echo "<td><a href=\"?uri=tarifpoisk&$FullRef&Pos=0\"> First page </a></td><td><a href=\"?uri=tarifpoisk&$FullRef&Pos=$PredPage\"> << Pred Page </a></td>";       

    echo "<td>Page $CurrPage</td>";

    if ($CurrPage < $LastPage) {
        $page_count = ($Pos+$LN);
        echo "<td><a href=\"?uri=tarifpoisk&$FullRef&Pos=$page_count\"> Next Page >> </a></td>";
    }
	
    echo "<td><a href=\"?uri=tarifpoisk&$FullRef&Pos=$LastPage1\"> Last Page $LastPage </a></td></tr></table>";         

