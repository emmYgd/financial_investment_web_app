module.exports = {


  friendlyName: 'Signup',


  description: 'Sign up for a new user account.',


  extendedDescription:
`This creates a new user record in the database, signs in the requesting user agent
by modifying its [session](https://sailsjs.com/documentation/concepts/sessions), and
(if emailing with Mailgun is enabled) sends an account verification email.

If a verification email is sent, the new user's account is put in an "unconfirmed" state
until they confirm they are using a legitimate email address (by clicking the link in
the account verification message.)`,


  inputs: {

    //parameters that the user will input:
    firstName:{
      required: true,
      type: 'string',
      maxLength: 20
    },

    middleName:{
      required: true,
      type: 'string',
      maxLength: 20
    },

    lastName:{
      required: true,
      type: 'string',
      maxLength: 20
    },

    userName:{
      type: 'string',
      required: true,
      unique: true,
      maxLength:20
      description:'Unique username of the user'
    },

    password: {
      type: 'string',
      required: true,
      maxLength: 20,
      description: 'The raw user-inputed password'
    },

    phoneNumber: {
      type: 'number',
      required:true,
      min:10,
      description:'Phone number preceeded by +234(10 digit number)'
    },

    emailAddress: {
      type: 'string',
      required: true,
      isEmail: true,
      maxLength: 50,
      description: 'The email address for the new account, e.g. m@example.com.',
      extendedDescription: 'Must be a valid email address.'
    },

    recoveryEmailAddress: {
      type: 'string',
      isEmail: true,
      maxLength: 50,
      example: 'mary.sue@example.com'
    },

    age: {
      required:true,
      type:'number',
      min: 18,
      max: 100
    },

    gender: {
      type: 'string',
      isIn:['male', "female"],
      required: true
    },

    bankName: {
      type:'string',
      required:true
    },

    bankAccountNumber: {
      type: 'number',
      unique:true,
      required:true,
      min:10,
      max:12,
      description:'This will be the user bank account from which to expect every user transactions'
    }

  },


  exits: {

    success: {
      description: 'New user account was created successfully.'
    },

    invalid: {
      responseType: 'badRequest',
      description: 'The provided fullName, password and/or email address are invalid.',
      extendedDescription: 'If this request was sent from a graphical user interface, the request '+
      'parameters should have been validated/coerced _before_ they were sent.'
    },

    emailAlreadyInUse: {
      statusCode: 409,
      description: 'The provided email address is already in use.',
    },

  },


  fn: async function (inputs) {

    // first build up data for the new user record and save it to the database->
    try{
      let newEmailAddress = await sails.helpers.casings.lowerCasing(inputs.emailAddress);
      let recoveryEmail = await sails.helpers.casings.lowerCasing(inputs.recoveryEmailAddress);

      let passHash = await sails.helpers.passwords.hashPassword(inputs.password);

      let newUserRecord = await User.create({
        //start saving into database:
        firstName: inputs.firstName,
        middleName: inputs.middleName,
        lastName: inputs.lastName,

        age : inputs.age,
        gender : inputs.gender,
        bankName : inputs.bankName,
        bankAccountNumber : inputs.bankAccountNumber,
        tosAcceptedByIp: this.req.ip
      }),

      if (newUserRecord/*was successful*/){
        //then, start inputing from the account side:
          await Account.create(_.extend({
            //Now, start inputing in the Account side:
            userName: inputs.userName,
            passwordHash: passHash,
            phoneNumber: inputs.phoneNumber,
            emailAddress: newEmailAddress,
            recoveryEmailAddress: recoveryEmail,
          }, sails.config.custom.verifyEmailAddresses? {
            emailProofToken: await sails.helpers.strings.random('url-friendly'),
            emailProofTokenExpiresAt: Date.now() + sails.config.custom.emailProofTokenTTL,
            emailStatus: 'unconfirmed'
          }:{}))
          .intercept('E_UNIQUE', 'emailAlreadyInUse')//instead of try/catch...
          .intercept({name: 'UsageError'}, 'invalid')//instead of try/catch...
          .fetch();//use `fetch` to retrieve the new ID so that we can use it below instead of re-querying the database
        }catch(err){

        }
      }

    // If billing feaures are enabled, save a new customer entry in the Stripe API.
    // Then persist the Stripe customer id in the database.
    if (sails.config.custom.enableBillingFeatures) {
      let stripeCustomerId = await sails.helpers.stripe.saveBillingInfo.with({
        emailAddress: newEmailAddress
      }).timeout(5000).retry();
      await User.updateOne({id: newUserRecord.id})
      .set({
        stripeCustomerId
      });
    }

    // Store the user's new id in their session.
    this.req.session.userId = newUserRecord.id;

    if (sails.config.custom.verifyEmailAddresses) {
      // Send "confirm account" email
      await sails.helpers.sendTemplateEmail.with({
        to: newEmailAddress,
        subject: 'Please confirm your account',
        template: 'email-verify-account',
        templateData: {
          fullName: inputs.fullName,
          token: newUserRecord.emailProofToken
        }
      });
    } else {
      sails.log.info('Skipping new account email verification... (since `verifyEmailAddresses` is disabled)');
    }

  }

};
