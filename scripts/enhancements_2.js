"use strict";

function init(){
	document.getElementById("CC_Name").value = sessionStorage.firstname + " " + sessionStorage.lastname; //preloads the name on credit card. 
}

window.addEventListener('load', init);

