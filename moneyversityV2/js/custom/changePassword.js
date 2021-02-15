$(document).ready(function(){
	changePassword(); 
});

/*let parseJSONdata = function(param){
  var jsonObj = JSON.parse(param);
  return jsonObj;
}*/

let changePassword = function(){
	$("#submit").click(function(event){
	  event.preventDefault();

	  //get the values of the params:
	  var email_username = $("#email_username").val();

	  var password1 = $("#password1").val();
	  var password2 = $("#password2").val();

	  //validate on the client side, handle once:
	  if((email_username == "")|| (password1 == "") || (password2 == ""))
	  {
	    $("#errorMessage").html("Non of the fields can be empty, input appropriate values!");
	  }else if(password1 !== password2){
	  	$("#password2").get(0).setCustomValidity("Passwords not equal. Please retry!");
	  }else{

	  	//send over to the server:
	  	var req = $.ajax({
	  	  url:"Backend/changePassword.php",
	  	  method:"POST",//type
	  	  data:{
	  	    uMail_uName: email_username, 
	  	    newPass: password1
	  	  }
	  	});

	  	//recieve result:
	  	req.done(function(resp){
	  	  //var resp = parseJSONdata(resp);
	  	  if(resp == "passwordChanged"){
	  	  	$("#successMessage").html("Your password was changed successfully");
	  	  }else if(resp == "passwordNotChanged"){
	  	  	$("#errorMessage").html("Error in making password change! Try again.");
	  	  }
	  	});

	  	req.fail(function(){
	  		$("#errorMessage").html("Failed to change your password, please check your internet connection and try again!");
	  	});
	  }
}
