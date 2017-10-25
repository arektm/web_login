<?php
/*****************************************************
*	Class name:User
*	manage user data
*	Login ver. 1.0
*	Date: 08.2015
*	Author: arektechelevate
********************************************************/

class User{
	
	//private variables
	private $myDb;
		
	//constructor crate instance Db class
	public function __construct(){
		$this->myDb=new Db();
	}
	//public methods
	
	//method adding user to database
	public function addUser($loginName,  $eMail, $password){
		//real_escape_string — Escapes special characters in a string for use in an SQL statement. Mainly to prevent SQL injection 
		$loginName=$this->myDb->connection->real_escape_string($loginName);
		$eMail=$this->myDb->connection->real_escape_string($eMail);
		$password=$this->myDb->connection->real_escape_string($password);
		$query= "INSERT INTO `users_db`.`users` (`user_id`,`login_name` ,`e_mail`, `password`) 
										VALUES (NULL,'".$loginName."', '".$eMail."', '".$password."' )";
		
		return $this->myDb->getQuery($query);
	}
	// method gets login user_id, name and password from database and returns false when no user or password not match
	//used in login process
	public function getUser($loginName, $password){
		//real_escape_string — Escapes special characters in a string for use in an SQL statement. Mainly to prevent SQL injection 
		$loginName=$this->myDb->connection->real_escape_string($loginName);
		$password=$this->myDb->connection->real_escape_string($password);
		$query="SELECT `user_id`, `login_name`,`password` FROM `users` WHERE `login_name`='".$loginName."' and `password`='".$password."'";
		if ($result=$this->myDb->getQuery($query)){
			$nuberOfUsers=$result->num_rows;
			if ($nuberOfUsers>0){
								
				$nuberOfUsers=$result->fetch_assoc();
			}else{
				$nuberOfUsers=0;
			}
		}else{
			$nuberOfUsers=0;
		}
		return $nuberOfUsers;
		
	}
	// the method checks whether the user is currently logged in, based on session
	public function loginCheck($userName){
		$userDb=$this->getPassword($userName);
		$userBrowser = $_SERVER['HTTP_USER_AGENT'];
		$sessionString = hash('sha512', $userDb['password'] . $userBrowser);
		if ($_SESSION['loginName']==$userDb['login_name']&& $_SESSION['login_string']==$sessionString){
			return true;
		}else{
			return false;
		}
		
	}
	
	//the method checks whether the user name exist in database if user name exist return true, otherwise return false
	public function exist($loginName){
		$query="SELECT `user_id`, `login_name` FROM `users` WHERE `login_name`='".$loginName."'";
		$loginName=$this->myDb->connection->real_escape_string($loginName);
		if ($result=$this->myDb->getQuery($query)){
			$nuberOfUsers=$result->num_rows;
			if ($nuberOfUsers>0){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	// method returns password of user, if no user in database returns false
	public function getPassword($loginName){
		$loginName=$this->myDb->connection->real_escape_string($loginName);
		$query="SELECT `login_name`,`password` FROM `users` WHERE `login_name`='".$loginName."'";
		if($result=$this->myDb->getQuery($query)){
			return $result->fetch_assoc();
		}
		else {
			
		return false;
		}
	}
	
	
}
?>








