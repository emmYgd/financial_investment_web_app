<?php

require_once("ValidateCore.php");
require_once("InitDbase.php");
require_once("CreateModel.php");
require_once("Model/ReadModel.php");

class HistoryCore extends WithdrawalCore implements ValidateCore, InitDbase, ReadModel, CreateModel{
	
	//declare strict type:
	declare(strict_types = 1); 

	//function __construct(argument){}	
	private $_depositHistory;
	private $_withdrawalHistory;

	//setters and getters:
	protected function setDepositHistory(String $depositHistory){
			this->$_depositHistory = $depositHistory;
	}

	protected function getDepositHistory(): String{
		return validate($_depositHistory);
	}



	protected function setWithdrawalHistory($withdrawalHistory){
		this->$_withdrawalHistory = $withdrawalHistory;
	}

	protected function getWithdrawalHistory(): String{
		return validate($_withdrawalHistory);
	}

	/*inherits:
		from DepositTransCore:
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
					$depositMinute, $depositMinute):bool;

	from WithdrawTransCore:
	protected function createAccount_WalletEntry($localhost, $db_name, $db_username, $db_password,
		$userTable, $withdrawalOwnerN, $withdrawalOwnerV, 
		$userBitCoinAddressN, $userBitCoinAddressV, 
		$userEthereumAddressN, $userEthereumAddressV, 
		$userBitcoinCashAddressN, $userBitcoinCashAddressV,
		$userPerfectMoneyAccountN, $userPerfectMoneyAccountV
	):bool
	*/

	//for every transaction, create a database entry called Deposit History and Withdrawal History:
	protected function historyCreate($tablename, $sessionNameN, $sessionNameV, $depositTransN, $depositTransV):Bool{

		//initialize the database:
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){
			createModelAtUsernameWithoutDelete($tablename, $sessionNameN, $sessionNameV, $depositTransN, $depositTransV);
			return true;
		}		
	}

	//first get the session name;
	//getCurrentSessionName($paramN);

	//then:

	//start reading dbase deposit entries of this username:
	protected function getDepositHistory($localhost, $db_name, $db_username, $db_password, $tablename, $sessionNameN, $sessionNameV, $depositHistoryN): String{
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){
			//read all concerning this user:
			$readAll = readAllBeansOfParamName($tablename, $sessionNameN, $sessionNameV);
			return filterDeposit($readAll, $depositHistoryN);
		}
	}

	//start reading dbase withdraw entries of this username:
	protected function getWithdrawalHistory($tablename, $sessionNameN, $sessionNameV, $withdrawHistoryN):String {
		//read all concerning:
		$readAll = readAllBeansOfUsername($tablename, $sessionNameN, $sessionNameV);
		return filterWithdrawal($readAll, $withdrawHistoryN);
	}

	protected function filterDeposit($readParam, $depositHistoryN){
		if(!empty($readParam){
			//create an empty array
			//$depositArray = array();
			$depositInfo = $readParam[$depositHistoryN];
			return $depositInfo;
		}
	}

	protected function filterWithdrawal($readParam, $withdrawHistoryN){
		if(!empty($readParam){
			//create an empty array
			//$withdrawArray = array();
			$withdrawInfo = $readParam[$withdrawHistoryN];
			return $withdrawInfo;
		}
	}
}
?>