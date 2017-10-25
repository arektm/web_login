<!--
/*****************************************************
*	File name: register.php
*	Registration form
*	Login ver. 1.0
*	Date: 08.2015
*	Author: arektechelevate
********************************************************/
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
<body>
	
	<div id="registerForm">
	<?php
	//display error from $_SESSION['error']
	session_start();
	if (isset ($_SESSION['error'])){
		echo $_SESSION['error'];
		session_destroy();
	}
	?>
	<h2>Please fill all fields to register</h2>
	<form name="register" method="post" action="register_process.php">
		<label for="loginName">Login name: </label>
		<input id="loginNameReg" name="loginName" placeholder="Login Name" type="text" maxlength=50 required autofocus></input><br><br>
		<label for="eMail">E-mail address: </label>
		<input id="eMailReg" name="eMail" placeholder="eMail" type="email" maxlength=50 required></input><br><br>
		<label for="password">Password: </label>
		<input id="passwordReg" name="password" placeholder="Password" type="password" maxlength=50 required></input><br><br>
		<label for="rePassword">Retype password: </label>
		<input id="rePasswordReg" name="rePassword" placeholder="Password" type="password" maxlength=50 required></input><br><br>
		<div align="center"><input type="submit" name='registerBtn' id="registerBtn" value="Register"/></div>
	</form>
	</div>
</body>
</html>

