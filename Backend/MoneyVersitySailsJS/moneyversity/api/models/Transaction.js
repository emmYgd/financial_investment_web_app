/**
 * Transaction.js
 *
 * @description :: A model definition represents a database table/collection.
 * @docs        :: https://sailsjs.com/docs/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {

    //  ╔═╗╦═╗╦╔╦╗╦╔╦╗╦╦  ╦╔═╗╔═╗
    //  ╠═╝╠╦╝║║║║║ ║ ║╚╗╔╝║╣ ╚═╗
    //  ╩  ╩╚═╩╩ ╩╩ ╩ ╩ ╚╝ ╚═╝╚═╝
    transaction_id: {
      type: 'string',
      required: true,
      unique: true,
      isUUID: true
    },

    transactionDate: {
      type: 'ref',//of instance Date
      required: true,
      description: 'Date of the transaction'
    },

    transactionInput:{
      type: 'json',
      required: true,
      unique: true,
      description: 'Various transaction input from user',
      extendedDescription: `Because of card charges issues, we are not accepting card yet as a form of deposit...
                            therefore, we need some crucial details from the user once he deposits to our bank account..
                            This will be parsed into json and stored`
    },

    transactionImageURL:{
      type:'string',
      unique:true,
      required: true,
      isURL:'true'
    },

    isPendingTransaction:{
      type:'boolean',
      required: true,
      description:'Checks every transaction to see if they are pending'
    },


    //  ╔═╗╔╦╗╔╗ ╔═╗╔╦╗╔═╗
    //  ║╣ ║║║╠╩╗║╣  ║║╚═╗
    //  ╚═╝╩ ╩╚═╝╚═╝═╩╝╚═╝


    //  ╔═╗╔═╗╔═╗╔═╗╔═╗╦╔═╗╔╦╗╦╔═╗╔╗╔╔═╗
    //  ╠═╣╚═╗╚═╗║ ║║  ║╠═╣ ║ ║║ ║║║║╚═╗
    //  ╩ ╩╚═╝╚═╝╚═╝╚═╝╩╩ ╩ ╩ ╩╚═╝╝╚╝╚═╝

    //HasOne TransactionCashFlow
    transactionCashFlow: {
      model:'transactionCashFlow'
    },

    //BelongsTo -> Account
    owner: {
      model: 'account'
    }
  },

};

