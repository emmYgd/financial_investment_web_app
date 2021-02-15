<?php
namespace BackEnd;

//The implementations will be final classes in future versions:
require_once("Backend/PasswordChangeCore.php");

final public class ChangePassword{

	public function __construct(){
		//run the function below by default immediately this class is invoked:
		changePassword();
	}

	final public function changePassword(){

		//Row name in database:
		$usernameN = "Username";
		$emailN = "Email";
		$passwordN = "Password";

		//get value from client side:
		$username = $POST["userName"];
		$newPass  = $POST["newPassword"];

		PasswordCore::setUsername($username);
		PasswordCore::setPassword($newPass);

		try{
			//try this first:
			$passChanged = changePassword(
				$usernameN, PasswordChangeCore::getUsername(),
				$passwordN, PasswordChangeCore::getPassword()
			);

			//respond back to the client with response message:
			echo json_encode(["passwordChangeStatus":"passwordChanged"]);

		}catch($ex){
			echo json_encode(["passwordChangeStatus":"passwordNotChanged"]);
		}
	}
}

new ChangePassword;

?>