<?php
require_once("Backend/Model/InitDbase.php");
require_once("Backend/Model/ReadModel.php");
require_once("Backend/Core/ValidateCore.php");

//can edit, post and fetch
class AdminCore implements ValidateCore, InitDbase, ReadModel{
	//declare strict type:
	declare(strict_types = 1); 

	//function __construct(argument){}	
	private string $_adminName;
	private $_adminPassword;//already stored in the database...may be more than one
	private $_adminEmail;

	private $_adminPost;


	private string $_admin;

	private $_adminBitCoinWallet;
	private $_adminEthereumWallet;
	private $_adminBitCoinCashWallet;
	private $_adminPerfectMoneyAccount;
	
	/*This should go to the transaction Table:
	private $_depositDate;
	private $_depositTime;
	*/

	//setters and getters:
	/*This should be in the user table...
	protected function setUserImage($investmentOwner){
			this->$_userImage = $userImage;
	}

	protected function getUserImage(){
		return $_userImage;
	}*/


	protected function setadminPassword($adminPassword){
			this->$_adminPassword = $adminPassword;
	}

	protected function getAdminPassword(){
		return validate($_adminPassword);
	}


	protected function setAdminEmail($adminEmail){
		this->$_adminEmail = $adminEmail;
	}

	protected function getAdminEmail(){
		return $_adminEmail;
	}

	/*protected function setAdminPost($adminPost){
		this->$_adminPost = $adminPost;
	}

	protected function getAdminPost(){
		return $_adminPost;
	}*/

	//This is used to set admin Account into which investment money is to be collected: 
	public function setAdminBitCoinWallet($adminBitCoinWallet){
		this->$_adminBitCoinWallet = $adminBitCoinWallet;
	}

	public function getAdminBitCoinWallet(){
		return $_adminBitCoinWallet;
	}

	public function setAdminEtherWallet($adminEtherWallet){
		this->$_adminEthereumWallet = $adminEthereumWallet;
	}

	public function getAdminEthereumWallet(){
		return $_adminEthereumWallet;
	}


	public function setAdminBitCoinCashWallet($adminBitCoinCashWallet){
		this->$_adminBitCoinCashWallet = $adminBitCoinCashWallet;
	}

	public function getAdminBitCoinCashWallet(){
		return $_adminBitCoinCashWallet;
	}


	/*public function setAdminPerfectMoneyAccount($adminPerfectMoneyAccount){
		this->$_adminPerfectMoneyAccount = $adminPerfectMoneyAccount;
	}

	public function getPerfectMoneyAccount(){
		return $_adminPerfectMoneyAccount;
	}*/

	public function getAdminTransactionAccounts($localhost, $db_name, $db_username, $db_password, $adminTable /*,$adminBitCoinWalletN, $adminEthereumWalletN, $adminBitCoinCashWalletN, $adminPerfectMoneyAccountN*/){
		//initialize the database:
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){
			//read table and entity models in Admin Dbase:

			//returns all beans as array in the admin table:	
			$entryFoundAdmin = adminReadModelTransAccount($adminTable);

			//check them out with logic:
			if(($entryFoundAdmin != null/*empty array*/)){
				return $entryFoundUName;
			}
		}
		
	}

	public function confirmAdminPresent($localhost, $db_name, $db_username, $db_password, $adminTable, 
		 $adminPassN, $adminPassV){ /*$adminNameN, $adminNameV,*/

		//read admin username and password:

		//initialize the database:
		$initDbase = setUp($localhost, $db_name, $db_username, $db_password);
		if($initDbase){
			//adminReadModelOne($adminTable, $adminNameN, $adminNameV);
			$entryFound = adminReadModelOne($adminTable, $adminPassN, $adminPassV);
			if(!empty($entryFound)){
				return true;
			}
		}
	}
	
}
?
