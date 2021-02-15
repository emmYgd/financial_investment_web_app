module.exports = {


  friendlyName: 'Confirm balance',


  description: 'Expecting certain parameters from the users to confirm the balance',


  inputs: {

    transactionDate: {
      type: 'ref',//of instance Date
      required: true,
      description: 'Date of the transaction supplied by the User'
    },

    transactionDay: {
      type: 'string',
      required: true,
      description:'note: Use drop down menu to display this to the users'
    },

    senderBankName: {
      type: true,
    },

    senderBankName: {

    },

    senderAccountName: {
      type: 'string',
      required: true,
      description: 'Compare this with the accountName the User regitered with..',
      extendedDescription: `It is adviceable to use the bank Account that the user
      registered with to send the money for faster confirmation!`
    },

    amountSent: {
      type: 'number'
      required: true,
      min: 5000
      description:'This is the amount sent by the user to use in updating the account!'
    },

    transactionImageProof:{
      type:'ref',
      required: true,
    },
  },


  exits: {
    success:
  },


  fn: async function (inputs) {



    // All done.
    return;

  }


};
