<?php
/*****************************************************
*	File name:logout.php
*	longing out user
*	Login ver. 1.0
*	Date: 08.2015
*	Author: arektechelevate
********************************************************/
	require_once 'init/init.php';
	session_start();
	//destroy session and go to index.php page
	session_destroy();
	header('location:index.php');
	
?>
