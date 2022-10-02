importScripts("https://www.gstatic.com/firebasejs/9.6.8/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/9.6.8/firebase-messaging.js");

var config = {
    apiKey: "%APIKEY%",
    authDomain: "%AUTHDOMAIN%",
    databaseURL: "%DATABASEURL%",
    projectId: "%PROJECTID%",
    storageBucket: "%STRORAGEBUCKET%",
    messagingSenderId: "%MESSAGINGSENDERID%",
    appId: "%APPID%",
    measurementId: "%MEASUREMENTID%",
};

firebase.initializeApp(config);