<?php
//destroy user session and redirect
require_once("Backend/LogoutCore.php");

$logout = new LogoutCore;

$userLogout = $logout->logOut(); 
//try{
	if($userLogout){
	//send over to the client:
		echo("sessionDestroyed");
	}else{
//}catch($ex){
	echo("sessionNotDestroyed");
	}
?>