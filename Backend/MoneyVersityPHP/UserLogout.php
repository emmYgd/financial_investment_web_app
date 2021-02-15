<?php
namespace Backend;
//destroy user session and redirect
require_once("Core/LogoutCore.php");

final class UserLogout{

	public function __construct(){
		//run the function below by default immediately this class is invoked:
		userLogout();
	}

	final public function userLogout(){
		$userLogout = LogoutCore::logOut(); 
		//try{
		if($userLogout){
			//send over to the client:
			echo json_encode(["serverStatus" : "sessionDestroyed"]);
		}else{
		//}catch($ex){
		echo json_encode(["serverStatus" : "sessionNotDestroyed"]);
		}
	}
}
new UserLogout;
?>