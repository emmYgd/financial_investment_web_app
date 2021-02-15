<?php

namespace Backend\Core;

require_once("ValidateCore.php");
require_once("Dbconstants.php");
require_once("Model/InitDbase.php");
require_once("Model/ReadModel.php");

class AuthenticateCore extends Dbconstants
{
	use("SessionControlCore.php");
	use(ValidateCore);
	use("InitDbase");
	use("ReadModel");

	//db constants:
	$localhost = parent::getLocalHost();
	$dbname = parent::getDbname();
	$db_username = parent::getDbusername();
	$db_password = parent::getDbpassword();

	private $_suppliedUserName;
	private $_suppliedPassword;

	//setters and getters:
	protected function setSuppliedUserName($suppliedUsername){
		this::$_suppliedUserName = $suppliedUsername;
	}

	protected function getSuppliedUserName(): string{
		return validate($_suppliedUserName);
	}

	protected function setSuppliedPassword($password){
		this::$_suppliedPassword = $password;
	}

	protected function getSuppliedPassword(): string{
		return validate($_suppliedPassword);
	}	

	protected function getSuppliedPasswordHash(): string{
		$password = this::getSuppliedPassword(); 
		//sets password hash
		return password_hash($password, PASSWORD_DEFAULT);
	}

	//Check User Details:
	public function loginUser($userTable, 
		$loginParamN, $loginParamV, 
		$passwordN, $passwordV
	):bool
		{
			//initialize the database:
			$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
			if($initDbase){
				//read table and entity models in Dbase:

				//first check out the username:	
				$entryFoundUname = userReadModel($userTable, $loginParamN, $loginParamV);

				//check out the password too:
				$entryFoundPass = userReadModel($userTable, $passwordN, $passwordV);

				//check them out with logic:
				if(($entryFoundUName != null) && ($entryFoundPass != null)){

					//put the current user in session:
					ensureUserSession($loginParamN, $loginParamV);

					//encode the returned bean in a json format:
					//$entryFoundUName = json_encode($entryFoundUName);

					return $entryFoundUName;
					
				}
			}
		}
		

		public function ensureUserSession($paramName, $paramValue){
			$sessionStatus = getStatus();
			$startsession = startSession($sessionStatus);
			setAsSessionVariable(string $paramName, $paramValue);
		}
	}


?>