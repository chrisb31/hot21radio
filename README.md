// Firebase functions

var currentUser = firebase.auth().currentUser;
currentUser.updateProfile({
 displayName: “Bill Murray”,
 photoURL: “http://www.fillmurray.com/g/200/300"
});
currentUser.sendPasswordResetEmail(“bill-murray@gmail.com”); // Sends a temporary password
// Re-authentication is necessary for email, password and delete functions
var credential = firebase.auth.EmailAuthProvider.credential(email, password);
currentUser.reauthenticate(credential);
currentUser.updateEmail(“bill-murray@gmail.com”);
currentUser.updatePassword(“some-new-password-string”);
currentUser.delete();

// newapi.org

API key: cf5f09b532154cf4856a0e16a520b89b