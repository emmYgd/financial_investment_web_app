<?php

//The implementations will be final classes in future versions:

require_once("Backend/PasswordChangeCore.php");

//instantiate the class:
$passwordChange = new PasswordChangeCore;

//note the constants:
//$adminEmail = "moneyvarsity@gmail.com";
$localhost = "localhost";
$db_name = "";
$db_username = ""; 
$db_password = "";

$userTable = "User";

//$sessionN = "UserSession";

//Row name in database:
$usernameN = "Username";
$emailN = "Email";
$passwordN = "Password";

//get value from client side:
$email_username = $POST["uMail_uName"];
$newPass  = $POST["newPass"];

$passwordChange->setEmail_Username($email_username);
$passwordChange->setPassword($email_username);

try{

	//try this first:
	passChanged = changePassword($localhost, $db_name, $db_username, $db_password, $userTable,
			$usernameN, $passwordChange->getEmail_Username(),
			$passwordN, $passwordChange->getPassword());
	if (!passChanged){
		changePassword($localhost, $db_name, $db_username, $db_password, $userTable,
				$emailN, $passwordChange->getEmail_Username(),
				$passwordN, $passwordChange->getPassword());
	}

	//respond back to the client with response message:
	echo "passwordChanged";

}catch($ex){
	echo "passwordNotChanged";
}

?>