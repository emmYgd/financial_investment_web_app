<?php
require_once("DepositTransactionCore.php");

	class WithdrawalTransactionCore extends DepositTransactionCore{
		
		//declare strict type:
		declare(strict_types = 1); 

		//function __construct(argument){}	
		private $_withdrawalOwner;
		private $_withdrawalAmount;
		

		private $_withdrawalDueDate;
		private $_withdrawalTime;

		private bool $_pending;
		private bool $_approved;

		private $_userBitCoinAddress;
		private $_userEthereumAddress;
		private $_userBitcoinCashAddress;
		private $_userPerfectMoneyAccount;

		//setters and getters:
		protected function setWithdrawalOwner(String $withdrawalOwner){
			this->$_withdrawalOwner = $withdrawalOwner;
		}

		protected function getWithdrawalOwner(): String{
			return validate($_withdrawalOwner);
		}	

		
		protected function setWithdrawalAmount(int $withdrawalAmount){
			this->$_withdrawalAmount = $withdrawalAmount;
		}

		protected function getWithdrawalAmount(): int{
			return validate($_withdrawalAmount);
		}	



		protected function setWithdrawalDueDate($withdrawalDueDate){
				this->$_withdrawalDueDate = $withdrawalDueDate;
		}

		protected function getWithdrawalDueDate(): {
			return validate($_withdrawalDueDate);
		}	


		protected function setWithdrawalTime($withdrawalTime){
			this->$_withdrawalTime = $withdrawalTime;
		}

		protected function getWithdrawalTime(){
			return validate($_withdrawalTime);
		}	

		protected function setWithdrawalTime($withdrawalTime){
			this->$_withdrawalTime = $withdrawalTime;
		}

		protected function getWithdrawalTime(){
			return validate($_withdrawalTime);
		}	

		protected function setPending(bool $pending){
			this->$_pending = $pending;
		}

		protected function getPending(){
			return validate($_pending);
		}	

		protected function setApproved($approved){
			this->$_approved = $approved;
		}

		protected function getApproved(){
			return validate($_approved);
		}	

		protected function setUserBitCoinAddress($userBitCoinAddress){
			this->$_userBitCoinAddress = $userBitCoinAddress;
		}	

		protected function getUserBitCoinAddress(){
			return validate($_userBitCoinAddress);
		}


		protected function setUserEthereumAddress($userEthereumAddress){
			this->$_userEthereumAddress = $userEthereumAddress;
		}	

		protected function getUserEthereumAddress(){
			return validate($_userEthereumAddress);
		}	


		protected function setuserBitcoinCashAddress($userBitcoinCashAddress){
			this->$_userBitcoinCashAddress = $userBitcoinCashAddress;
		}	

		protected function getuserBitcoinCashAddress(){
			return validate($_userBitcoinCashAddress);
		}	


		protected function setUserPerfectMoneyAccount($userPerfectMoneyAccount){
			this->$_userPerfectMoneyAccount = $userPerfectMoneyAccount;
		}	

		protected function getuserPerfectMoneyAccount(){
			return validate($_userPerfectMoneyAccount);
		}	

		/*inherits methods:
			getCurrentSessionName($paramN);
			createTransactionEntry($localhost, $db_name, $db_username, $db_password,
						$userTable, $depositOwnerN, $depositOwnerV, 
						$paymentPlanN, $paymentPlanV,  
						$depositStatusN, $depositStatusV, 
						$depositAccount_WalletN, $depositAccount_WalletV, 
						$depositAmountN, $depositAmountV, 
						$depositDayN, $depositDayV, 
						$depositMonthN, $depositMonthV, 
						$depositYearN, $depositYearV,
						$depositHourN, $depositHourN, 
						$depositMinute, $depositMinute);
		*/

		protected function createAccount_WalletEntry($localhost, $db_name, $db_username, $db_password,
			$userTable, $withdrawalOwnerN, $withdrawalOwnerV, 
			$userBitCoinAddressN, $userBitCoinAddressV, 
			$userEthereumAddressN, $userEthereumAddressV, 
			$userBitcoinCashAddressN, $userBitcoinCashAddressV,
			$userPerfectMoneyAccountN, $userPerfectMoneyAccountV
		):bool
		{
			//find the username having the current session:
			$userExists = userReadModelOne($userTable, $withdrawalOwnerN, $withdrawalOwnerV);

			if($userExists != null){

				//then create model rows at this point:  
				createModelAtUsername($userTable, $withdrawalOwnerN, $withdrawalOwnerV, $userBitCoinAddressN, $userBitCoinAddressV); //where username

				createModelAtUsername($userTable, $withdrawalOwnerN, $withdrawalOwnerV, $userEthereumAddressN, $userEthereumAddressV); //where username

				createModelAtUsername($userTable, $withdrawalOwnerN, $withdrawalOwnerV, $userBitCoinCashAddressN, $userBitCoinCashAddressV); //where username

				createModelAtUsername($userTable, $withdrawalOwnerN, $withdrawalOwnerV, $userPerfectMoneyAccountN, $userPerfectMoneyAccountV); //where username\

				return true
		}

	}
?>