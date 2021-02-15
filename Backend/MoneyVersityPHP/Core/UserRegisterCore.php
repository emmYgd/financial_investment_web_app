<?php
namespace Backend\Core;

require_once("Dbconstants.php");
require_once("ValidateCore.php");
require_once("Backend/Model/InitDbase.php");
require_once("Backend/Model/CreateModel.php");
//require_once("SessionControlCore.php");

class UserRegisterCore extends Dbconstants
{
	use ValidateCore;
	use InitDbase;
	use CreateModel;

	//db constants:
	$localhost = parent::getLocalHost();
	$dbname = parent::getDbname();
	$db_username = parent::getDbusername();
	$db_password = parent::getDbpassword();

	
	private $_firstName;
	private $_lastName;
	private $_phoneNumber;

	private $_email;
	private $_username;
	private $_password;

	private $_babyCount;
	private $_speciality;


	//setters and getters:
	protected function setFirstName($firstName){
		this::$_firstName = $firstName;
	}

	protected function getFirstName(): String{
		return validate($_firstName);
	}

	protected function setLastName($lastName){
		this::$_lastName = $lastName;
	}

	protected function getLastName(): String{
		return validate($_lastName);
	}



	protected function setPhoneNumber($phoneNumber){
		this::$_phoneNumber = $phoneNumber;
	}

	protected function getPhoneNumber(): Integer{
		return validate($_phoneNumber);
	}	
	


	protected function setEmail($email){
		this::$_email = $email;
	}

	protected function getEmail(): String{
		return validate($_email);
	}



	protected function setUserName($userName){
		this::$_userName = $userName;
	}

	protected function getUserName(): String{
		return validate($_userName);
	}	

	protected function setPassword($password){
		this::$_password = $password;
	}

	protected function getPassword(): String{
		return validate($_password);
	}	

	public function getPasswordHash(): String{
		$password = this::getPassword(); 
		//sets password hash
		return password_hash($password, PASSWORD_DEFAULT);
	}

	public function setBabyCount($babyCount){
		this::$_babyCount = $babyCount;
	}

	public function getBabyCount(){
		return validate($_babyCount);
	}

	public function setSpeciality($speciality){
		this::$_spaeciality = $speciality;
	}

	public function getSpeciality(){
		return validate($speciality);
	}

	//Save User Details:
	//$userTable, $firstName, $lastName, $phoneNumber, $email, $username, $password
	public function registerUser($userTable,
		$firstNameN, $firstNameV, 
		$lastNameN, $lastNameV,  
		$phoneNumberN, $phoneNumberV, 
		$emailN, $emailV, 
		$usernameN, $usernameV, 
		$passwordN, $paswwordV
		$categoryVarN, $categoryVarV):bool
	{
		//initialize the database:
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){
			//create table and entity models in Dbase:
			createModel($userTable, $firstNameN, $firstNameV);
			createModel($userTable, $lastNameN, $lastNameV);
			createModel($userTable, $phoneNumberN, $phoneNumberV);
			createModel($userTable, $emailN, $emailV);
			createModel($userTable, $usernameN, $usernameV);
			createModel($userTable, $passwordN, $passwordV);
			createModel($userTable, $categoryVarN, $categoryVarV);
			return true;
		}
	}
}
?>