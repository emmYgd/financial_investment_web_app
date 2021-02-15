<?php
require_once("Backend/Transactions/DepositTransactionCore.php");
//require_once("Backend/Core/SessionControlCore.php");

//instantiate the class:
$depositTransaction = new DepositTransactionCore;
//$userSession = new SessionControlCore;

//note the constants:
//$adminEmail = "moneyvarsity@gmail.com";
$localhost = "localhost";
$db_name = "";
$db_username = ""; 
$db_password = "";

$userTable = "User";

$sessionN = "UserSession";

//default status column name and value:
$statusN = "InvestStatus";
$statusV = "transactionPending";//default status value...

//Default Column names:
$paymentPlanN = "PaymentPlan";
$depositStatusN = "DepositStatus";
$depositAccount_WalletNameN = "DepositWalletOrAccount";
$depositAmountN  = "DepositAmount";
$depositDayN = "DepositDay";
$depositMonthN = "DepositMonth";
$depositYearN = "DepositYear";

$depositHourN = "DepositHour";
$depositMinuteN = "DepositMinute";


//now get the parameters to be sent from the frontend:
$paymentPlan = $_POST["paymentPlan"];
$paymentAccount_WalletName = $_POST["paymentAccount_Walletname"];
$paymentAmount = $_POST["payAmount"];

$paymentDay = $_POST["payDay"];
$paymentMonth = $_POST["payMonth"];
$paymentYear = $_POST["payYear"];

$paymentHour = $_POST["payHour"];
$paymentMinute = $_POST["payMinute"];


//set new value states:

$depositTransaction->setDepositOwner($sessionN);
$depositTransaction->setpaymentPlan($paymentPlan);
$depositTransaction->setDepositStatus($statusV);

$depositTransaction->setDepositAccount_WalletName($paymentAccount_WalletName);
$depositTransaction->setDepositAmount($paymentAmount);


$depositTransaction->setDepositDay($paymentDay);
$depositTransaction->setDepositMonth($paymentMonth);
$depositTransaction->setDepositYear($paymentYear);

$depositTransaction->setDepositHour($paymentHour);
$depositTransaction->setDepositMinute($paymentMinute);


try{
	//create and store the respective values:
	$updateDepositDetails = $depositTransaction->createTransactionEntry($localhost, $db_name, $db_username, $db_password,
			$userTable, $depositOwnerN, $depositTransaction->getDepositOwner(), 
			$paymentPlanN, $depositTransaction->getPaymentPlan(),  
			$depositStatusN, $depositTransaction->getDepositStatus(), 

			$depositAccount_WalletN, $depositTransaction->getDepositAccount_WalletName(), 
			$depositAmountN, $depositTransaction->getDepositAmount(), 

			$depositDayN, $depositTransaction->getDepositDay(), 
			$depositMonthN, $depositTransaction->getDepositMonth(), 
			$depositYearN, $depositTransaction->getDepositYear(),

			$depositHourN, $depositHour->getDepositHour(), 
			$depositMinute, $depositMinute->getDepositMinute()
		);

	//start structuring the response format:
	$resp = array();
	$resp[$statusN] = $statusV;

	$resp[$daysRemaining] = 0;

	//success response:
	echo json_encode($resp);

}catch($ex){
	$resp = array("status":"notFound");
	echo json_encode($resp);
}

?>