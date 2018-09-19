<?php

if (isset($_GET['Pos'])) {
    $Pos = $_GET['Pos'];	
} else {
    $Pos = 0; 
}

    //сколько строк таблицы  выводиться на странице
    $LN = 20;            
    $CntLines = 0;

    if ($dp = mysqli_fetch_array($paningacia_tarif)) {
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
        echo "<td><a href=\"?uri=tarif&Pos=0\"> First page </a></td><td><a href=\"?uri=tarif&Pos=$PredPage\"> << Pred Page </a></td>";       

    echo "<td>Page $CurrPage</td>";

    if ($CurrPage < $LastPage) {
        $page_count = ($Pos+$LN);
        echo "<td><a href=\"?uri=tarif&Pos=$page_count\"> Next Page >> </a></td>";
    }
	
    echo "<td><a href=\"?uri=tarif&Pos=$LastPage1\"> Last Page $LastPage </a></td></tr></table>";      
    //конец панингаци	   

