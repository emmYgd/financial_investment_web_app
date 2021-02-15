<?php
//deposit transaction history:
//immediately begin polling the database:
require_once("BackEnd/Transactions/HistoryCore.php");

//instantiate the class:
$userDepositHistory = new HistoryCore;

//note the constants:
//$adminEmail = "moneyvarsity@gmail.com";
$localhost = "localhost";
$db_name = "";
$db_username = ""; 
$db_password = "";

//set table constants for columns:
$userTable = "User";

$sessionN = "UserSession";
$depositHistoryN = "DepositHistory";

//first get this user session value:
$sessionV = $userDepositHistory->getCurrentSessionName($sessionN);

try{
	$depositHistory = $userDepositHistory->getDepositHistory($userTable, $sessionN, $sessionV, 
		$depositHistoryN);

	if(!empty($depositHistory)){
		echo($depositHistory);
	}else{
		echo("noTranactions");
	}
	
}catch($ex){
	echo("dbReadError");
}

?>