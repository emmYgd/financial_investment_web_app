/**
 * Account.js
 *
 * @description :: A model definition represents a database table/collection.
 * @docs        :: https://sailsjs.com/docs/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {

    //  ╔═╗╦═╗╦╔╦╗╦╔╦╗╦╦  ╦╔═╗╔═╗
    //  ╠═╝╠╦╝║║║║║ ║ ║╚╗╔╝║╣ ╚═╗
    //  ╩  ╩╚═╩╩ ╩╩ ╩ ╩ ╚╝ ╚═╝╚═╝
    userName:{
      type: 'string',
      required: true,
      unique: true,//no other person must go by this name...
      maxLength: 15,
      example: 'emmacrown40'
    },


    passwordHash:{
      type: 'string',
      required: true,
      unique: true,
      description: 'Securely hashed representation of the user\'s login password.',
      protect: true,
      example: '2$28a8eabna301089103-13948134nad'
      /*custom: function(value) {
        // • be a string
        // • contain at least one number
        // • contain at least one letter
        // . also at least one special character...
        //confirm this on the front-end:
        return _.isString(value) && value.length >= 6 && value.match(/[a-z]/i) && value.match(/[0-9]/);
      }*/
    },

    passwordResetToken: {
      type: 'string',
      description: 'A unique token used to verify the user\'s identity when recovering a password.  Expires after 1 use, or after a set amount of time has elapsed.'
    },

    passwordResetTokenExpiresAt: {
      type: 'number',
      description: 'A JS timestamp (epoch ms) representing the moment when this user\'s `passwordResetToken` will expire (or 0 if the user currently has no such token).',
      example: 1502844074211
    },

    phoneNumber: {
      type: 'number',
      required:true,
      unique: true,
      min:10,
      description:'Phone number preceeded by +234(10 digit number)'
    },

    emailAddress: {
      type: 'string',
      required: true,
      unique: true,
      isEmail: true,
      maxLength: 50,
      example: 'mary.sue@example.com'
    },

    recoveryEmailAddress: {
      type: 'string',
      unique: true,
      isEmail: true,
      maxLength: 50,
      example: 'mary.sue@example.com'
    },

    emailProofToken: {
      type: 'string',
      description: 'A pseudorandom, probabilistically-unique token for use in our account verification emails.'
    },

    emailProofTokenExpiresAt: {
      type: 'number',
      description: 'A JS timestamp (epoch ms) representing the moment when this user\'s `emailProofToken` will expire (or 0 if the user currently has no such token).',
      example: 1502844074211
    },

    emailStatus: {
      type: 'string',
      isIn: ['unconfirmed', 'change-requested', 'confirmed'],
      defaultsTo: 'confirmed',
      description: 'The confirmation status of the user\'s email address.',
      extendedDescription:
        `Users might be created as "unconfirmed" (e.g. normal signup) or
        as "confirmed" (e.g. hard-coded admin users).
        When the email verification feature is enabled,
        new users created via the signup form have \`emailStatus: 'unconfirmed'\`
        until they click the link in the confirmation email.
        Similarly, when an existing user changes their email address,
        they switch to the "change-requested"
        email status until they click the link in the confirmation email.`
    },

    isMailOperationSuccessful: {
      type: 'boolean',

    },


    //  ╔═╗╔╦╗╔╗ ╔═╗╔╦╗╔═╗
    //  ║╣ ║║║╠╩╗║╣  ║║╚═╗
    //  ╚═╝╩ ╩╚═╝╚═╝═╩╝╚═╝


    //  ╔═╗╔═╗╔═╗╔═╗╔═╗╦╔═╗╔╦╗╦╔═╗╔╗╔╔═╗
    //  ╠═╣╚═╗╚═╗║ ║║  ║╠═╣ ║ ║║ ║║║║╚═╗
    //  ╩ ╩╚═╝╚═╝╚═╝╚═╝╩╩ ╩ ╩ ╩╚═╝╝╚╝╚═╝

    //belongsTo -> User
    owner: {
      model: 'user'
    },

    //HasOne TransactionHistory:
    transactionHistory:{
      model: 'transactionHistory'
    },

    //HasMany -> Transactions, TransactionCashFlow
    transactions:{
      collection: 'transaction',
      via: owner
    },

    transactionCashFlows:{
      collection: 'transactionCashFlow'
      via: owner
    }
  },

};

