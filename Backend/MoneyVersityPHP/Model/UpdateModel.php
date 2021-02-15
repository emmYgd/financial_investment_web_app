<?php
namespace Backend\Model;
//require our ORM software:
require_once("Lib/rb.php");

interface UpdateModel{
	//declare strict type:
	declare(strict_types = 1); 
	//for userAuth
	public function UserUpdateModel (string $paramTable, string $paramName, $paramValue):bool{
		$paramTable-> $paramName = $paramValue;
		return true
	}

	//Update Where:
	public function UserUpdateModel(string $paramTable, string $searchParamN, $searchParamV, 
		string $paramToBeUpdatedN, $paramToBeUpdatedV){
		//will replace by ORM syntax later:
		$rawSql = "UPDATE" . $paramTable . "SET". $paramToBeUpdatedN . "=". $paramToBeUpdatedV . 
					"WHERE" . $searchParamN . "=" . $searchParamN; 

		R::exec($rawSql);
		return true;
	}

	public function AdminUpdateModel(string $paramTable, string $paramName, $paramValue):bool{
		this->UserUpdateModel ($paramTable, $paramName, $paramValue);
		return true;
	}
?>