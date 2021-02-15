<?php
require_once("Backend/Transactions/WithdrawalTransactionCore.php");
//instantiate the class:
$userWithdrawalAccountOrWallet = new WithdrawalCore;

//note the constants:
//$adminEmail = "moneyvarsity@gmail.com";
$localhost = "localhost";
$db_name = "";
$db_username = ""; 
$db_password = "";

//set table constants for columns:
$userTable = "User";

$sessionN = "UserSession";

$userBitCoinAddress = "UserBitcoinAddresss";
$userEthereumAddress = "UserEthereumAddress";
$userBitCoinCashAddress = "UserBitCoinCashAddress";
$userPerfectMoneyAddress = "UserPerfectMoneyAddress";


//now get the parameters to be sent from the frontend:
$currentUserBitCoinAddress = $_POST["userBit"];
$currentUserEthereumAddress = $_POST["userEther"];
$currentUserBitCoinCashAddress = $_POST["userBitCash"];
$currentUserPerfectMoneyAddress = $_POST["userPmoney"];

//set new value states:
$userWithdrawalAccountOrWallet->setCurrentUserBitCoinAddress($currentUserBitCoinAddress);
$userWithdrawalAccountOrWallet->setCurrentUserEthereumAddress($currentUserEthereumAddress);
$userWithdrawalTransAccountOrWallet->setCurrentUserBitCoinCashAddress($currentUserBitCoinCashAddress);
$userWithdrawalAccountOrWallet->setCurrentUserPerfectMoneyAddress($currentUserPerfectMoneyAddress);

try{
	//create and store the respective values:
	$updateUserAccount = $userWithdrawalTransAccountOrWallet->createAccount_WalletEntry($localhost, $db_name, $db_username, $db_password, $userTable, 
			$sessionN, 
			$userWithdrawalAccountOrWallet->getCurrentSessionName($sessionN), 

			$userBitCoinAddressN, 
			$userWithdrawalAccountOrWallet->getCurrentUserBitCoinAddress(),

			$userEthereumAddressN, 
			$userWithdrawalAccountOrWallet->getCurrentUserEthereumAddress(), 

			$userBitcoinCashAddressN, 
			$userWithdrawalTransAccountOrWallet->getCurrentUserBitCoinCashAddress(),

			$userPerfectMoneyAccountN, 
			$userWithdrawalAccountOrWallet->getCurrentUserPerfectMoneyAddress()
		);

	//start structuring the response format:
	$resp = array();

	if($updateUserAccount == true){
		$resp["userAccountStatus"] = "UpdateSuccessful";
		//start returning the accepted value:
		$resp["updatedUserBitWallet"] = $userWithdrawalAccountOrWallet->getCurrentUserBitCoinAddress();
		$resp["updatedUserEtherWallet"] = $userWithdrawalAccountOrWallet->getCurrentUserEthereumAddress();
		$resp["updatedUserBitCashWallet"] = 
									$userWithdrawalAccountOrWallet->getCurrentUserBitCoinCashAddress();
		$resp["updatedUserPerfectMoneyAccount"] = 
									$userWithdrawalAccountOrWallet->getCurrentUserPerfectMoneyAddress();


		//success response:
		echo json_encode($resp);
	}

}catch($ex){
	$resp = array("userAccountStatus":"UpdateError");
	echo json_encode($resp);
}

?>
?>