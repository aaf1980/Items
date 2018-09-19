<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config/route.php';
require_once 'models/ConnectBD.php';
require_once 'view/template/header.php';
require_once 'view/template/left_sidebar_calcul.php';	
Router::run();	 
require_once 'view/template/footer.php';      
