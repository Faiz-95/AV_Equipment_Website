"use strict";

function feed(){
	var fd = "";
	if (document.getElementById("0").checked){
		fd = document.getElementById("0").value;
	}
	else if (document.getElementById("1").checked){
		fd = document.getElementById("1").value;
	}
	else if (document.getElementById("2").checked){
		fd = document.getElementById("2").value;
	}
	else if (document.getElementById("3").checked){
		fd = document.getElementById("3").value;
	}
	else if (document.getElementById("4").checked){
		fd = document.getElementById("4").value;
	}
	return fd;
}

function allFeature(){
	var f ="";
	var feat1 = document.getElementById("feature1");
	var feat2 = document.getElementById("feature2");
	var feat3 = document.getElementById("feature3");
	var feat4 = document.getElementById("feature4");
	var feat5 = document.getElementById("feature5");

	if (feat1.checked){
		f += "Shipping, ";
	}
	if (feat2.checked){
		f += "Stock, ";
	}
	if (feat3.checked){
		f += "Payment, ";
	}
	if (feat4.checked){
		f += "Offers, ";
	}
	if (feat5.checked){
		f += "Cost, ";
	}
	return f;
}


function prefContact(){
	var cntc = "";
	if (document.getElementById("PC_Email").checked){
		cntc = document.getElementById("PC_Email").value;
	}
	else if (document.getElementById("PC_Post").checked){
		cntc = document.getElementById("PC_Post").value;
	}
	else if (document.getElementById("PC_Phone").checked){
		cntc = document.getElementById("PC_Phone").value;
	}
	return cntc;
}

function custDetails(){
	var postcode = document.getElementById("Postcode").value;
	var state = document.getElementById("State").value;

	var quantity = document.getElementById("Quantity").value;

	var hire = document.getElementById("Days_Hired").value;

	var firstname = document.getElementById("First_Name").value;
	var lastname = document.getElementById("Last_Name").value;
	var email = document.getElementById("Email_ID").value;

	var streetAddress = document.getElementById("Street_Address").value;
	var suburb = document.getElementById("Suburb/Town").value;

	var phone = document.getElementById("Phone_Number").value;
	var contact = prefContact(); 			//this function is used to check which preferred contact option has been chosen.
	var features = allFeature(); 			//this function is used to check the different product features that have been checked by the user.
	var comments = document.getElementById("comments").value;
	var feedback = feed();					//this function is used to check which emoji has been selected.

	var prod_info = document.getElementById("Product_Info").value;

	var product = document.getElementById("Product_Order").value;
	var date = document.getElementById("Date").value;
	var authenticate = "continue";

	sessionStorage.authenticate = authenticate;
	sessionStorage.firstname = firstname;
	sessionStorage.lastname = lastname;
	sessionStorage.email = email;
	sessionStorage.streetAddress = streetAddress;
	sessionStorage.suburb = suburb;
	sessionStorage.state = state;
	sessionStorage.postcode = postcode;
	sessionStorage.phone = phone;
	sessionStorage.contact = contact;
	sessionStorage.prodInfo = prod_info;
	sessionStorage.features = features;
	sessionStorage.comments = comments;
	sessionStorage.feedback = feedback;
	sessionStorage.product = product;
	sessionStorage.quantity = quantity;
	sessionStorage.date = date;
	sessionStorage.hire = hire;
	sessionStorage.fullAddress = streetAddress + ", " + suburb + ", " + state + ", " + postcode;
	//All data now has successfully been saved to sessionStorage
	//and will now be used in payment.html
}

function split_num(postcode){
	var output = [];
	var sNumber = postcode.toString();
	for (var i = 0,len = sNumber.length; i < len; i +=1){
		output.push(+sNumber.charAt(i));
	}
	return parseInt(output[0]);
}

function validate(){
	var errMsg = "";
	var result = true;

	var postcode = document.getElementById("Postcode").value;
	var state = document.getElementById("State").value;

	var first_digit = split_num(postcode);

	var quantity = document.getElementById("Quantity").value;
	var newQuantity = parseInt(quantity);

	var hire = document.getElementById("Days_Hired").value;
	var newHire = parseInt(hire);


	if (((state == "NT")||(state == "ACT")) && (first_digit != 0)){
		errMsg += "The selected state must match the first digit of the postcode.\n";
		result = false;
	}
	if ((state == "WA") && (first_digit != 6)){
		errMsg += "The selected state must match the first digit of the postcode.\n";
		result = false;
	}
	if ((state == "SA") && (first_digit != 5)){
		errMsg += "The selected state must match the first digit of the postcode.\n";
		result = false;
	}
	if ((state == "TAS") && (first_digit != 7)){
		errMsg += "The selected state must match the first digit of the postcode.\n";
		result = false;
	}
	if (state == "VIC"){
		if ((first_digit != 3) && (first_digit != 8)){
			errMsg += "The selected state must match the first digit of the postcode.\n";
			result = false;
		}
	}
	if (state == "NSW"){
		if ((first_digit != 1) && (first_digit != 2)){
			errMsg += "The selected state must match the first digit of the postcode.\n";
			result = false;
		}
	}
	if (state == "QLD"){
		if ((first_digit != 4) && (first_digit != 9)){
			errMsg += "The selected state must match the first digit of the postcode.\n";
			result = false;
		}
	}


	if (quantity == ""){
		errMsg += "Please enter a quantity.\n";
		result = false;
	}
	if (isNaN(quantity)){
		errMsg += "Please enter a valid quantity that is a number.\n";
		result = false;
	}
	if (newQuantity <= 0){
		errMsg += "Please enter a quantity more than 0.\n";
		result = false;
	}

	if (hire == ""){
		errMsg += "Please enter the number of days of hire.\n";
		result = false;
	}
	if (isNaN(hire)){
		errMsg += "Please enter a valid number of hire days.\n";
		result = false;
	}
	if (newHire <= 0){
		errMsg += "The number of days of hire must be more than 0.\n";
		result = false;
	}


	if (errMsg != ""){
		alert(errMsg);
	}
	return result;
}

function init(){
	var regForm = document.getElementById("regform"); //get ref to the HTML element
	regForm.onsubmit = custDetails; 		
}

window.addEventListener('load', init);

	