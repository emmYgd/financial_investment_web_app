module.exports = {
  //this is the controller for user login:
  friendlyName: 'Login',

  description: 'Log in using the provided email and password combination.',

  extendedDescription:
`This action attempts to look up the user record in the database with the
specified email address.  Then, if such a user exists, it uses
bcrypt to compare the hashed password from the database with the provided
password attempt.->`,


  inputs: {//req

    uname_or_email: {
      description: 'The username or email to try in this attempt, e.g. "irl@example.com".',
      type: 'string',
      required: true
    },

    password: {
      description: 'The unencrypted password to try in this attempt, e.g. "passwordlol".',
      type: 'string',
      required: true
    },

    rememberMe: {
      description: 'Whether to extend the lifetime of the user\'s session.',
      extendedDescription:
`Note that this is NOT SUPPORTED when using virtual requests (e.g. sending
requests over WebSockets instead of HTTP).`,
      type: 'boolean'
    }

  },

  exits: {

    success: {
      description: 'The requesting user agent has been successfully logged in.',
      extendedDescription:
`Under the covers, this stores the id of the logged-in user in the session
as the \`userId\` key.  The next time this user agent sends a request, assuming
it includes a cookie (like a web browser), Sails will automatically make this
user id available as req.session.userId in the corresponding action.  (Also note
that, thanks to the included "custom" hook, when a relevant request is received
from a logged-in user, that user's entire record from the database will be fetched
and exposed as \`req.me\`.)`
    },

    errInCombination: {
      description: `The provided email and password combination does not
      match any user in the database.`,
      responseType: 'unauthorized'
      // ^This uses the custom `unauthorized` response located in `api/responses/unauthorized.js`.
      // To customize the generic "unauthorized" response across this entire app, change that file
      // (see api/responses/unauthorized).
      //
      // To customize the response for _only this_ action, replace `responseType` with
      // something else.  For example, you might set `statusCode: 498` and change the
      // implementation below accordingly (see http://sailsjs.com/docs/concepts/controllers).
    }

  },


  fn: async function (inputs) {

    // Look up by the email address.
    // (note that we lowercase it to ensure the lookup is always case-insensitive,
    // regardless of which database we're using)

    try{
      //first search for the user-supplied username in database:
      let userRecordSearchUname = await User.findOne({
        username: inputs.uname_or_email.toLowerCase(),
      });

      //if it fails, then, search for gmail:
      if(!userRecordSearchUname){
        let userRecordSearch = await User.findOne({
          emailAddress: inputs.uname_or_email.toLowerCase(),
        });
      }

      //search for password:
      let isUserPassWordPresent = await sails.helpers.passwords.checkPassword(inputs.password, userRecordSearch.password)
      if(userRecordSearch && isUserPassWordPresent){

        // If "Remember Me" was enabled, then keep the session alive for
        // a longer amount of time.  (This causes an updated "Set Cookie"
        // response header to be sent as the result of this request -- thus
        // we must be dealing with a traditional HTTP request in order for
        // this to work.)
        if (inputs.rememberMe) {
          /*if (this.req.isSocket) {
            sails.log.warn(
              'Received `rememberMe: true` from a virtual request, but it was ignored\n'+
              'because a browser\'s session cookie cannot be reset over sockets.\n'+
              'Please use a traditional HTTP request instead.'
            );
          } else {*/
          this.req.session.cookie.maxAge = sails.config.custom.rememberMeCookieMaxAge;
        },

        // Modify the active session instance.
        // (This will be persisted when the response is sent.)
        this.req.session.userId = userRecordSearch.id;

        /*redirect to a loggedIn view(In this case, we use the json response =>
        since we are making for a REST API that maps well for both website and mobile app)..*/
        return this.res.json(usersRecordSearch)
      }
    }catch(err){
      // If there was no matching user, respond thru the "badCombo" exit.
      throw 'errInCombination';
    },

  }

};
