<?php

/**
 * 
 */

require_once("UserRegistration.php");
require_once("UpdateModel.php");

class PasswordChangeCore extends UserRegistration implements UpdateModel
{

	//declare strict type:
	declare(strict_types = 1); 

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
		this->$_email_username = $email_username;
	}

	protected function getEmail_Username(){
		return validate($_email_username);
	}

	protected function setNewPassword($newPassword){
		this->$_newPassword = $newPassword;
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
		this->$_message = $message;
	}

	protected function getMessage(){
		return $message;
	}

	protected function changePassword($localhost, $db_name, $db_username, $db_password, $userTable,
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

