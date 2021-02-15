<?php
//withdrawal transaction history:
//immediately begin polling the database:
require_once("BackEnd/Transactions/HistoryCore.php");

//instantiate the class:
$userWithdrawalHistory = new HistoryCore;

//note the constants:
//$adminEmail = "moneyvarsity@gmail.com";
$localhost = "localhost";
$db_name = "";
$db_username = ""; 
$db_password = "";

//set table constants for columns:
$userTable = "User";

$sessionN = "UserSession";
$withdrawalHistoryN = "WithdrawalHistory";

//first get this user session value:
$sessionV = $userWithdrawalHistory->getCurrentSessionName($sessionN);

try{
	$depositHistory = $userDepositHistory->getWithdrawalHistory($userTable, $sessionN, $sessionV, 
		$withdrawalHistoryN);

	if(!empty($withdrawalHistory)){
		echo($withdrawalHistory);
	}else{
		echo("noTranactions");
	}
	
}catch($ex){
	echo("dbReadError");
}

?>