<?php
	require_once("Backend/Core/SendMailCore.php");
	
	//instantiate the class:
	$sendMailEngine = new SendMailCore;

	//note the constants:
	$adminEmail = "moneyvarsity@gmail.com";
	$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";

	$admin_table = "Admin";



	//now get the parameters to be sent from the frontend:
	$fullName = $_POST["fName"];
	$orgName = $_POS["oName"];
	$position = $_POST["pos"];
	$webpresence = $_POST["webPr"];
	$email = $_POST["mail"];
	$subject = $_POST["sub"];
	$message = $_POST["mess"];

	//set new value states:
	$sendMailEngine->setFullName($fullName);
	$sendMailEngine->setOrgName($orgName);
	$sendMailEngine->setPosition($position);
	$sendMailEngine->setWebPresence($webPresence);
	$sendMailEngine->setEmail($fullName);
	$sendMailEngine->setSubject($subject);
	$sendMailEngine->setMessage($message);

	//init count for messages:
	$newMessageCount = 0;
	$totalMessages = 0;
	$sendMailEngine->$setNewMessageCount($newMessageCount);
	$sendMailEngine->$setTotalMessageCount($newTotalCount);


	//get message formats:
	$subject = $sendMailEngine.getEmail();
	$getHeaders = $sendMailCore.getHeaders();
	$fullNameWithPosition = $sendMailCore.getFullNameWithPosition();
	$getMessageWithOtherEssentials = $sendMailCore.getMessageWithOtherEssentials($adminEmail);


	try{
		$emailSent = sendEmail($adminEmail, $subject, $getHeaders, $getMessageWithOtherEssentials);
		if($emailSent){
			//update the count values:
			$updatedNewMessageValue = $newMessageCount++;
			$sendMailEngine->$setNewMessageCount($updatedNewMessageValue);
			$sendMailEngine->$setTotalMessageCount($updatedNewMessageValue);

			

			//record this in the database:
			$newMessagesSave = messagesCountSave($localhost, $db_name, $db_username, $db_password,
										$adminTable,"GmailMessagesNew", 
										$sendMailEngine->$getNewMessageCount());

			$totalMessagesSave = messagesCountSave($localhost, $db_name, $db_username, $db_password,
										$adminTable,"GmailMessagesTotal", 
										$sendMailEngine->$getTotalMessageCount());
			echo "success";
		}
	}catch($ex){
		echo "error";
	}
?>