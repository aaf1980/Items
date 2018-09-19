<?php
class ConnectBD
{    
    static function getConnect()
    {   
	    $mysqli = new mysqli("localhost", "vladlev_adv", "@Go.m.-UD%L~", "legrand");		
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$mysqli->set_charset("utf8");
		return $mysqli;			        
    }	
}


      
