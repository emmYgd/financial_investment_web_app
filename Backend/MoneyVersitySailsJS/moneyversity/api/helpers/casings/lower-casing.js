module.exports = {


  friendlyName: 'Lower casing',


  description: 'turn inputed parameters into lower casing -->e.g. email address..',


  inputs: {
    anyString:{
      type: 'string',
      required: true,
      description: 'string to be converted to lower case'
    }
  },


  exits: {

    success: {
      description: 'All done.',
    },

  },


  fn: async function (inputs) {
    var lowerCase = await inputs.anyString.toLowerCase();
    return lowerCase;
  }

};

