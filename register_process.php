<?php
/*****************************************************
*	File name: register_process.php
*	user registration process
*	Login ver. 1.0
*	Date: 08.2015
*	Author: arektechelevate
********************************************************/
//auto load classes
require_once 'init/init.php';
//start session
session_start();
//check is data send by $_POST method, page not called directly by http://domai.com/register_process.php
if (!isset($_POST['registerBtn'])){
	$_SESSION['error']='Please login or register';
	header('location: index.php');
	
}
else{
	//check if all fields are set
	if ((isset($_POST["loginName"]))&&(isset($_POST["eMail"]))&&isset($_POST["password"])&&isset($_POST["rePassword"])){
		$loginName=$_POST["loginName"];
		$eMail=$_POST["eMail"];
		$password=$_POST["password"];
		$rePassword=$_POST["rePassword"];
			//sanitize fields
			if(($loginName=Validate::sanitize($loginName,"string")) && ($eMail=Validate::sanitize($eMail,"email"))&&($password=Validate::sanitize($password,"string"))&&($rePassword=Validate::sanitize($rePassword,"string"))&&(strlen($loginName)>2)){
				$user=new User();
				//check if user name exist in database
				if (!$user->exist($loginName)){
						if($password===$rePassword){
							if ((strlen($password))>5){
								//add user to database
								$user->addUser($loginName,$eMail,$password);
								$_SESSION['error']='Registration successfully completed. Please login';
								unset($user);
								header("location: index.php");
							}
							else{
								$_SESSION['error']='Password minimum 6 characters';
								header("location: register.php");
							}
						}
						else{
							$_SESSION['error']='Passwords not match';
							header("location: register.php");
						}
					
				}
				else{
					$_SESSION['error']='User already exist, please use other login name';
					header("location: register.php");
				}
			}
			else{
				$_SESSION['error']='Invalid data';
				header("location: register.php");
				
			}
	}
	else{
		$_SESSION['error']='Please login or register';
		header('location: index.php');
	}
}
 

?>
