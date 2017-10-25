<?php
//author arektechelevate@github.com
//start session
session_start();
//auto load all classes
require_once 'init/init.php';
//check if any user is logged in
if ((isset($_SESSION['loginName']))&&(isset($_SESSION['login_string']))){
	$user=new User;
	//if they are set session variables that go to secured page
	if ($currentUser=$user->loginCheck($_SESSION['loginName'])){
		unset($user);
		header('location:secured_page.php');
		exit();
		}
}

else{
//else go to login form
?>
	<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title>Loigin</title>
				<link rel="stylesheet" type="text/css" href="css/style.css">
			</head>
				<body>
					<div id="loginForm" >
					<?php
						// display errors received by $_SESSION['error'] eg.: invalid user name or password
						if (isset($_SESSION['error'])) {
							$sessionError=$_SESSION['error'];
							echo("<div class='error'>$sessionError</div>");
							//unset($_SESSION['error']);
							session_destroy();
						}
						
					?> 
					<h2>Welcome</h2>
					<form action="login_process.php" method="post" name="login_form">
						<label>	Login : </label>
						<input id="loginName" placeholder="Login Name" type="text" name="loginName" maxlength=50 required autofocus></input><br>
						<label>Password : </label>
						<input id="password" placeholder="Password" type="password" name="password" maxlength=50 ></input><br><br>
						
						<input type="Submit" value="Login" name="Submit" id="loginBtn"/> or <a href='register.php'>Register</a>
					</form>		
					</div>
								
				</body>
		</html>


<?php	
	}
?>
