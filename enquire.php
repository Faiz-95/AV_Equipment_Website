<!--
This PHP document shows the code for the Product Enquiry and Order Page of my website that uses <form> to  accept input from the user.
It then submits the accepted data to payment.php
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include "includes/meta.inc";
	?>
	<title>CameoAudio | Product Enquiry</title>
	<link href="styles/style.css" rel="stylesheet">
	<script src="scripts/enhancements.js"></script>
	<script src="scripts/part2.js"></script>
</head>



<body>
	
	<?php
		include "includes/menu.inc";
	?>


    <h2>Product Enquiry and Order</h2>
   	<h3>We would love to get in touch with you!  Fill the form below and our team will get in touch with you shortly. </h3>
   	<form method="post" action="payment.php" id="regform" novalidate="novalidate">
		<fieldset>
			<legend>Personal Details</legend>
			<p><label for="First_Name">First Name</label>
			<input type="text" name= "First_Name" id="First_Name" required="required" size="30" pattern="^[a-zA-Z ]+$"/> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label for="Last_Name">Last Name</label>
			<input type="text" name= "Last_Name" id="Last_Name" required="required" size="30" pattern="^[a-zA-Z ]+$" /></p>
			<p><label for="Email_ID">Email Address</label>
			<input type="email" name= "Email_ID" id="Email_ID" required="required" size="30" /></p>
		</fieldset>

		<fieldset>
			<legend>Address</legend>
			<p><label for="Street_Address">Street Address</label>
			<input type="text" name= "Street_Address" id="Street_Address" required="required" size="40" /></p>
			<p><label for="Suburb/Town">Suburb/Town</label>
			<input type="text" name= "Suburb/Town" id="Suburb/Town" required="required" size="20" /></p>
			<p><label for="State" >State</label>
			   <select name="State" id="State" required="required">
			   <option value="" selected="selected">Options</option>
			   <option value="VIC">VIC</option>
			   <option value="NSW">NSW</option>
			   <option value="QLD">QLD</option>
			   <option value="NT">NT</option>
			   <option value="WA">WA</option>
			   <option value="SA">SA</option>
			   <option value="TAS">TAS</option>
			   <option value="ACT">ACT</option>
			   </select></p>
			<p><label for="Postcode">Postcode</label>
			<input type="text" name= "Postcode" id="Postcode" required="required" size="10" pattern="\d{4}" /></p>
		</fieldset>

		<fieldset id="cntc">
			<legend >Contact Details</legend>
			<p><label for="Phone_Number">Phone Number</label>
			<input type="tel" name= "Phone_Number" id="Phone_Number" required="required" size="20" pattern="\d{10}" placeholder="(##) ####-####" />
			</p>
			<p><label>Preferred Contact</label><br />
			<input type="radio" name="Preferred Contact" id="PC_Email" value="Email" required="required" />Email
			<input type="radio" name="Preferred Contact" id="PC_Post" value="Post" required="required" />Post
			<input type="radio" name="Preferred Contact" id="PC_Phone" value="Phone" required="required" />Phone</p>
		</fieldset>

		<aside id="charge">
    		<h3>Charges (1 unit / day)</h3>
    		Projectors		-   21A$<br>
    		Display Screens	-	44A$<br>
    		Studio Lights	-	12A$<br>
    		Speakers		-	77A$<br>
    		Microphones		-	9A$<br>
    		Headphones		-	23A$<br>
  		</aside>

		<fieldset class="smallfield">
			<legend>Product Information</legend>
			<p><label>Select a Product</label>
			<select name="Product_Info" id="Product_Info" required="required" >
			   <option value="" selected="selected">None</option>	
			   <option value="Projectors">Projectors</option>
			   <option value="Display Screens">Display Screens</option>
			   <option value="Studio Lights">Studio Lights</option>
			   <option value="Speakers">Speakers</option>
			   <option value="Microphones">Microphones</option>
			   <option value="Headphones">Headphones</option>
			   </select></p>
			<p><label>Product Features</label><br />
			<label><input type="checkbox" name="Product_Features" id="feature1" value="Shipping" />Shipping</label>
			<label><input type="checkbox" name="Product_Features" id="feature2" value="Stock" />Stock</label>
			<label><input type="checkbox" name="Product_Features" id="feature3" value="Payment" />Payment</label>
			<label><input type="checkbox" name="Product_Features" id="feature4" value="Offers" />Offers</label>
			<label><input type="checkbox" name="Product_Features" id="feature5" value="Cost" />Cost</label></p>
			<p><label>Leave a message : <br /><br /><textarea name="comments" id="comments" rows="5" cols="50"></textarea></label></p>
		</fieldset>

		<fieldset class="smallfield">
			<legend>Order Placement</legend>
			<p id="enhance_button"><label>Select a Product</label>
			<select name="Product_Order" required="required" id="Product_Order" >
			   <option value="">None</option>	
			   <option value="Projectors">Projectors</option>
			   <option value="Display Screens">Display Screens</option>
			   <option value="Studio Lights">Studio Lights</option>
			   <option value="Speakers">Speakers</option>
			   <option value="Microphones">Microphones</option>
			   <option value="Headphones">Headphones</option>
			   </select>
			   <input type="button" value="Display Brands" id="dis_b"/></p>
			   <input type="hidden" name="Brands" id="Brands" />
			<p><label for="Quantity">Quantity</label>
			<input type="text" name= "Quantity" id="Quantity" size="10" maxlength="3" /></p>
			<p><label for="Date">Select a date you wish to hire from :</label>
  			<input type="date" id="Date" name="Date" required="required"></p>
  			<p><label for="Days_Hired">Number of days of hire</label>
			<input type="text" name= "Days_Hired" id="Days_Hired" size="10" required="required" /></p>			
		</fieldset>

		<aside id="brandy">
			<h3>Brand Names</h3>
    		<p><span id="Brand_Names1" class="BN"></span></p>
    		<p><span id="Brand_Names2" class="BN"></span></p>
    		<p><span id="Brand_Names3" class="BN"></span></p>
    		<p><span id="Brand_Names4" class="BN"></span></p>
  		</aside>

		<div class="app">
  		<h3 id="satisfaction">Are you satisfied with our services?</h3>
  		<div class="emoji_feed">
    		<div class="item">
      			<label for="0">
      			<input class="emoji5" type="radio" name="feedback" id="0" value="Highly Dissatisfied">
      			<span>😡</span>
    			</label>
   		 	</div>

    	<div class="item">
      		<label for="1">
      		<input class="emoji5" type="radio" name="feedback" id="1" value="Dissatisfied">
      		<span>🙁</span>
    		</label>
    	</div>

    	<div class="item">
      		<label for="2">
      		<input class="emoji5" type="radio" name="feedback" id="2" value="Neutral">
      		<span>😐</span>
    	</label>
    	</div>

    	<div class="item">
      		<label for="3">
      		<input class="emoji5" type="radio" name="feedback" id="3" value="Satisfied">
      		<span>😌</span>
    	</label>
    	</div>

    	<div class="item">
      		<label for="4">
      		<input class="emoji5" type="radio" name="feedback" id="4" value="Highly Satisfied">
      		<span>😄</span>
    	</label>
    	</div>
  		</div>
		</div>

		<input type="hidden" name="authenticate" id="authenticate" />
		<p><input type="submit" value="Pay Now" class="buttonn" />
		<input type="reset" value="Clear" class="buttonn"/></p>
	</form>


    <?php
  	include "includes/footer.inc";
  	?>

</body>
</html>
