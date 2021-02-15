<?php
/**
 * 
 */
require_once("ValidateCore.php");
require_once("./Model/InitDbase.php");
require_once("./Model/CreateModel.php");
//require_once("SessionControlCore.php");

class UserRegisterCore extends ValidateCore implements InitDbase, CreateModel
{
	//declare strict type:
	declare(strict_types = 1); 
	//function __construct(argument){}	
	private $_firstName;
	private $_lastName;
	private $_phoneNumber;

	private $_email;
	private $_username;
	private $_password;


	//setters and getters:
	protected function setFirstName($firstName){
		this->$_firstName = $firstName;
	}

	protected function getFirstName(): String{
		return validate($_firstName);
	}



	protected function setLastName($lastName){
		this->$_lastName = $lastName;
	}

	protected function getLastName(): String{
		return validate($_lastName);
	}



	protected function setPhoneNumber($phoneNumber){
		this->$_phoneNumber = $phoneNumber;
	}

	protected function getPhoneNumber(): Integer{
		return validate($_phoneNumber);
	}	
	


	protected function setEmail($email){
		this->$_email = $email;
	}

	protected function getEmail(): String{
		return validate($_email);
	}



	protected function setUserName($userName){
		this->$_userName = $userName;
	}

	protected function getUserName(): String{
		return validate($_userName);
	}	

	protected function setPassword($password){
		this->$_password = $password;
	}

	protected function getPassword(): String{
		return validate($_password);
	}	

	public function getPasswordHash(): String{
		$password = this->getPassword(); 
		//sets password hash
		return password_hash($password, PASSWORD_DEFAULT);
	}
		
	//Save User Details:
	//$userTable, $firstName, $lastName, $phoneNumber, $email, $username, $password
	public function registerUser($localhost, $db_name, $db_username, $db_password, 
		$userTable,
		$firstNameN, $firstNameV, 
		$lastNameN, $lastNameV,  
		$phoneNumberN, $phoneNumberV, 
		$emailN, $emailV, 
		$usernameN, $usernameV, 
		$passwordN, $paswwordV):bool
	{
		//initialize the database:
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){
			//create table and entity models in Dbase:
			createModel($userTable, $firstNameN, $firstNameV);
			createModel($adminTable, $lastNameN, $lastNameV);
			createModel($adminTable, $phoneNumberN, $phoneNumberV);
			createModel($adminTable, $emailN, $emailV);
			createModel($adminTable, $usernameN, $usernameV);
			createModel($adminTable, $passwordN, $passwordV);

			return true;
		}
	}
}
?>