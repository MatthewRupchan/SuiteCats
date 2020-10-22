
function signUpSubmit(event){
	var username = document.getElementById("username").value;
	var email = document.getElementById("email").value;
	var password1 = document.getElementById("password").value;
	var password2 = document.getElementById("verify_password").value;
	
	var checkedUsername = checkUsername(username);
	var checkedEmail = checkEmail(email);
	var checkedPassword1 = checkPassword(password1);
	var checkedPassword2 = checkSamePassword(password1, password2);
	
	if (!checkedUsername || !checkedEmail || !checkedPassword1 || !checkedPassword2) {
		event.preventDefault();
	}
}

function checkUsername(username) {
	var errorMessageBox = document.getElementById("username_error_message");
	
	if(username.length == 0) {
		errorMessageBox.innerHTML = "A username must be provided.";
		return false;
	}
	
	if(username.length > 99) {
		errorMessageBox.innerHTML = "A username must be less than 100 characters.";
		return false;
	}
	
	if(/\W/.test(username)) {
		errorMessageBox.innerHTML = "A username must contain only letters and numbers.";
		return false;
	}
	
	errorMessageBox.innerHTML = ""
	
	return true;
}

function checkEmail(email) {
	var errorMessageBox = document.getElementById("email_error_message");
	
	if(email.length == 0) {
		errorMessageBox.innerHTML = "An email must be provided.";
		return false;
	}
	
	if(!/^[a-zA-Z0-9\.]+@[a-zA-Z]+\.[a-zA-z]{2,3}$/.test(email)) {
		errorMessageBox.innerHTML = "A valid email must be provided.";
		return false;
	}
	
	errorMessageBox.innerHTML = ""
	
	return true;
}

function checkPassword(pword) {
	var errorMessageBox = document.getElementById("password1_error_message");
	
	if(pword.length < 8) {
		errorMessageBox.innerHTML = "A password needs at least 8 characters";
		return false;
	}
	
	if(pword.length > 99) {
		errorMessageBox.innerHTML = "A password must be less than 100 characters.";
		return false;
	}
	
	errorMessageBox.innerHTML = ""
	
	return true;
}

function checkSamePassword(p1, p2) {
	var errorMessageBox = document.getElementById("password2_error_message");
	
	if(p1 != p2) {
		errorMessageBox.innerHTML = "Passwords don't match";
		return false;
	}
	
	errorMessageBox.innerHTML = ""
	
	return true;
}
