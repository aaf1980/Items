<?php
	if (isset($_GET['BegPos'])) {
		$BegPos = $_GET['BegPos'];	
	} else {
		$BegPos = 0; 
	}		
    $LN = 20;            
    $CntLines = 0;
    if ($dp = $paningacia->fetch_array(MYSQLI_NUM)) {	
        $CntLines = $dp[0];
    } 
    $CurrPage = round($BegPos/$LN)+1;
    $LastPage = floor($CntLines/$LN)+1;
    $PredPage = $BegPos-$LN;
    if ($PredPage < 0) 
        $PredPage = 0; 
    $LastPage1 = floor($CntLines/$LN) * $LN;

    echo '<table><tr class="paning">';
    if ($CurrPage > 1) 
        echo "<td><a href=\"?uri=customer&BegPos=0\"> First page </a></td><td><a href=\"?uri=customer&BegPos=$PredPage\"> << Pred Page </a></td>";       
    echo "<td>Page $CurrPage</td>";
    if ($CurrPage < $LastPage) {	
        $page_count = ($BegPos+$LN);
        echo "<td><a href=\"?uri=customer&BegPos=$page_count\"> Next Page >> </a></td>"; 
    }	
    echo "<td><a href=\"?uri=customer&BegPos=$LastPage1\"> Last Page $LastPage </a></td></tr></table>";      

   

