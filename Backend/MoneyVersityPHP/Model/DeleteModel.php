<?php
namespace Backend\Model

//require our ORM software:
require_once("Lib/rb.php");

interface DeleteModel{
	//declare strict type:
	declare(strict_types = 1); 

	//only admin can delete Users:
	public function AdminDeleteModel(string $paramTable, string $paramName):bool{
		R::trash($paramTable, $paramName);
		return true;
	}

?>