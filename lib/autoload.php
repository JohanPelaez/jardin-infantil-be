<?php


/*
 * Copyright 2016 Johan Peláez.
 */

function class_autoloader($c)
{	
	$ROOT_DIR = dirname(__FILE__);	
	
	static $dir = NULL;	
	
	if ($dir === NULL)
	{
		
		$dir = array(
		//$ROOT_DIR . '/dao/',
		//$ROOT_DIR . '/model/',
		$ROOT_DIR . '/logic/'
		);
		
	}	
	
	foreach ($dir as $d)
	{		
		if (file_exists($d . $c . '.php'))
		{			
			require_once($d . $c . '.php');			
			break;			
		}		
	}	
}
spl_autoload_register('class_autoloader');

$headers = apache_request_headers();

if (!isset($headers["Authorization"]) && $class == 'auth' && $function == 'login') {
	$Class = new auth();
	$return = $Class->login();
}elseif (isset($headers["Authorization"])) {
	$Class = new $class();
	$return = $Class->$function();
}else{
	header('HTTP/1.1 500 Internal Server Booboo');
	header('Content-Type: application/json; charset=UTF-8');
	die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}

print_r(json_encode($return));