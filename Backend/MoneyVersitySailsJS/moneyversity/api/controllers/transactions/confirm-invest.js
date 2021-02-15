module.exports = {


  friendlyName: 'Confirm invest',


  description: '',


  inputs: {
    investAmount: {
      type: 'number',
      required: true,
      min: 5000,
      description:'the amount the user is interested in investing -> this should be displayed as a drop-down option to the users:'
    }
  },


  exits: {

  },


  fn: async function (inputs) {

    //first check that this user is logged in -> this is automatically ensured in the policy:
    //then get the current user balance and update ->
    let autoConfirmStatus = await TransactionCashFlow.find({isBalanceAutoConfirmed}).;
    let adminConfirmStatus = await TransactionCashFlow.find({isBalanceAdminConfirmed});

    if(autoConfirmStatus || adminConfirmStatus){
      //get current balance:
      let currentBalance = await TransactionCashFlow.find({accountBalance}).intercept(err, /*response here*/);
      let investAmount = inputs.investAmount;
      if(investAmount > currentBalance){
        //Sorry, but you can't invest more than this balance
      }else if(investAmount == currentBalance) {
        //respond with warning but continue nevertheless:
        this.res.//->complete this..
        //compute the remaining balance and update:
        currentBalance -= investAmount;
        //update database:
        await sails.helpers.balances.update(TransactionCashFlow, investAmount, currentBalance);

      }else{
        this.res.//->complete this
        //update database:
        currentBalance -= investAmount;
        await sails.helpers.balances.update(TransactionCashFlow, investAmount, currentBalance);
      }
    }else{
      res.//send errorCode.sendJSON messages:
    }

    return ;

  }


};
