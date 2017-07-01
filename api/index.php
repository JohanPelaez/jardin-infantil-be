<?php

$method = $_SERVER['REQUEST_METHOD'];
$params = explode("/", $_GET["params"]);
$class = array_shift($params);
$function = array_shift($params);
$data = json_decode(file_get_contents('php://input'),true);

require('../common/JWT/JWT.php');

define('SECRET_KEY', 'HtCrwBlfFxOVG3VltvV6');
define('ALGORITHM', 'HS512'); 

require('../lib/autoload.php');