<?php

	require_once("Backend/Core/AuthenticateCore.php");
	require_once("Backend/Core/UserRegisterCore.php");
	require_once("Backend/Core/AdminCore.php");

	//instantiate the class:
	$userLogin  = new AuthenticateCore;
	$userRegister = new UserRegisterCore;
	$adminFetch = new AdminCore;

	//note the constants:
	$localhost = "localhost";
	$db_name = "";
	$db_username = ""; 
	$db_password = "";

	//User Table Name:
	$userTableName = "User";

	//User Column Name to read:
	$userNameN = "Username";
	$emailN = "Email";
	$passwordN = "Password";
	$firstNameN = "FirstName";
	$lastNameN = "LastName";
	$phoneNumberN = "PhoneNumber";
	$planN = "Plan"
	$investCapitalN = "InvestCapital";
	$investStatusN = "InvestStatus";
	$daysRemainingN = "DaysRemaining";
	$userBitWalletN = "UserBitcoinWallet";
	$userEtherWalletN = "UserEthereumWallet";
	$userBitCoinCashN = "UserBitcoinCashWallet";
	$userPerfectMoneyN = "UserPerfectMoney";

	//Admin Table Name:
	$adminTableName = "Admin";

	//Admin Column Name to read:
	$adminBitWalletN = "AdminBitcoinWallet";
	$adminEtherWalletN = "AdminEthereumWallet";
	$adminBitCoinCashN = "AdminBitcoinCashWallet";
	$adminPerfectMoneyN = "AdminPerfectMoney";

	//now get the parameters to be sent from the frontend:
	$email_username = $_POST["uMail_uName"];
	$password = $_POST["pass"];

	//set new value states:
	$userLogin->setSuppliedEmailOrUserName($email_username);
	$userRegister->setPassword($password);

	$adminFetch->setBitCoinWallet($adminBitWalletN);
	$adminFetch->setEtherWallet($adminEtherWalletN);
	$adminFetch->setBitCoinCashWallet($adminBitCoinCashN);
	$adminFetch->setPerfectMoneyAccount($adminPerfectMoneyN);

	try{
		//from User table:
		$loginUser = $userLogin->loginUser($localhost, $db_name, $db_username, $db_password,
			$userTableName, $userNameN, $emailN, $userRegister->getSuppliedEmailOrUserName(), 
						$passwordN, $userRegister->getPasswordHash());

		//from Admin table:
		$adminData = $adminFetch->getAdminTransactionAccounts($localhost, $db_name, $db_username, $db_password, $adminTable);


		//begin to structure the response format:
		$resp = array();
		$resp["serverStatus"] = "Found";
		$resp["firstname"] = $loginUser[$firstNameN];
		$resp["lastname"] = $loginUser[$lastNameN];
		$resp["username"] = $loginUser[$emailN];
		$resp["phoneNumber"] = $loginUser[$phoneNumberN];

		$resp["plan"] = $loginUser[$planN];
		$resp["investCapital"] = $loginUser[$investCapitalN];
		$resp["investStatus"] = $loginUser[$investStatusN];
		$resp["daysRemaining"] = $loginUser[$daysRemainingN]; 

		$resp["userBitWallet"] = $loginUser[$userBitWalletN]; 
		$resp["userEtherWallet"] = $loginUser[$userEtherWalletN];
		$resp["userBitCoinCash"] = $loginUser[$userBitCoinCashN];
		$resp["userPerfectMoney"] = $loginUser[$userPerfectMoneyN]; 

		//get admin details from the dbase:
		$resp["adminBitWallet"] = $adminData[$adminBitWalletN];  
		$resp["adminEtherWallet"] = $adminData[$adminEtherWalletN]; 
		$resp["adminBitCoinCash"] = $adminData[$adminBitCoinCashN]; 
		$resp["adminPerfectMoney"] = $adminData[$adminPerfectMoneyN]; 

		//success response:
		echo json_encode($resp);

	}catch($ex){
		$resp = array("status":"notFound");
		echo json_encode($resp);
	}
?>