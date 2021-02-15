<?php

//declare strict type:
declare(strict_types = 1); 

//require_once("AdminCore.php");
require_once("ValidateCore.php");
/*require_once("./Model/InitDbase.php");
require_once("./Model/CreateModel.php");
require_once("./Model/UpdateModel.php");*/


	function getHeaders($email){
		//Add header contents:
		$headers = "From:". $email . "\r\n";
		return $headers;
	}
	
	function getMessageWithOtherEssentials($fullName, $position, $orgName, $message, $webPresence){
		$fullNameWithPosition = $fullName . "\n" .$position;
		$messageWithOtherEssentials = $fullNameWithPosition . "\n" . $orgName . "\n" . $message . "\n" . $webPresence;
		return $messageWithOtherEssentials;
	}

	function sendEmail($adminEmail, $subject, $getMessageWithOtherEssentials, $getHeaders)
	{
		//call the mail function:
		mail($adminEmail, $subject, $getMessageWithOtherEssentials, $getHeaders);
	}

	//The implementation will be both new and total messages:
	/*protected function messagesCountSave($localhost, $db_name, $db_username, $db_password,
		$adminTable, string $total_new_message_count, $count_value):bool
	{
		//initialize the database:
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){
			//create table and entity models in Dbase:
			$tableCreated = createModel($adminTable, $total_new_message_count, $count_value);
			if($tableCreated){
				AdminUpdateModel($adminTable, $total_new_message_count,$count_value);
				return true;
			}
		}
	}*/
?>