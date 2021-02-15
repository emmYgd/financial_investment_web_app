/**
 * AccountCashFlow.js
 *
 * @description :: A model definition represents a database table/collection.
 * @docs        :: https://sailsjs.com/docs/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {

    //  ╔═╗╦═╗╦╔╦╗╦╔╦╗╦╦  ╦╔═╗╔═╗
    //  ╠═╝╠╦╝║║║║║ ║ ║╚╗╔╝║╣ ╚═╗
    accountBalance: {
      type: 'number',
      required: true,
      min: 0,
    },

    investAmount: {
      type: 'number',
      required: true,
      min: 0,
    },

    isBalanceAutoConfirmed: {
      type: 'boolean',
      description: 'checks the balance state weather it\'s automatically confirmed or not'
    },

    isBalanceAdminConfirmed: {
      type: 'boolean',
      description: 'check the balance state '
    }

    isInvestConfirmed: {
      type: 'boolean'
      description: 'checks the balance state weather it\'s manually confirmed by the Admin or not'
    }


    //  ╔═╗╔╦╗╔╗ ╔═╗╔╦╗╔═╗
    //  ║╣ ║║║╠╩╗║╣  ║║╚═╗
    //  ╚═╝╩ ╩╚═╝╚═╝═╩╝╚═╝


    //  ╔═╗╔═╗╔═╗╔═╗╔═╗╦╔═╗╔╦╗╦╔═╗╔╗╔╔═╗
    //  ╠═╣╚═╗╚═╗║ ║║  ║╠═╣ ║ ║║ ║║║║╚═╗
    //  ╩ ╩╚═╝╚═╝╚═╝╚═╝╩╩ ╩ ╩ ╩╚═╝╝╚╝╚═╝

    //BelongsTo Transaction
    owner:{
      model: 'transaction'
    }

  },

};

