module.exports = {


  friendlyName: 'Hash password',


  description: 'get the Hash of the User inputed password',


  inputs: {
    //Normal password here
    origPass: {
      type: 'string';
      required: true;
      description:'The original password inputed by the user'
    }
  },


  exits: {

    success: {
      description: 'All done.',
    }

  },


  fn: async function (inputs) {
    // TODO
    //use a node library to find the hash of this input...
  }


};

