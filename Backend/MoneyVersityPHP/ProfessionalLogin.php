<?php
namespace Backend;

require_once("Core/AuthenticateCore.php");
require_once("Core/UserRegisterCore.php");
//require_once("Backend/Core/AdminCore.php");

final class ProfessionalLogin{

	public function __construct(){
		//run the function below by default immediately this class is invoked:
		professionalLogin();
	}

	final public function professionalLogin(){

		//User Column Name to read:
		$userNameN = "Username";		
		$emailN = "Email";
		$passwordN = "Password";
		$firstNameN = "FirstName";
		$lastNameN = "LastName";
		$phoneNumberN = "PhoneNumber";
		$speciality = "Speciality";

		//Admin Table Name:
		//$adminTableName = "Admin";

		//now get the parameters to be sent from the frontend:
		$username = $_POST["username"];
		$password = $_POST["password"];

		//set new value states:
		AuthenticateCore::setSuppliedUserName($username);
		UserRegisterCore::setPassword($password);

		try{
			//from User table:
			$loginUser = AuthenticateCore::loginUser(
				$userNameN, UserRegisterCore::getUserName(), 
				$passwordN, UserRegisterCore::getPasswordHash()
			);

			//begin to structure the response format:
			$resp = array();
			$resp["serverStatus"] = "Found";
			$resp["firstname"] = $loginUser[$firstNameN];
			$resp["lastname"] = $loginUser[$lastNameN];
			$resp["email"] = $loginUser[$emailN];
			$resp["username"] = $loginUser[$emailN];
			$resp["phoneNumber"] = $loginUser[$phoneNumberN];
			$resp["speciality"] = $loginUser[$speciality];

			//success response:
			echo json_encode($resp);
		}catch($ex){
			$resp = array("serverStatus":"notFound");
			echo json_encode($resp);
		}
	}	
}

new ProfessionalLogin;
?>