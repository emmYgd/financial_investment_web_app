<?php
namespace Backend\Core;

trait SessionControlCore{

	//session parameters:
	public $_status;

	public function getStatus(){
		this::$_status = session_status();
		return $_status;
	}

	public function startSession($sessionStatus){
		if ($sessionStatus == PHP_SESSION_NONE){
			//There is no active session
			session_start();
		}
	}

	public function stopSession(){
		session_destroy();
	}

	//allocate the supplied parameters as session variables:
	public function setAsSessionVariable(string $paramName, $paramValue){
		//$userSuppliedParam = this->getUserSuppliedParam();
		$_SESSION[$paramName] = $paramValue;
		return $_SESSION[$paramName];
	}

	public function getCurrentSession($paramName){
		return $_SESSION[$paramName];
	}

}
?>