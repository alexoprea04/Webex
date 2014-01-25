<?php
set_include_path(__DIR__);

ini_set('display_errors', 1);

require_once('include/autoloader.php');

if(!isset($_GET['class'])) {
	$class = 'Home';
	$method = 'index';	
}
else {
	$class = $_GET['class'] . '_Controller';
	$method = $_GET['method'];
}

$class = $_GET['class'] . '_Controller';
$method = $_GET['method'];

$classObj = new $class();
$classObj->setCalledClass($class);
$classObj->setCalledMethod($method);


$classObj->preMethodCall();
$classObj->$method();
$classObj->postMethodCall();