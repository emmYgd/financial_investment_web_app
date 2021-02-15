<?php
namespace Backend\Core;

class DBconstants{

	//set the database constants here:
	const $localhost = "localhost";
	const $db_name = "";
	const $db_username = ""; 
	const $db_password = "";

	private $table_name;

	public setTableName($table_name: string){
		this::$table_name = $table_name
	} 

	public getTableName(): string{
		return this::$table_name;
	} 

	public getLocalHost(){
		return this::$localhost;
	}

	public getDbname(){
		return this::$db_name;
	}

	public getDbusername(){
		return this::$db_username;
	}

	public getDbpassword(){
		return this::$db_password;
	}
}
?>