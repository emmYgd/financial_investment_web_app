<?php
namespace Backend;
	
require_once("Core/UserRegisterCore.php");
	 
final class ProfessionalSignUp{
	
	public function __construct(){
		//run the function below by default immediately this class is invoked:
		professionalSignUp();
	}

	//note the constants:
	/*$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";*/

	final public function professionalSignUp(){
		//Name for the rows in the database:
		//$userTableName = "User";
		$firstName = "FirstName";
		$lastNameN = "LastName";
		$phoneNumberN = "PhoneNumber";
		$emailN = "Email";
		$passwordN = "Password";
		$speciality = "Speciality";

		//now get the parameters to be sent from the frontend:
		$firstNameV = $_POST["firstName"];
		$lastNameV = $_POST["lastName"];
		$phoneNumberV = $_POST["phoneNumber"];
		$emailV = $_POST["email"];
		$usernameV = $_POST["uname"];
		$passwordV = $_POST["pass"];
		$specialityV = $_POST["speciality"];
		//$babyCount = $_POST["babyCount"];

		//set new value states:
		UserRegisterCore::setFirstName($firstNameV);
		UserRegisterCore::setLastName($lastNameV);
		UserRegisterCore::setPhoneNumber($phoneNumberV);
		UserRegisterCore::setEmail($emailV);
		UserRegisterCore::setUserName($usernameV);
		UserRegisterCore::setPassword($passwordV);
		UserRegisterCore::setSpeciality($speciality);

		try{
			$registerUser = UserRegisterCore::registerUser( 
				$firstNameN, UserRegisterCore::getFirstName(), 
				$lastNameN, UserRegisterCore::getLastName(), 
				$phoneNumberN, UserRegisterCore::getPhoneNumber(),  
				$emailN, UserRegisterCore::getEmail(), 
				$usernameN, UserRegisterCore::getUsername(), 
				$passwordN, UserRegisterCore::getPasswordHash()
				$specialityN, UserRegisterCore::getSpeciality();
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
	new ProfessionalSignUp;
?>