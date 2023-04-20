"use strict";

function exit(){
	alert("Your order has been successfully cancelled!");
 	sessionStorage.clear();
 	location.href = "index.html"; //The user has cancelled order.
}

function amex_validate(number){ 
	var errMsg = "";
	if (isNaN(number)){
		errMsg += "Please enter a valid Credit Card Number.\n";
	}
	else {
		var strNum = number.toString();
		var lenNum = strNum.length;
		var digit = strNum.slice(0,2);
		if (lenNum != 15){
			errMsg += "American Express card numbers must be 15 digits.\n";
		}
		if ((digit != 34) && (digit != 37)){
			errMsg += "American Express  card numbers start with a 34 or 37.\n";
		}
	}
	return errMsg;
}

function mastercard_validate(number){
	var errMsg = "";
	if (isNaN(number)){
		errMsg += "Please enter a valid Credit Card Number.\n";
	}
	else {
		var strNum = number.toString();
		var lenNum = strNum.length;
		var digit = strNum.slice(0,2);
		var i = 0;
		var list = [51,52,53,54,55];
		var j = 0;
		if (lenNum != 16){
			errMsg += "Mastercard numbers must be 16 digits.\n";
		}
		for (i = 0; i < list.length; i++){
			if (digit != list[i]){
				j += 1;
			}
		}
		if (j == 5){
			errMsg += "Mastercard numbers start with 51-55";
		}
	}
	return errMsg;
}

function visa_validate(number){
	var errMsg = "";
	if (isNaN(number)){
		errMsg += "Please enter a valid Credit Card Number.\n";
	}
	else {
		var strNum = number.toString();
		var lenNum = strNum.length;
		var digit = strNum.slice(0,1);
		if (lenNum != 16){
			errMsg += "Visa card numbers must be 16 digits.\n";
		}
		if (digit != 4){
			errMsg += "Visa card numbers start with a 4.\n";
		}
	}
	return errMsg;
}

function validate(){
	var errMsg = "";
	var result = true;

	var cc  = document.getElementById("Credit_Card").value;
	var ccName = document.getElementById("CC_Name").value;
	var ccNumber = document.getElementById("CC_Number").value;

	var alpha = /^[a-zA-Z ]*$/;

	if (ccName == ""){
		errMsg += "Please enter a name.\n";
		result = false;
	}
	if (ccName.length > 40){
		errMsg += "Maximum of 40 characters allowed for name.\n";
		result = false;
	}
	if (!ccName.match(alpha)){
		errMsg += "Please enter a valid name.\n";
		result = false;
	}

	if (cc == "Visa"){
		var tempMsg = visa_validate(ccNumber);
		if (tempMsg != ""){
			errMsg = errMsg + tempMsg;
			result = false;
		}
	}
	else if (cc == "Mastercard"){
		var tempMsg2 = mastercard_validate(ccNumber);
		if (tempMsg2 != ""){
			errMsg = errMsg + tempMsg2;
			result = false;
		}
	}
	else if (cc == "American_Express"){
		var tempMsg3 = amex_validate(ccNumber);
		if (tempMsg3 != ""){
			errMsg = errMsg + tempMsg3;
			result = false;
		}
	}


	if (errMsg != ""){
		alert(errMsg);
	}
	else{
		alert("Your order has been successfully placed! Thank you for choosing CameoAudio!"); //The user has proceeded with a successful checkout.
	}
	return result;
}

function calcCost(quantity, days, product){
	var cost = 0;
	if (product == "Projectors"){
		cost = (quantity * days * 21);
	}
	if (product == "Display Screens"){
		cost = (quantity * days * 44);
	}
	if (product == "Studio Lights"){
		cost = (quantity * days * 12);
	}
	if (product == "Speakers"){
		cost = (quantity * days * 77);
	}
	if (product == "Microphones"){
		cost = (quantity * days * 9);
	}
	if (product == "Headphones"){
		cost = (quantity * days * 23);
	}
	return cost;
}

function getDetails(){
	document.getElementById("confirm_name").textContent = sessionStorage.firstname + " " + sessionStorage.lastname;
	document.getElementById("confirm_email").textContent = sessionStorage.email;
	document.getElementById("confirm_phone").textContent = sessionStorage.phone;

	document.getElementById("confirm_address").textContent = sessionStorage.fullAddress;

	document.getElementById("confirm_product").textContent =sessionStorage.product;
	document.getElementById("confirm_quantity").textContent = sessionStorage.quantity;
	document.getElementById("confirm_date").textContent = sessionStorage.date;
	document.getElementById("confirm_days").textContent = sessionStorage.hire;

	document.getElementById("confirm_cost").textContent = "Will be displayed on the receipt page.";

	document.getElementById("First_Name").value = sessionStorage.firstname;
	document.getElementById("Last_Name").value = sessionStorage.lastname;
	document.getElementById("Phone_Number").value = sessionStorage.phone;
	document.getElementById("Email_ID").value = sessionStorage.email;

	document.getElementById("Street_Address").value = sessionStorage.streetAddress;
	document.getElementById("Suburb/Town").value = sessionStorage.suburb;
	document.getElementById("State").value = sessionStorage.state;
	document.getElementById("Postcode").value = sessionStorage.postcode;

	document.getElementById("Preferred_Contact").value = sessionStorage.contact;
	document.getElementById("Product_Info").value = sessionStorage.prodInfo;
	document.getElementById("Product_Features").value = sessionStorage.features;
	document.getElementById("comments").value = sessionStorage.comments;
	document.getElementById("feedback").value = sessionStorage.feedback;
	document.getElementById("authenticate").value = sessionStorage.authenticate;

	document.getElementById("Product_Order").value = sessionStorage.product;
	document.getElementById("Quantity").value = sessionStorage.quantity;
	document.getElementById("Date").value = sessionStorage.date;
	document.getElementById("Days_Hired").value = sessionStorage.hire;

	document.getElementById("Cost").value = finalCost;
	//All read-only data has been written on the form from sessionStorage successfully.

	var regForm = document.getElementById("conf_form"); //get ref to the HTML elementß
	var debug = true;
	if (!debug){
		regForm.onsubmit = validate; //To validate form.
	}


}

function init(){
	getDetails();
}

window.addEventListener('load', init);

	