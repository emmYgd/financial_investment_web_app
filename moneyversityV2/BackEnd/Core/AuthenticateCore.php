<?php

/**
 * 
 */
require_once("ValidateCore.php");
require_once("./Model/InitDbase.php");
require_once("./Model/ReadModel.php");

class AuthenticateCore implements ValidateCore, InitDbase, ReadModel
{
	use("SessionControlCore.php");
	//declare strict type:
	declare(strict_types = 1); 
	
	private $_suppliedEmailOrUserName;
	private $_suppliedPassword;

	//setters and getters:
	protected function setSuppliedEmailOrUserName($suppliedEmailOrUsername){
		this->$_suppliedEmailOrUserName = $suppliedEmailOrUsername;
	}

	protected function getSuppliedEmailOrUserName(): string{
		return validate($_suppliedEmailOrUserName);
	}

	protected function setSuppliedPassword($password){
		this->$_Suppliedpassword = $password;
	}

	protected function getSuppliedPassword(): string{
		return validate($_Suppliedpassword);
	}	

	protected function getSuppliedPasswordHash(): string{
		$password = this->getSuppliedPassword(); 
		//sets password hash
		return password_hash($password, PASSWORD_DEFAULT);
	}

	//Check User Details:
	public function loginUser($localhost, $db_name, $db_username, $db_password,
			$userTable, $userNameN, $emailN, $email_usernameV, 
						$passwordN, $passwordV):bool
		{
			//initialize the database:
			$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
			if($initDbase){
				//read table and entity models in Dbase:

				//first check out the username:	
				$entryFoundUname = userReadModel($userTable, $userNameN, $email_usernameV);

				//check out the password too:
				$entryFoundPass = userReadModel($userTable, $passwordN, $passwordV);

				//check them out with logic:
				if(($entryFoundUName != null) && ($entryFoundPass != null)){

					//put the current user in session:
					ensureUserSession($userNameN, $email_usernameV);

					//encode the returned bean in a json format:
					//$entryFoundUName = json_encode($entryFoundUName);

					return $entryFoundUName;
					
				}else if($entryFoundUName == null){

					//check out the email if that fails:
					$entryFoundEmail = userReadModel($userName, $emailN, $email_usernameV);
					
					if(($entryFoundEmail != null) && ($entryFoundPass != null)){

						//put the current user in session:
						ensureUserSession($emailN, $email_usernameV);

						//encode the returned bean in a json format:
						//$entryFoundEmail = json_encode($entryFoundEmail);

						return $entryFoundEmail;
					}
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