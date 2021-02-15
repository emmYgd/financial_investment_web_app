//use windows event to hide data before page load.... Later things...
$(document).ready(function(){
  //handle default clicks:
  /*$("a #dummyA").click(function(event){
      event.preventDefault();
    });*/

  //fetches some data  by default immediately the page loads:
  GeneralFetch();  

  //confirmPayment button handle:
  confirmPayment();

  //update Payment Handle:
  updateUserAccount();

  //Deposit Transaction History:
  depositHistory();

  //Withdrawal Transaction History:
  withdrawalHistory();

  //logout:
  logOut();
});


let parseJSONdata = function(param){
  var jsonObj = JSON.parse(param);
  return jsonObj;
}


let GeneralFetch = function(){

  //hide the user dashboard skeleton:
  $("#userDashboardSkeleton").hide();
  
  //Now call the object literal method when button is clicked:
  $("#login").click(function(event){
    event.preventDefault();
    //get the values of the user details:
    var email_username = $("#email_username").val();
    var password = $("#password").val();

    if(email_username == ""){
      $("#email_username").get(0).setCustomValidity("Username/Email cannot be empty!");
    }else if(password == ""){
      $("#password").get(0).setCustomValidity("Password cannot be empty!");
    }else if((email_username == "") && (password == "")){
      $("#email_username").get(0).setCustomValidity("Username/Email cannot be empty!");
      $("#password").get(0).setCustomValidity("Password cannot be empty!");
    }else{
      //for test:
      $(".loginPage").hide();
      $("#userDashboardSkeleton").show();

      //send over to the server:
      var req = $.ajax({
        url:"Backend/login.php",
        method:"POST",//type
        data:{
          uMail_uName: email_username, 
          pass: password
        }
      });

      //recieve result:
      req.done(function(resp){
        var resp = parseJSONdata(resp);
        if(resp.serverStatus == "Found"){
          //$(".loginPage").hide();
          //$("#userDashboard").show();

          //start displaying information received from the server:
          var userFirstName = resp.firstname;
          var userLastName = resp.lastname;
          var username = resp.username;
          var email = resp.email;
          var phoneNumber = resp.phoneNumber; 

          var fullName = userFirstName + "" + userLastName;

          //fix in user details:
          $("#fullName").html(fullname);
          $("#userName").html(username);
          $("#email").html(email);
          $("#phoneNum").html(phoneNumber);
        }else if(resp.status == "notFound"){
          $("#errormessage").html("Failed login attempt, please register to Login.");
        } 
      });

      //continue receiving result:
      req.done(function(resp){
        var resp = parseJSONdata(resp);
        if(resp.status == "Found"){
          //for plans:
          var investPlan = resp.plan;
          var investCapital = resp.investCapital;
          var investStatus = resp.investStatus;//pending or approved
          var investReturns = resp.investReturns;
          var daysRemaining = resp.daysRemaining; 
        
          var investReturns = resp.investReturns;
          //fix in the investment figures:
          $("#invest_plan").html(investPlan)
          $("#invest_capital").html(investCapital);
          $("#invest_status").html(investStatus);
          $("#invest_returns").html(investReturns);
          $("#invest_days_remaining").html(investReturns);
        }else if(resp.status == "notFound"){
          $("#errormessage").html("Failed login attempt, please register to Login.");
        } 
      });

      //continue fixing results:
      req.done(function(resp){
        var resp = parseJSONdata(resp);
        if(resp.status == "Found"){
          //for user account:
          var userBitWallet = resp.userBitWallet;
          var userEtherWallet = resp.userEtherWallet;
          var userBitCashWallet = resp.userBitCoinCash;
          var userPerfectMoney = resp.userPerfectMoney;

          //fix in the user details:
          $("#user_bit").html(userBitWallet);
          $("#user_ether").html(userEtherWallet);
          $("#user_bitcash").html(userBitCashWallet);
          $("#user_pMoney").html(userPerfectMoney);
        }else if(resp.status == "notFound"){
          $("#errormessage").html("Failed login attempt, please register to Login.");
        } 
      });


      //continue fixing 
      req.done(function(resp){
        var resp = parseJSONdata(resp);
        if(resp.status == "Found"){
          //admin account information:
          var adminBitWallet = resp.adminBitWallet;
          var adminEtherWallet = resp.adminEtherWallet;
          var adminBitCashWallet = resp.adminBitCoinCashWallet; 
          var adminPerfectMoney = resp.adminPerfectMoneyAccount;    

          //fix in admin details:
          $("#admin_bit").html(adminBitWallet);
          $("#admin_ether").html(adminEtherWallet);
          $("#admin_bitcash").html(adminBitCashWallet);
          $("#admin_pMoney").html(adminPerfectMoney);
          //$("#admin_neteller").html(adminNetellerAccount);
        }else if(resp.status == "notFound"){
          $("#errormessage").html("Failed login attempt, please register to Login!");
        } 
      });  

      //handle failure now:
      req.fail(function(){
        $("#errormessage").html("Failed to Login. Please, check your internet connection!");
      });
    }
  });
}


let confirmPayment = function(){
  //send through ajax:
  $("#submitUserProof").click(function(event){
    //collect the values from the filled data:
    var paymentAmount = $("#payment_amount").val();
    var paymentDay = $("#payment_day").val();
    var paymentHour = $("#payment_hour").val();
    var paymentMinute = $("#payment_minute").val();

    //to create this in UI:
    var paymentPlan = $("#payment_plan").val();
    var paymentAccount = $("#payment_account").val();//name of our account/wallet into which the deposit was made:
    //get the image here:
    //var image = //getImage;

    //validate here:
    if((paymentAmount == "") || (paymentDay = "") || 
      (paymentHour == "") || (paymentMinute == "") || 
      (paymentPlan == "") || (paymentAccount == "")) 
    { 
      $("#confPayError").html("Please fill up the empty fields!");
    }else{
      
        var req = $.ajax({
          url:"Backend/confirmPayment.php",
          method:"POST",//type
          data:{
            payPlan: paymentPlan,
            payAmount: paymentAmount,

            payDay: paymentDay, 
            payMonth: paymentMonth,
            payYear: paymentYear,

            payHour: paymentHour, 
            payMinute: paymentMinute, 
            
            payAccount: paymentAccount//You deposited into which of our account? 
            //get the image uploaded here...
          }
        });

        //start fixing data:
        req.done(function(resp){
          $("form").trigger("reset");
          //parse JSON:
          var resp = parseJSONdata(resp);

          var investStatus = resp.investStatus;
          var daysRemaining = resp.daysRemaining;

          if(investStatus == "transactionPending"){
            $("#confPaySuccess").html("Your transaction is now pending, awaiting our approval");
            $("#invest_status").html("Pending!");
          }else if(investStatus == "transactionConfirmed"){
            $("#invest_status").html("Confirmed. Investment Active!");
            //number of days remaining(update):
            $("#invest_days_remaining").html(daysRemaining);
          }
        });
        
        req.fail(function(){
          $("form").trigger("reset");
          $("#confPayError").html("Error in confirming payment, please check your internet connection and try again");
        });
    }
  });
}

let updateUserAccount = function(){
  $("updateUserAcc").click(function(event){
    //collect the values from the filled data:
    var updateUserBit = $("#updateUserBit").val();
    var updateUserEther = $("#updateUserEther").val();
    var updateBitcoinCash = $("#updateBitcoinCash").val();
    var updatePerfectMoney = $("#payment_minute").val();

    //validate here:
    if((updateUserBit == "") || (updateUserEther = "") || 
      (updateBitcoinCash  == "") || (updatePerfectMoney == ""))
    { 
      $("#updateError").html("Please fill up the empty fields!");
    }else{
        
        //send through ajax:
        var req = $.ajax({
          url:"Backend/updateUserAcc.php",
          method:"POST",//type or method...
          data:{
            userBit: updateUserBit, 
            userEther: updateUserEther, 
            userBitCash: updateBitcoinCash,
            userPmoney: updatePerfectMoney
          }
        });

        //start fixing data:
        req.done(function(resp){
          $("form").trigger("reset");
          //parse JSON:
          var resp = parseJSONdata(resp);
          if(resp.userAccountStatus == "UpdateSuccessful"){

            //clear form 
            $("form").trigger("reset");

            //update the frontend with the supplied user info:
            var newUserBitWallet = resp.updatedUserBitWallet;
            var newUserEtherWallet = resp.updatedUserEthereumWallet;
            var newUserBitCashWallet = resp.updatedUserBitCashWallet;
            var newUserPerfectMoneyWallet = res.updatedUserPerfectMoneyAccount;

            $("#user_bit").html(newUserBitWallet);
            $("#user_ether").html(newUserEtherWallet);
            $("#user_bitcash").html(newUserBitCashWallet);
            $("#user_pMoney").html(newUserPerfectMoneyWallet);

            //Display on the modal to the user:
            $("#updateSuccess").html("Your accounts and wallet addresses have been updated successfully!");

          }else if(resp.userAccountStatus == "UpdateError"){
            $("#updateError").html("Server error in updating your Account, please try again!");
          }
        });
        
        req.fail(function(){
          $("form").trigger("reset");
          $("#updateError").html("Error in updating your account details, please check your internet connection and try again!");
        });
    }
  });
}

let depositHistory = function(){
  $("depHistBtn").click(function(){
    //connect with ajax automatically:
    var req = $.ajax({
      url:"Backend/depositHistory.php",
      method:"GET",//type or method...
    });

    req.done(function(resp){
      if(resp == "noTransaction"){
        $("#loadingDepHistory").hide();
        $("#depositHistory").html("No transaction yet!");
      }else if(resp == "dbReadError"){
        $("#loadingDepHistory").hide();
        $("#depositHistory").html("Error in database connection!");
      }else{
        $("#loadingDepHistory").hide();
        $("#depositHistory").html(resp);
      }
    });

    req.fail(function(resp){
      $("#loadingDepHistory").hide();
      $("#errormessage").html("Failed to read your deposit history, please check your internet connection and try again!");
    });
  });
}

let withdrawalHistory = function(){
  $("withHistBtn").click(function(){
    //connect with ajax automatically:
    var req = $.ajax({
      url:"Backend/withdrawalHistory.php",
      method:"GET",//type or method...
    });

    req.done(function(resp){
      if(resp == "noTransaction"){
        $("#loadingWithHistory").hide();
        $("#withdrawalHistory").html("No transaction yet!");
      }else if(resp == "dbReadError"){
        $("#loadingWithHistory").hide();
        $("#withdrawalHistory").html("Error in database connection!");
      }else{
        $("#loadingDepHistory").hide();
        $("#depositHistory").html(resp);
      }
    });

    req.fail(function(resp){
      $("#loadingDepHistory").hide();
      $("#errormessg").html("Failed to read your Withdrawal History, please check your internet connection and try again!");
    });
  });
}


let logOut = function(){

  $("a#logout").click(function(event){
    event.preventDefault();

    var url = "index.html";
    $(location).attr("href", url);

    var req = $.ajax({
      url:"Backend/logout.php",
      method:"GET",//type or method...
    });

    req.done(function(resp){
      event.preventDefault();
      if(resp == "sessionDestroyed"){
        //can JQuery redirect?:
        //window.location.replace("index.html");
        //request from server:
        //or use:
        var url = "index.html";
        $(location).attr("href", url);

      }else if(resp == "sessionNotDestroyed"){
        //can JQuery redirect?:
        //window.location.replace("index.html");
        //request from server:
        //or use:
        var url = "index.html";
        $(location).attr("href", url);
      }
    });

    //always do this:
    req.always(function(resp){
      //can JQuery redirect?:
      //window.location.replace("index.html");
      //request from server:
      //or use:
      var url = "index.html";
      $(location).attr("href", url);
    });

    req.fail(function(){
      //attach an event to one of the id:
      //can JQuery redirect?:
      //window.location.replace("index.html");
      //request from server:
      //or use:
      var url = "index.html";
      $(location).attr("href", url);
    });
    
  });
} 

