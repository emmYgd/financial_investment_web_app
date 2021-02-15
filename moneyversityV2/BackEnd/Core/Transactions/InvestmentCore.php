<?php
class InvestmentCore{
	
	//declare strict type:
	declare(strict_types = 1); 

	//function __construct(argument){}	
	private $_investmentOwner;
	private $_investmentAmount;
	private $_potentialROI;

	private string $_investmentPlan;

	private bool $_pending;
	private bool $_approved;

	private $_userAccountNumber;

	//setters and getters:
	protected function setInvestmentOwner(String $investmentOwner){
			this->$_investmentOwner = $investmentOwner;
	}

	protected function getInvestmentOwner(): String{
		return $_investmentOwner;
	}


	protected function setInvestmentAmount($investmentAmount){
			this->$_investmentAmount = $investmentAmount;
	}

	protected function getInvestmentOwner(){
		return $_investmentAmount;
	}


	protected function setPotentialROI($potentialROI){
		this->$_potentialROI =$potentialROI;
	}

	protected function getPotentialROI(){
		return $_potentialROI;
	}


	protected function setInvestmentPlan(string $investmentPlan){
		this->$_investmentPlan = $investmentPlan;
	}

	protected function getInvestmentPlan():string{
		return $_investmentPlan;
	}


	protected function setPending(bool $pending){
			this->$_pending = $pending;
	}

	protected function getPending(){
		return $_pending;
	}	

	protected function setApproved($approved){
		this->$_approved = $approved;
	}

	protected function getApproved(){
		return $_approved;
	}	


	protected function setUserAccountNumber($userAccountNumber){
		this-> $_userAccountNumber = $userAccountNumber;
	}

	protected function getUserAccountNumber(){
		return $_userAccountNumber;
	}
}	
?>