"use strict";

function exit(){
 	sessionStorage.clear();
 	location.href = "index.php"; //The user has cancelled order.
}

function init(){
	var cancelOrder = document.getElementById("Cancel");
	cancelOrder.onclick = exit; //To exit page.
}

window.addEventListener('load', init);

	