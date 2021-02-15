<?php
//The implementations will be final classes in future versions:

require_once("Backend/AdminCore.php");

//instantiate the class:
$admin = new AdminCore;

//note the constants:
//$adminEmail = "moneyvarsity@gmail.com";
$localhost = "localhost";
$db_name = "";
$db_username = ""; 
$db_password = "";

$adminTable = "Admin";

//$sessionN = "UserSession";

//Row name in database:
$passwordN = "Password";

//get value from client side:
//$email_username = $POST["uMail_uName"];
$adminPass  = $POST["pass"];

$admin->setPassword($adminPass);

try{
	$adminPresent = confirmAdminPresent($localhost, $db_name, $db_username, $db_password, $adminTable, 
			 $adminPassN, $adminPassV);
	if($adminPresent){
		echo "adminFound";
	}else{
		echo "adminNotFound";
	}
}catch(ex){
	//use raw message display to see this
	echo ("adminNotFound");
}
?>