<?php

/*****************************************************
*	Class name: Db
*	class for manage database
*	Login ver. 1.0
*	Date: 08.2015
*	Author: arektechelevate
********************************************************/
require_once ('config/config.php');
class Db{
		
	//public variables
	public $connection=null;
	//private variables
	//set $conn to false when no connection to database
	private $conn=false;
	
	//constructor
	public function __construct(){
		//connect to database and silences php errors 
		$this->connection= @new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABSE); //no mysql errors\
		if ($this->connection->connect_errno==0 ){
			$this->conn=true;
			return $this->connection;
		}
		else{
			// if connection fail display error message and error number only
			die("Error: ".$this->connection->connect_errno);
		}
	}
	//public methods
	
	// get query from database 
	public function getQuery($query){
		if ($this->conn){
			if ($result=@$this->connection->query($query)){
			return $result;
			}
			else {
				die("Error: ".$this->connection->connect_errno);
				
			}
		}
		else{
			die("No connection to database");
		}
	}
	
	// if connection exist, close connection to database 
	public function __destruct(){
		if ($this->conn){
			$this->connection->close();
		}
	}
	
}
?>
