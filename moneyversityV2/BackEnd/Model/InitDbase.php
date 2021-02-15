<?php
interface InitDbase{
	//declare strict type:
	declare(strict_types = 1); 

	public function setUp($localhost, $db_name, $db_username, $db_password){
		//setUp Database
		R::setUp('mysql:host=' .$localhost. ';' .'dbname=' .db_name, $db_username, $db_mypassword);
		return true;
	}
}
?>