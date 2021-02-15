<?php
namespace Backend/Core;

require_once("Backend/Model/InitDbase.php");
require_once("Backend/Model/ReadModel.php");
require_once("ValidateCore.php");

class AdminCore{
	
	//function __construct(argument){}	
	private string $_adminName;
	private $_adminPassword;
	$_adminEmail = "";

	private string $_admin;

	protected function setadminPassword($adminPassword){
		this->$_adminPassword = $adminPassword;
	}

	protected function getAdminPassword(){
		return validate($_adminPassword);
	}

	protected function getAdminEmail(){
		return $_adminEmail;
	}
	
}
?
