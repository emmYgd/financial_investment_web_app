module.exports = {


  friendlyName: 'Random',


  description: 'Random strings.',


  inputs: {
    randomString: {
      type:'string',
      required: true,
      description: 'a random string from which to generate a verification token'
    }
  },


  exits: {

    success: {
      description: 'All done.',
    },

  },


  fn: async function (inputs) {
    // TODO
  }


};

