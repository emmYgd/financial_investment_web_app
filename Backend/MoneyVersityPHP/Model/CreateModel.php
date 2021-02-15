<?php
namespace BackEnd/Model;

//require our ORM software:
require_once("Lib/rb.php");

trait CreateModel{

	public function createModel(string $paramToSaveTableName, $paramToSaveName, $paramToSaveValue)
	{
		$paramTableCreate = R::dispense($paramToSaveTableName);
		$paramTableCreate->$paramToSaveName = $paramToSaveValue;
		//save param:
		R::store( $paramTableCreate);

		return true;
	}

	//create additional rows and set the value at a given username:
	public function createModelAtUsername($userTable, $usernameN, $usernameV, $paramToBeCreatedN, 
		$paramToBeCreatedV){
		$ensureDepositColumns = R::dispense($userTable);//create table if not exist:

		//create additional empty  columns:
		$ensureDepositColumns->$paramToBeCreatedN = "";

		//will replace by ORM syntax later:
		$rawSql = "UPDATE" . $userTable . "SET". $paramToBeCreatedN . "=". $paramToBeCreatedV . 
					"WHERE" . $usernameN . "=" . $usernameV; 

		//where username=Username, update the param details:
		R::exec($rawSql); 

		return true;
	}  

	//for transactions...Don't need to delete the former contents:
	public function createModelAtUsernameWithoutDelete($userTable, $usernameN, $usernameV,  
		$paramToBeCreatedN, $paramToBeCreatedV):bool{

		$ensureHistoryColumns = R::dispense($userTable);//create table if not exist:

		//create additional empty  columns:
		$ensureHistoryColumns->$paramToBeCreatedN = "";

		//will replace by ORM syntax later: don't need to delete the former contents:
		$rawSql = "UPDATE" . $userTable . "SET". $paramToBeCreatedN . "=". $paramToBeCreatedN . 
					$paramToBeCreatedV . "WHERE" . $usernameN . "=" . $usernameV; 

		//where username=Username, update the param details:
		R::exec($rawSql); 

		return true;
	}

}
?>