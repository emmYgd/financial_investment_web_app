$(document).ready(function(){
  contactSubmit();
});


let contactSubmit = function(){
  //Now call the object literal method when button is clicked:
  $("#contact_submit").click(function(event){
    event.preventDefault();

    //get the values of the user details:
    var fullName = $("#full_name").val();
    var orgName = $("#org_name").val();
    var position = $("#position").val();
    var webPresence = $("#web_presence").val();
    var email = $("#email").val();
    var subject = $("#subject").val();
    var message = $("#message").val();

    //ensure validation first:

    //call ajax on the inputed value;
    var req = $.ajax({
      url: "Backend/sendMail.php",
      method:"post",
      data:{
        fName: fullName, 
        oName:orgName, 
        pos:position, 
        webPr:webPresence, 
        mail:email, 
        sub:subject, 
        mess:message
      }
    });
    
    req.done(function(resp){
      if(data == "success"){
        //clear form:
        $("form").trigger("reset");
        //sent successfully->
        $("#sentSuccess").html("Your message has been sent. Thank you! We will get back to you soon.");
      }else if(data == "error"){
        $("#errorMessage").html("Message not sent, please try again later");
      }
    });

    req.fail(function(){
      $("#errorMessage").html("Message not sent, please check your internet connection");
    });
    
  });
}

 
  /*var ClientServerComm = async function(jsonObject){

    console.log(contactInfo);
    //send over to the server:
    $.ajax({
      url:"../option1/Backend/ImplementContact.php",
      type:"POST",
      //mimeType: "application/json"
      //contentType: "application/json"
      data:{userInfo : JSON.stringify(contactInfo)},
      dataType : "json",
      processData : false,
      beforeSend : function(x){
        if(x && x.overrideMimeType){
          x.overrideMimeType("application/json; charset=UTF-8");
        }
      },
      success : function(result){
        if(result == "SUCCESS!"){
          //Tell the User that they are successfully registered here...
          //Hide all elements,
          //Display Success
          alert("Mail sent successfully!");
        }
      },
      error : function(err){
        //Indicate the error message...
        //if(err == "FAILURE!"){
          alert("Error in server Comms!");
        //}
      }
    });
  }*/
