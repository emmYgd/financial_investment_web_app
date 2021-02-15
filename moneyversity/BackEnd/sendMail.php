<?php
	require_once("Core/SendMailCore.php");
	require_once("Core/ValidateCore.php");

	function sendUserMail($adminEmail){

		//now get the parameters to be sent from the frontend:
		$fullName = $_POST["fName"];
		$orgName = $_POST["oName"];
		$position = $_POST["pos"];
		$webPresence = $_POST["webPr"];
		$email = $_POST["mail"];
		$subject = $_POST["sub"];
		$message = $_POST["mess"];

		//get message formats:
		$headers = getHeaders($email, $orgName);
		$messageWithOthers = getMessageWithOtherEssentials($fullName, $position, $orgName, $message, $webPresence);
		
		$emailSent = sendEmail($adminEmail, $subject, $headers, $messageWithOthers, $headers);

		if($emailSent){
			echo "success";
		}else{
			echo "error";
		}
	}

	//set constant:
	$adminEmail = "moneyvarsity@gmail.com";

	//call the function:
	sendUserMail($adminEmail);

?>