/**
 * Admin.js
 *
 * @description :: A model definition represents a database table/collection.
 * @docs        :: https://sailsjs.com/docs/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {

    //  ╔═╗╦═╗╦╔╦╗╦╔╦╗╦╦  ╦╔═╗╔═╗
    //  ╠═╝╠╦╝║║║║║ ║ ║╚╗╔╝║╣ ╚═╗
    //  ╩  ╩╚═╩╩ ╩╩ ╩ ╩ ╚╝ ╚═╝╚═╝
    adminFullName: {
      type: 'string',
      unique: true
      required: false,
      description: 'Full representation of the admin\'s name.',
      maxLength: 20,
      example: 'Emmanuel Dammy Ryan'
    },

    adminPassword: {
      type: 'string',
      required: true,
      unique: true,
      protect: true,
      regex: /^[a-z0-9]$/i
      custom: function(value) {
        // • be a string
        // • contain at least one number
        // • contain at least one letter
        // . also at least one special character...
        var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
        for (i=0; i <= specialChars.length; i++){

          let valueIndex = value.indexOf(specialChars[i]);

          //make sure it contains letters, numbers, and special characters:
          return (valueIndex > -1) && _.isString(value);
        }
      },

      extendedDescription: `We don\'t use password hash for storing admin password
       to relieve us of the stress involved in allocating various admin\'s password`
     },

      adminMail: {
        type: 'string',
        required: true,
        //unique: true,
        isEmail: true,
        maxLength: 50,
        example: 'mary.sue@example.com'
      },

      isAdminManual: { //or automatic?
          type: 'boolean',
          description: 'Whether this user is a human admin or a program interacting on the admin\'s behalf',
      },

      adminRoles: {
        type: 'string',
        isIn: ['CEO', 'CTO', 'AUTO']
      },

    //  ╔═╗╔╦╗╔╗ ╔═╗╔╦╗╔═╗
    //  ║╣ ║║║╠╩╗║╣  ║║╚═╗
    //  ╚═╝╩ ╩╚═╝╚═╝═╩╝╚═╝


    //  ╔═╗╔═╗╔═╗╔═╗╔═╗╦╔═╗╔╦╗╦╔═╗╔╗╔╔═╗
    //  ╠═╣╚═╗╚═╗║ ║║  ║╠═╣ ║ ║║ ║║║║╚═╗
    //  ╩ ╩╚═╝╚═╝╚═╝╚═╝╩╩ ╩ ╩ ╩╚═╝╝╚╝╚═╝
/* note that the admin  has access to all entities but
these entities don't have access to the admin:*/
    //HasMany users:
    users: {
      collection: 'user',
      via: 'owner'
    },

    //HasMany transactionHistory:
    transactionHistorys:{
      collection: 'transactionHistory',
      via:'owner'
    },

    //HasMany chatHistories:
    chatWithUsHistorys: {
      collection: 'chatWithUsHistory',
      via: 'owner'
    },

    //HasMany groups:
    groups: {
      collection: 'group',
      via:'owner'
    }

  },

};

