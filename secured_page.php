<?php
require_once 'init/init.php';
session_start();
$user=new User;
//check the user is logged in
if (!$user->loginCheck($_SESSION['loginName'])){
	unset($user);
	header('location:index.php');
	exit();

	
}else{
	
	//secured page code here
	
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<title>Secured page</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
			<body>
			<div id="secured">
				<h4>Welcome on secured page <?php echo $_SESSION['loginName']?></h4>
				<br><a href='logout.php'>[Logout]</a>
			<div>
				
			</body>
	</html>
<?php
	}
unset($user);
?>
