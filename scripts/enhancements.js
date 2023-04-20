"use strict";

function brands(){
	var brand = document.getElementById("brandy");
	var product = document.getElementById("Product_Order").value;
	var text1 = document.getElementById("Brand_Names1");
	var text2 = document.getElementById("Brand_Names2");
	var text3 = document.getElementById("Brand_Names3");
	var text4 = document.getElementById("Brand_Names4");

	if (product == ""){
		brand.style.display = "none";
	}
	else{
		brand.style.display = "block";
		if (product == "Projectors"){
			text1.textContent = "Sanyo";
			text2.textContent = "Panasonic";
			text3.textContent = "Apple";
			text4.textContent = "";
		}
		if (product == "Display Screens"){
			text1.textContent = "LG";
			text2.textContent = "Samsung";
			text3.textContent = "";
			text4.textContent = "";
		}
		if (product == "Studio Lights"){
			text1.textContent = "Zanfi";
			text2.textContent = "";
			text3.textContent = "";
			text4.textContent = "";
		}
		if (product == "Speakers"){
			text1.textContent = "Bose";
			text2.textContent = "Meridian";
			text3.textContent = "JBL";
			text4.textContent = "Harman International";
		}
		if (product == "Microphones"){
			text1.textContent = "Sennheiser";
			text2.textContent = "Neumann";
			text3.textContent = "Schoeps";
			text4.textContent = "";
		}
		if (product == "Headphones"){
			text1.textContent = "Beats by Dr. Dre";
			text2.textContent = "";
			text3.textContent = "";
			text4.textContent = "";
		}
	}
	//The box data differs from product to product depending on selection. 
	
}

function init(){
	document.getElementById("dis_b").addEventListener("click", brands); //Display button.

}

window.addEventListener('load', init);

