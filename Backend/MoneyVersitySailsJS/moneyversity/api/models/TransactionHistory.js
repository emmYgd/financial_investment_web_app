/**
 * TransactionHistory.js
 *
 * @description :: A model definition represents a database table/collection.
 * @docs        :: https://sailsjs.com/docs/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {

    //  ╔═╗╦═╗╦╔╦╗╦╔╦╗╦╦  ╦╔═╗╔═╗
    //  ╠═╝╠╦╝║║║║║ ║ ║╚╗╔╝║╣ ╚═╗
    //  ╩  ╩╚═╩╩ ╩╩ ╩ ╩ ╚╝ ╚═╝╚═╝
    //Date before:
    historyDateTo: {
      type: 'ref',//of instance Date
      required: true,
      unique: true,
      isBefore: new Date(),
      description: 'List of previous transactions up to a moment before this date'
    },

    depositHistory: {
      type: 'json',
      required: true,
      description: `List of all deposit History in the format:
        {Date: transImage, transInput, transImage, Pending/Confirmed}`
    },

    withdrawalHistory: {
      type: 'json',
      required: true,
      description: `List of all withdrawal History in the format:
              {Date: transImage, transInput, transImage, Pending/Confirmed}`
    },

    //  ╔═╗╔╦╗╔╗ ╔═╗╔╦╗╔═╗
    //  ║╣ ║║║╠╩╗║╣  ║║╚═╗
    //  ╚═╝╩ ╩╚═╝╚═╝═╩╝╚═╝


    //  ╔═╗╔═╗╔═╗╔═╗╔═╗╦╔═╗╔╦╗╦╔═╗╔╗╔╔═╗
    //  ╠═╣╚═╗╚═╗║ ║║  ║╠═╣ ║ ║║ ║║║║╚═╗
    //  ╩ ╩╚═╝╚═╝╚═╝╚═╝╩╩ ╩ ╩ ╩╚═╝╝╚╝╚═╝
    //HasMany -> Transactions

    //BelongsTo -> Account
    owner: {
      model: 'account'
    }

    //BelongsTo -> Admin -> auto-synchronize ->
    owner:{
      model:'admin',
    }

  },

};

