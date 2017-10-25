<?php
/*****************************************************
*	Class name:Validate
*	class to validate strings
*	Login ver. 1.0
*	Date: 08.2015
*	Author: arektechelevate
********************************************************/
class Validate{
	
	//Public methods
	//static method is a method accessible without needing an instantiation of the class
	//method to filters a variable with a specified filter
	public static function sanitize($data,$format){
		if ($data==""){return false;}
		else{
			switch($format){
				case "email" : 
					$filter=FILTER_SANITIZE_EMAIL;
					break;
				case "login":
					$filter=FILTER_SANITIZE_STRING;
					break;
				case "string":
					$filter=FILTER_SANITIZE_STRING;
					break;
				default:
					$filter=FILTER_SANITIZE_STRING;
			}
			return filter_var($data, $filter);
		}
		
	}
	
}
?>
