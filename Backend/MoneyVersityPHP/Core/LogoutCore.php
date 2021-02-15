<?php
namespace Backend/Core;

require_once("SessionControlCore.php");

class LogoutCore{
	//use Session Trait:
	use SessionControlCore;

	//destroy session funnction:
	public function logOut(){
		stopSession();
		return true;
	}
	
}
?>