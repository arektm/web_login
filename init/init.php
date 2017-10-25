<?php
/*****************************************************
*	Name: initialization file
*	
*	Login ver. 1.0
*	Date: 08.2015
*	Author: arektechelevate
********************************************************/
//auto load function to load all classes from folder Classes
spl_autoload_register(function($class){
	require_once ('Classes/' . $class . '.Class.php');
});

?>
