<?php
class LogoutCore{
	//use Session Trait:
	use("SessionControlCore.php");

	//destroy session funnction:
	public function logOut(){
		stopSession();
		return true;
	}
	
}
?>