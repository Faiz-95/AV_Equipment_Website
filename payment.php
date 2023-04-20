<!--
This PHP document shows the code for the Order Confirmation Page of my website that uses session storage to receive data from enquire.php
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include "includes/meta.inc";
	?>
	<title>CameoAudio | Order Confirmation</title>
	<link href="styles/style.css" rel="stylesheet" />
	<script src="scripts/part2_2.js"></script>
	<script src="scripts/part2_3.js"></script>
	<script src="scripts/enhancements_2.js"></script>
</head>



<body>
	
	<?php
		include "includes/menu.inc";
	?>


    <h2>Order Confirmation</h2>
   	<h3>Please check your personal and product details and enter your Credit Card Information. </h3>
   	<form method="post" action="process_order.php" id="conf_form" novalidate="novalidate">
		<fieldset>
			<legend>Personal Details</legend>
			<p>Your Name : <span id="confirm_name"></span></p>
			<p>Email ID : <span id="confirm_email"></span></p>
			<p>Phone Number : <span  id="confirm_phone"></span></p>
			<p>Address : <span id="confirm_address"></span></p>
			<input type="hidden" name= "First_Name" id="First_Name" /> 
			<input type="hidden" name= "Last_Name" id="Last_Name" />
			<input type="hidden" name= "Email_ID" id="Email_ID" />
			<input type="hidden" name= "Phone_Number" id="Phone_Number" />
			<input type="hidden" name= "Street_Address" id="Street_Address" />
			<input type="hidden" name= "Suburb/Town" id="Suburb/Town" />
			<input type="hidden" name ="State" id="State" />
			<input type="hidden" name= "Postcode" id="Postcode" />
			<input type="hidden" name="Preferred_Contact" id="Preferred_Contact" />
			<input type="hidden" name="Product_Info" id="Product_Info" />
			<input type="hidden" name="Product_Features" id="Product_Features" />
		</fieldset>

		<fieldset>
			<legend>Order Details</legend>
			<p>Product Ordered : <span  id="confirm_product"></span></p>
			<p>Quantity : <span  id="confirm_quantity"></span></p>
			<p>Date of Hire : <span  id="confirm_date"></span></p>
			<p>Number of Days : <span  id="confirm_days"></span></p>
			<p>Total Cost : <span  id="confirm_cost"></span></p>
			<input type="hidden" name="Product_Order" id="Product_Order" />
			<input type="hidden" name= "Quantity" id="Quantity" />
			<input type="hidden" name="Date" id="Date" />
			<input type="hidden" name= "Days_Hired" id="Days_Hired" />
			<input type="hidden" name="Cost" id="Cost" />
		</fieldset>

		<fieldset>
			<legend>Credit Card Details</legend>
			<p><label for="Credit_Card" >Credit Card Type</label>
			   <select name="Credit_Card" id="Credit_Card" required="required">
			   <option value="">Options</option>
			   <option value="Visa">Visa</option>
			   <option value="Mastercard">Mastercard</option>
			   <option value="American_Express">American Express</option>
			   </select></p>
			<p><label for="CC_Name">Cardholder Name</label>
			<input type="text" name= "CC_Name" id="CC_Name" required="required" size="40" /></p>
			<p><label for="CC_Number">Card Number</label>
			<input type="text" name= "CC_Number" id="CC_Number" required="required" size="25" /></p>
			<p><label for="CC_Number">Expiration </label>
			<input type="text" name= "CC_Expiry" id="CC_Expiry" required="required" size="10" placeholder="mm-yy" pattern="([0-9]{2}[-]?){2}" /></p>
			<p><label for="CC_CVV">Card Verification Number (CVV)</label>
			<input type="text" name= "CC_CVV" id="CC_CVV" required="required" size="10" pattern="\d{3}" /></p>
			<input type="hidden" name="comments" id="comments" />
			<input type="hidden" name="feedback" id="feedback" />
			<input type="hidden" name="authenticate" id="authenticate" />
		</fieldset>

		<p><input type="submit" id="Proceed" value="Proceed Checkout" class="buttonn" />
		<input type="button" id="Cancel" value="Cancel Order" class="buttonn" /></p>
	</form>

    <?php
  	include "includes/footer.inc";
  	?>

</body>
</html>
