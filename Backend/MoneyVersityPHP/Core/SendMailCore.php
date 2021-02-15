<?php
namespace Backend\Core;

require_once("AdminCore.php");
require_once("ValidateCore.php");
require_once("Backend/Model/InitDbase.php");
require_once("Backend/Model/CreateModel.php");
require_once("Backend/Model/UpdateModel.php");

class SendMailCore extends AdminCore {

	use ValidateCore;
	use InitDbase;
	use CreateModel;
	use UpdateModel;

	private $_fullName;
	private $_orgName;
	private $_position;
	private $_webPresence;
	private $_email;
	private $_subject;
	private $_message;

	//setters and getters:
	protected function setFullName($fullName){
		this::$_fullName = $fullName;
	}

	protected function getFullName(){
		return validate($_fullName);
	}


	protected function setOrgName($orgName){
		this::$_orgName = $orgName;
	}

	protected function getOrgName(){
		return validate($_orgName);
	}


	protected function setPostion($position){
		this::$_position = $position;
	}

	protected function getPosition(){
		return validate($_position);
	}


	protected function setWebPresence($webPresence){
		this::$_webPresence = $webPresence;
	}

	protected function getWebPresence(){
		return $_webPresence;
	}


	protected function setEmail($email){
		this::$_email = $email;
	}

	protected function getEmail(){
		return validate($_email);
	}


	protected function setSubject($subject){
		this->$_subject = $subject;
	}

	protected function getSubject(){
		return validate($_subject); 
	}


	protected function setMessage($message){
		this::$_message = $message;
	}

	protected function getMessage(){
		return validate($_message); 
	}


	protected function getHeaders(){
		//Add header contents:
		$headers = "From:"."<".this->getEmail()."".this->getOrgName(). ">" . "\r\n";
		return $headers;
	}

	
	protected function getMessageWithOtherEssentials(){
		$fullNameWithPosition = this->getFullName() . "\n" . this->getPosition();
		$messageWithOtherEssentials = $fullNameWithPosition() .".\n" this->getMessage() . ".\n" . this::getWebPresence();
		return $messageWithOtherEssentials;
	}

	protected function sendEmail($adminEmail, $getsubject, $getMessageWithOtherEssentials, $getHeaders):bool
	{
		parent::setAdminEmail($adminEmail);

		$adminEmail = parent::getAdminEmail();
		//call the mail function:
		mail($adminEmail, $getSubject(), 
			$getMessageWithOtherEssentials, $getHeaders());
		return true;
	}
}
?>