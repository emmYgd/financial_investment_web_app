<?php
namespace Backend/Core;

require_once("ValidateCore.php");
require_once("UserRegisterCore.php");
require_once("Backend/Model/UpdateModel.php");

class PasswordCore extends UserRegisterCore 
{
	use ValidateCore;
	use UpdateModel;

	//db constants:
	$localhost = parent::getLocalHost();
	$dbname = parent::getDbname();
	$db_username = parent::getDbusername();
	$db_password = parent::getDbpassword();

	private $_email_username;

	//This is intentionally abstracted away from the password 
	//used in login and signup to portray the change password scenerio
	private $_newPassword;

	//for changePasswordMessage to be sent:
	private $_headers
	private $_subject;
	private $_message;
 
	//setters and getters:

	protected function setEmail_Username($email_username){
		this::$_email_username = $email_username;
	}

	protected function getEmail_Username(){
		return validate($_email_username);
	}

	protected function setNewPassword($newPassword){
		this::$_newPassword = $newPassword;
	}


	protected function getNewPassword(){
		return validate($_newPassword);
	}

	//if user email is found do this:
	protected function getHeaders():string{
		$headers = "From:"."<monieversity.com>";
		return $headers;
	}

	protected function getSubject():string{
		$subject = "Password Changed. This is your new password";
		return $subject;
	} 


	protected function setMessage($message){
		this::$_message = $message;
	}

	protected function getMessage(){
		return $message;
	}

	protected function changePassword($userTable,
		$email_usernameN, $email_usernameV,
		$passwordN, $passwordV)
	{
		//initialize the database:
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){

			//update table and entity models in Dbase:
			UserUpdateModel($userTable, $email_usernameN, $email_usernameV, 
				$passwordN, $passwordV);

			  return true;
		}
	}

}
?>

