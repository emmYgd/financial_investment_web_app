$(document).ready(function(){
	adminLogin();
	//Load Default:
	defaultAccountLoad();

	//Admin Update:
	updateAccount();

	//Admin History:
	viewHistory();
});


let adminLogin = function(){

	$("adminLogIn").click(function(event){
		event.preventDefault();
		//start the process sending to the server:
		//var email_username = $("#email_username").val();
		var password = $("#password").val();

		if( /*(uname_email != "") &&*/ (pass != "") ){

			//send over to the server:
			var req = $.ajax({
			  url:"Backend/adLgXYZ123.php",
			  method:"POST",//type
			  data:{
			    //uMail_uName: email_username, 
			    pass: password
			  }
			});

			//handle response:
			req.done(function(resp){
				if(resp == "adminFound"){
					
					//redirect to admin page:

					//attach an event to one of the id:
					//can JQuery redirect?:
					//window.location.replace("index.html");
					//request from server:
					//or use: monieversity.com/admin.php
					var url = "adPgYEmmy_STee_XYZ_123.html";
					$(location).attr("href", url);

				}else if(resp == "adminNotFound"){
					$("errormessage").html("Sorry, but you inputed the wrong details. Contact the admin to login");
				}
			});

			req.fail(function(){
				$("#errormessage").html("Failed to log you in, please check your internet connection and try again!");
			});

		}else{
			//handle validation here...
			$("errormessage").html("Non of the field can be empty! Please ensure you fill up as appropriate!");
		}

	});
}

let parseJSONdata  = function(param){
  var jsonObj = JSON.parse(param);
  return jsonObj;
}


let defaultAccountLoad = function(){
	//send over to the server:
	var req = $.ajax({
	  url:"Backend/admin.php",
	  method:"GET",//type
	});

	req.done(function(resp){
		//reset all values in the form:
		$("form").trigger("reset");
		//parse JSON:
		var resp = parseJSONdata(resp);
		if(resp.status == "Found"){
		  //for admin account:
		  var userBitWallet = resp.adminBitWallet;
		  var userEtherWallet = resp.adminEtherWallet;
		  var userBitCashWallet = resp.adminBitCoinCash;
		  //var userPerfectMoney = resp.userPerfectMoney;

		    //fix in the user details:
		    $("#admin_bit").html(userBitWallet);
		    $("#admin_ether").html(userEtherWallet);
		    $("#admin_bitcash").html(userBitCashWallet);
		   // $("#user_pMoney").html(userPerfectMoney);
		  }else if(resp.status == "notFound"){
		    $("#errormessage").html("Failed login attempt, please register to Login.");
		  } 
	});


	//handle failure now:
	req.fail(function(){
	  $("#errormessage").html("Failed to Login. Please, check your internet connection!");
	});	
}


let updateAccount = function(){
	$("updateAdminAcc").click(function(event){
		//get the values:
		/*var newBitAddress = $("updateAdminBit").val();
		var newEtherAddress = $("updateAdminEther").val();
		var newBitCashAddress = $("updateAdminBitCash").val();
		$("#updateSuccess").html(newBitAddress);*/

		//var anotherAccount = $("updateAnotherAccount").val(); 

		//validate here:
		if((newBitAddress == "") || (newEtherAddress = "") || 
		  (newBitCashAddress  == "") /*|| (updatePerfectMoney == "")*/)
		{ 
		  $("#updateError").html("Please fill up the empty fields!");
		}else{

			$("#admin_bit").html(newBitAddress);
			$("#admin_ether").html(newEtherAddress);
			$("#admin_bitcash").html(newBitCashAddress);
		    
		    //send through ajax:
		    var req = $.ajax({
		      url:"Backend/updateUserAcc.php",
		      method:"POST",//type or method...
		      data:{
		        adminBit: newBitAddress, 
		        adminEther: newEtherAddress, 
		        adminBitCash: newBitCashAddress,
		        //userPmoney: updatePerfectMoney
		      }
		    });

		    //start fixing data:
		    req.done(function(resp){
		      //$("form").trigger("reset");

		      //parse JSON:
		      var resp = parseJSONdata(resp);
		      if(resp.adminAccountStatus == "UpdateSuccessful"){

		        //clear form 
		        $("form").trigger("reset");

		        //update the frontend with the supplied user info:
		        var newAdminBitWallet = resp.updatedAdminBitWallet;
		        var newAdminEtherWallet = resp.updatedAdminEthereumWallet;
		        var newAdminBitCashWallet = resp.updatedAdminBitCashWallet;
		        //var newUserPerfectMoneyWallet = res.updatedAdminPerfectMoneyAccount;

		        $("#admin_bit").html(newAdminBitWallet);
		        $("#admin_ether").html(newAdminEtherWallet);
		        $("#admin_bitcash").html(newAdminBitCashWallet);
		        //$("#user_pMoney").html(newAdminPerfectMoneyWallet);

		        //Display on the modal to the admin:
		        $("#updateSuccess").html("Your accounts and wallet addresses have been updated successfully!");

		      }else if(resp.adminAccountStatus == "UpdateError"){
		        $("#updateError").html("Server error, please consult the database personnel or try again!");
		      }
		    });
		    
		    req.fail(function(){
		      //$("form").trigger("reset");
		      $("#updateError").html("Error in updating admin account details, please check your internet connection and try again!");
		    });
		}
	});
}

let viewHistory = function(){
	$("#viewHistory").click(function(event){
		event.preventDefault();
		//now start fetching data from the backend:
		req = $.ajax({
			url:"Backend/adminHistory.php",
			method:"GET",//type or method...
		});

		req.done(function(resp){
			if(resp !== ""){
				//response is string from database:
				$("historyDisplay").html(resp);
			}else{
				$("historyDisplay").html("No history yet!");
			}
		});

		req.fail(function(){
			$("historyDisplay").html("Failed to load the history. Please check your internet connection and try again!");
		});

	});
}