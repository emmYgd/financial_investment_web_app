<?php
	require_once("Backend/Core/UserRegisterCore.php");
	 
	
	//instantiate the class:
	$userRegister = new UserRegisterCore;

	//note the constants:
	$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";

	//Name for the rows in the database:
	$userTableName = "User";
	$firstNameN = "FirstName";
	$lastNameN = "LastName";
	$phoneNumberN = "PhoneNumber";
	$emailN = "Email";
	$passwordN = "Password";

	//now get the parameters to be sent from the frontend:
	$firstNameV = $_POST["fName"];
	$lastNameV = $_POS["lName"];
	$phoneNumberV = $_POST["phoneNum"];
	$emailV = $_POST["uMail"];
	$usernameV = $_POST["uname"];
	$passwordV = $_POST["pass"];

	//set new value states:
	$userRegister->setFirstName($firstNameV);
	$userRegister->setLastName($lastNameV);
	$userRegister->setPhoneNumber($phoneNumberV);
	$userRegister->setEmail($emailV);
	$userRegister->setUserName($usernameV);
	$userRegister->setPassword($passwordV);

	try{
		$registerUser = $userRegister->registerUser($localhost, $db_name, $db_username, $db_password,
			$userTable, $firstNameN, $userRegister->getFirstName(), 
						$lastNameN, $userRegister->getLastName(), 
						$phoneNumberN, $userRegister->getPhoneNumber(), $userRegister->getEmail(), 
						$emailN, $userRegister->getUsername(), 
						$passwordN, $userRegister->getPasswordHash());

		if($registerUser){

			echo "success";
		}
	}catch($ex){
		echo "error";
	}
?>