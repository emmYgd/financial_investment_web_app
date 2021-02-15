<?php
	require_once("SessionControlCore.php");
	require_once("ValidateCore.php");
	
	require_once("Model/InitDbase.php");
	require_once("Model/CreateModel.php");
	require_once("Model/ReadModel.php");

	class DepositTransactionCore implements ValidateCore, InitDbase, CreateModel{
		use(SessionControlCore);
		//declare strict type:
		declare(strict_types = 1); 

		//function __construct(argument){}	
		//private $_userImage;
		private $_paymentPlan;
		private string $_depositOwner;
		private $_depositAccount_WalletName;
		private $_depositAmount;

		private $_depositDay;
		private $_depositMonth;
		private $_depositYear;

		private $_depositHour;
		private $_depositMinute;

		private $_depositStatus;//approved or withdraw:

		//setters and getters:
		/*protected function setUserImage($investmentOwner){
				this->$_userImage = $userImage;
		}

		protected function getUserImage(){
			return $_userImage;
		}*/

		protected function setPaymentPlan($paymentPlan){
			$_paymentPlan = $paymentPlan;
		}

		protected function getPaymentPlan(){
			return validate($_paymentPlan);
		}

		protected function setDepositOwner(string $depositOwner){
			$depositOwner = getCurrentSession($depositOwner);
			this->$_depositOwner = $depositOwner;
		}

		protected function getDepositOwner():String{
			return validate($_depositOwner);
		}


		protected function setDepositAccount_WalletName(string $depositAccount_WalletName){

			this->$_depositAccount_WalletName = $depositAccount_WalletName;
		}

		protected function getDepositAccount_WalletName():String{
			return validate($_depositAccount_WalletName);
		}



		protected function setDepositAmount(string $depositAmount) : String{
				this->$_depositAmount = $depositAmount;
		}

		protected function getDepositAmount(){
			return validate($_depositAmount);
		}


		protected function setDepositDay($depositDay){
				this->$_depositDay = $depositDay;
		}

		protected function getDepositDay(){
			return validate($_depositDay);
		}


		
		protected function setDepositMonth($depositMonth){
				this->$_depositMonth = $depositMonth;
		}

		protected function getDepositMonth(){
			return validate($_depositMonth);
		}


		protected function setDepositYear($depositYear){
				this->$_depositYear = $depositYear;
		}

		protected function getDepositYear(){
			return validate($_depositYear);
		}

		protected function setDepositHour($depositHour){
				this->$_depositHour = $depositHour;
		}

		protected function getDepositHour(){
			return validate($_depositHour);
		}

		protected function setDepositMinute($depositMinute){
				this->$_depositMinute = $depositMinute;
		}

		protected function getDepositMinute(){
			return validate($_depositMinute);
		}


		protected function setDepositStatus($depositStatus){
				this->$_depositStatus = $depositStatus;
		}

		protected function getDepositStatus(){
			return validate($_depositStatus);
		}

		protected function getCurrentSessionName($paramN){
			$sessionVar = getCurrentSession($paramName);
			return $sessionVar;
		}

		protected function createTransactionEntry($localhost, $db_name, $db_username, $db_password,
			$userTable, $depositOwnerN, $depositOwnerV, 
			$paymentPlanN, $paymentPlanV,  
			$depositStatusN, $depositStatusV, 
			$depositAccount_WalletN, $depositAccount_WalletV, 
			$depositAmountN, $depositAmountV, 
			$depositDayN, $depositDayV, 
			$depositMonthN, $depositMonthV, 
			$depositYearN, $depositYearV,
			$depositHourN, $depositHourV, 
			$depositMinuteN, $depositMinuteV):bool
		{
			//initialize the database:
			$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
			if($initDbase){
				//find the username having the current session:
				$userExists = userReadModelOne($userTable, $depositOwnerN, $depositOwnerV);

				if($userExists != null){

					//then create model rows at this point:  
					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV, $paymentPlanN, $paymentPlanV);//where username

					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV, $depositAccount_WalletN, $depositAccoVnt_WalletV);

					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV, $depositStatusN, $depositStatusV);

					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV,$depositAmountN, $depositAmountV);

					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV, $depositDayN, $depositDayV);

					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV, $depositMonthN, $depositMonthV);
					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV, $depositYearN, $depositYearV);
					createModelAtUsername($userTable, $depositOwnerName, $depositOwnerV, $depositHourN, $depositHourV);

					return true;
				}

				
			}
		}

	}
?>