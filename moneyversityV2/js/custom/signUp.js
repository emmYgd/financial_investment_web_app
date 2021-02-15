$(document).ready(function(){
 signUpUser();
});


let signUpUser = function(){
  //Now call the object literal method when button is clicked:
  $("#submit").click(function(event){
    event.preventDefault();

    //get the values of the user details:
    var firstName = $("#first_name").val();
    var lastName = $("#last_name").val();
    var phoneNumber = $("#phone_number").val();
    var email = $("#email").val();
    var userName = $("#username").val();

    //get the two passwords and compare if they match:
    var pass1 = $("#password1").val();
    var pass2 = $("#password2").val();
    var appPass = getTruePass(pass1, pass2);

      //send over to the server:
    var req = $.ajax({
      url:"Backend/signup.php",
      method:"POST",//type
      data:{
        fName: firstName, 
        lName: lastName, 
        phoneNum: phoneNumber, 
        uMail: email, 
        uname: username, 
        pass: appPass 
      }
    });
    
    req.done(function(resp){
      //Tell the User that they are successfully registered here...
      if(data == "success"){
        //clear form:
        $("form").trigger("reset");
        //sent successfully->
        $("#regSuccess").html("You are now registered. Pls login to continue.");
      }else if(data == "error"){
        $("#errMessage").html("Sorry, could not sign you up, please try again.");
      }
    });

    req.fail(function(){
      $("#errMessage").html("Sorry, could not sign you up, please check your internet connection.");
    });

  });
}


let getTruePass = function(pass1, pass2){
  if(pass1 == pass2){
    //password great!
    return pass1
  }else{
    alert("Error! Password does not Match!");
  }
}