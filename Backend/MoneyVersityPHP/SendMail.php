<?php
namespace BackEnd;

require_once("Core/SendMailCore.php");

final class SendMail{

	public function __construct(){
		//run the function below by default immediately this class is invoked:
		sendMail();
	}

	
	final public function sendMail(){

		//note the constants:
		$adminEmail = "moneyvarsity@gmail.com";
		$localhost = "localhost";
		$db_name = "";
		$db_username = ""; 
		$db_password = "";

		$admin_table = "Admin";

		//now get the parameters to be sent from the frontend:
		$fullName = $_POST["fName"];
		$position = $_POST["pos"];
		$webpresence = $_POST["webPr"];
		$email = $_POST["mail"];
		$subject = $_POST["sub"];
		$message = $_POST["mess"];

		//set new value states:
		SendMailCore::setFullName($fullName);
		SendMailCore::setOrgName($orgName);
		SendMailCore::setPosition($position);
		SendMailCore::setWebPresence($webPresence);
		SendMailCore::setEmail($fullName);
		SendMailCore::setSubject($subject);
		SendMailCore::setMessage($message);


		//get message formats:
		$subject = SendMailCore::getEmail();
		$getHeaders = SendMailCore::getHeaders();
		$fullNameWithPosition = SendMailCore::getFullNameWithPosition();
		$getMessageWithOtherEssentials =SendMailCore::getMessageWithOtherEssentials($adminEmail);


		try{
			$emailSent = SendMailCore::sendEmail($adminEmail, $subject, $getHeaders, $getMessageWithOtherEssentials);
			if($emailSent){
				echo json_encode(["mailStatus":"mailSent"]);
			}
		}catch($ex){
			echo json_encode(["mailStatus":"mailError"]);;
		}
	}
}

new SendMail;
?>