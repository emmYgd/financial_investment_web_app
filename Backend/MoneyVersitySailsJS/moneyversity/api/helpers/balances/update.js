module.exports = {


  friendlyName: 'Update',


  description: 'Update balances.',

  //TransactionCashFlow, investAmount, currentBalance
  inputs: {
    TransactionCashFlow:{
      type: Object,
      required: true
    },

    investAmount: {
      type:'Number',
      required: true
    },

    currentBalance: {
      type: 'Number',
      required: true
    }
  },

  exits: {

    success: {
      description: 'All done.',
    },

  },


  fn: async function (inputs) {
    //Now start to query the database to update recent computed values:
    await inputs.TransactionCashFlow.update(
      {accountBalance: inputs.currentBalance},
      {investAmount: inputs.investAmount},
      {isInvestConfirmed: true}).intercept(err, /*this.res.resCode.resType*/);
  }

};

