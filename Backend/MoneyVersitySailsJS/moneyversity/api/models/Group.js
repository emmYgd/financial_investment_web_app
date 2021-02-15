/**
 * GroupInvest.js
 *
 * @description :: A model definition represents a database table/collection.
 * @docs        :: https://sailsjs.com/docs/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {

    //  ╔═╗╦═╗╦╔╦╗╦╔╦╗╦╦  ╦╔═╗╔═╗
    //  ╠═╝╠╦╝║║║║║ ║ ║╚╗╔╝║╣ ╚═╗
    //  ╩  ╩╚═╩╩ ╩╩ ╩ ╩ ╚╝ ╚═╝╚═╝
    group_id: {
      type: 'string',
      required: true,
      unique: true,
      isUUID: true
    },

    targetAmount: {
      type: 'number',
      required: true,
      min: 0,
      description: 'The amount targeted to be reached on this group before investment'
    },

    individualAmount: {
      type: 'number',
      required: 'true',
      min:0,
      description: 'The amount apportioned to each member contributing for investment in a group',
    },

    groupBalance: {
      type: 'number',
      required: true,
      unique: true,
      min: 0,
    },

    groupDeficit: {
      type: 'number',
      required: true,
      unique: true,
      min: 0,
      description:'This is the amount left to balance up the group\'s target amount'
    },

    groupCreationDate: {
      type: 'ref',//of instance Date
      required: true,
      description: 'date the group was created'
    },

    groupExpiryDate:{
      type: 'ref',//of instance Date
      required: true,
      description: 'date the group will expire'
    },

    groupValidityDays: {
      type: 'number',
      required: true,
      min: 1
    },

    targetUserNumber: {
      type: 'number',
      required: true,
      min: 2
    },

    joinedUserNumber: {
      type: 'number',
      required: true,
      min: 1
    },

    //  ╔═╗╔╦╗╔╗ ╔═╗╔╦╗╔═╗
    //  ║╣ ║║║╠╩╗║╣  ║║╚═╗
    //  ╚═╝╩ ╩╚═╝╚═╝═╩╝╚═╝


    //  ╔═╗╔═╗╔═╗╔═╗╔═╗╦╔═╗╔╦╗╦╔═╗╔╗╔╔═╗
    //  ╠═╣╚═╗╚═╗║ ║║  ║╠═╣ ║ ║║ ║║║║╚═╗
    //  ╩ ╩╚═╝╚═╝╚═╝╚═╝╩╩ ╩ ╩ ╩╚═╝╝╚╝╚═╝
    //HasMany/BelongsTo Users
    owners: {
      collection: 'user',
      via: 'groups'
    },

    //BelongsTo Admin
    owner:{
      model:'admin'
    }
  },

};

