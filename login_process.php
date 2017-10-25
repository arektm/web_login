<?php
/*****************************************************
*	File name:login_process.php
*	checking login name and password and creating session
*	Login ver. 1.0
*	Date: 08.2015
*	Author:arektechelevate
********************************************************/
//session start
session_start();
//auto load classes
require_once 'init/init.php';

// check the data are received by $_POST array
if(isset($_POST['Submit'])&&isset($_POST['loginName'])&&isset($_POST['password'])){
	//check the conditions for $loginName and $password
	//if any statement true go to index page and display message 
	if ((strlen($_POST['password'])<6)||(strlen($_POST['password'])>50)||(strlen($_POST['loginName'])<2)||(strlen($_POST['loginName'])>50)){
		$_SESSION['error']="Invalid login or password";
		header('location: index.php');
		
	}else{
		//create instance of user
		$user=new User();
		//check the user name and password in database
		if($logedUser=$user->getUser($_POST['loginName'],$_POST['password'])){
			//get the user-agent string of the user
			$userBrowser = $_SERVER['HTTP_USER_AGENT'];
			//set session name to name received form database
			$_SESSION['loginName']=$logedUser['login_name'];
			//create hashed login_string using password and userBrowser
			$_SESSION['login_string'] = hash('sha512', $logedUser['password'] . $userBrowser);
			unset($user);
			header('location: secured_page.php');
		}else{
			$_SESSION['error']="Invalid login or password";
			unset($user);
			header('location: index.php');
		}

	
	}
}
else{
	//protection against direct access to script typing http://domanin.com/login_process.php
	$_SESSION['error']="Please use login form";
	header('location: index.php');
}

?>
