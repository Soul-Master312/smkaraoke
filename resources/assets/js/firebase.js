import fb from 'firebase/app';
import 'firebase/database';

let config = {
    apiKey: process.env.MIX_FIREBASE_APP_API_KEY,
    databaseURL: process.env.MIX_FIREBASE_APP_DATABASE_URL
};
let firebase = fb.initializeApp(config);
let database = firebase.database();

export default database;