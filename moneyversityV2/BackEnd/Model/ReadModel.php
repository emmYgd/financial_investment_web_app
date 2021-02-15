<?php

//require our ORM software:
require_once("Lib/rb.php");

interface ReadModel{
	//declare strict type:
	declare(strict_types = 1); 


	//for general user read:
	public function userReadModel(string $paramTable)
	{
		$paramValue = R::findAll($paramTable);
		return $paramValue;
	}

	//user read for specific value but returns all associated bean in array: 
	public function readAllBeansOfParamName(string $paramTable, string $paramToBeReadName, 
		$paramToBeReadValue){

		$entryFound = R::find($paramTable, $paramToBeReadName . "==". $paramValue);

		//and where status is approved:
		
		return $entryFound;//all assoiciated bean...
		/*if($entryFound != null){
			return "UserFound";
		}else{
			return "userNotFound";
		}*/
	}

	//read for specific value but returns only the queried bean:
	public function userReadModelOne(string $paramTable, string $paramToBeReadName, $paramValue){

		$entryFound = R::findOne($paramTable, $paramToBeReadName . " = ?" , [$paramValue]);
		return $entryFound;
		/*if($entryFound != null){
			return "UserFound";
		}else{
			return "userNotFound";
		}*/
	}




	//for general admin read:
	public function adminReadModel(string $paramTable)
	{
		$paramValue = R::findAll($paramTable);
		return $paramValue;
	}

	//admin read for specific value but returns only the queried bean:
	public function adminReadModelOne(string $paramTable, string $paramToBeReadName, $paramValue){
		$entryFound = R::findOne($paramTable, $paramToBeReadName .  " = ?" , [$paramValue]);
		return $entryFound;
	}

	//admin read for specific value but returns all associated bean :
	public function adminReadModel(string $paramTable, string $paramToBeReadName, $paramValue){
		$entryFound = R::find($paramTable, $paramToBeReadName . " ==". $paramValue);
		return $entryFound;
	}

	//for adminAuth pending and confirmed transactions:
	public function adminReadModelTransStatus(string $paramTable, string $status, string $statusValue){
		//admin can read all Users and determine what to do with it as appropriate:
		$paramValue = R::find($paramTable, $status. "==" . $statusValue);
		return $paramValue;
	}

}
?>