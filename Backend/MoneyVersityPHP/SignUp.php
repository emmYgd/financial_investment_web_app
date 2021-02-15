<?php
namespace Backend;
	
require_once("Core/UserRegisterCore.php");
	 
final class SignUp{
	
	public function __construct(){
		//run the function below by default immediately this class is invoked:
		signUp();
	}

	//note the constants:
	/*$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";*/

	final public function signUp{
		//Name for the rows in the database:
		$userTableName = "User";
		$firstName = "FirstName";
		$lastNameN = "LastName";
		$phoneNumberN = "PhoneNumber";
		$emailN = "Email";
		$passwordN = "Password";
		$babyCount = "BabyCount";

		//now get the parameters to be sent from the frontend:
		$firstNameV = $_POST["firstName"];
		$lastNameV = $_POST["lastName"];
		$phoneNumberV = $_POST["phoneNumber"];
		$emailV = $_POST["email"];
		$usernameV = $_POST["uname"];
		$passwordV = $_POST["pass"];
		$babyCount = $_POST["babyCount"];

		//set new value states:
		UserRegisterCore::setFirstName($firstNameV);
		UserRegisterCore::setLastName($lastNameV);
		UserRegisterCore::setPhoneNumber($phoneNumberV);
		UserRegisterCore::setEmail($emailV);
		UserRegisterCore::setUserName($usernameV);
		UserRegisterCore::setPassword($passwordV);
		UserRegisterCore::setBabyCount($babyCount);

		try{
			$registerUser = UserRegisterCore::registerUser($userTableName, 
				$firstNameN, UserRegisterCore::getFirstName(), 
				$lastNameN, UserRegisterCore::getLastName(), 
				$phoneNumberN, UserRegisterCore::getPhoneNumber(),  
				$emailN, UserRegisterCore::getEmail(), 
				$usernameN, UserRegisterCore::getUsername(), 
				$passwordN, UserRegisterCore::getPasswordHash(),
				$babyCount, UserRegisterCore::getBabyCount()
			)

			if($registerUser){
				echo json_encode(["serverStatus":"RegisterSuccess"]);
			}
		}catch($ex){
			echo json_encode(["serverStatus":"RegisterFail"]);
		}
	}
}

	//instantiate the new class:
	new SignUp;
?>