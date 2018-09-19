<?php
class Router
{			
	static function run()
	{	
	    if (!empty($_REQUEST['uri'])) {
		  
		    $uri = trim(strip_tags($_REQUEST['uri']));	
		
            $marshrut = array('pgroup'=>'pgroup/pgroup', 'customer'=>'customer/index',		 		
		                  'cardview'=>'cardview/cardview', 'savegroups'=>'savegroups/savegroups',
		                  'countkoef'=>'countkoef/countkoef', 'updatekoef'=>'updatekoef/updatekoef',
		                  'del'=>'del/del', 'tarif'=>'tarif/tarif', 
						  'tarifpoisk'=>'tarifpoisk/tarifpoisk', 'productcard'=>'productcard/productcard',
						  'updatekoefproduct'=>'updatekoefproduct/updatekoefproduct',
						  'douwnload'=>'douwnload/douwnload', 'handlingexel'=>'handlingexel/handlingexel',
						  'productpdb'=>'productpdb/productpdb', 'delprod'=>'delprod/delprod',
						  'totalfactors'=>'totalfactors/totalfactors', 'rezult'=>'rezult/rezult',
						  'delkoef'=>'delkoef/delkoef', 'currency'=>'currency/currency');
	  
	        foreach ($marshrut as $uriPattern=>$path) {			
			    if (preg_match("~$uriPattern~", $uri)) {				
				    $segment = explode('/', $path);
				    $controllerName = array_shift($segment).'Controller';
				    $controllerName = ucfirst($controllerName);								
				    $actionName = 'action'.ucfirst(array_shift($segment));				
			   }              		    			
	        }
	        unset($uriPattern);			
		} else {
		    $controllerName = 'CustomerController';
		    $actionName = 'actionIndex';
	    }
		 	   		
	    $controllerFile = "controllers/{$controllerName}.php";						
	    if (file_exists($controllerFile)) {
		    include_once $controllerFile;
	    }		
	    $controllerObject = new $controllerName;
	    $controllerObject->$actionName();			  
	}			
}