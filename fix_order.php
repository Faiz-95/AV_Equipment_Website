<?php
	session_start();
	if (!isset($_SESSION["authenticate"])){
		(header('location: enquire.php'));
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include "includes/meta.inc";
	?>
	<title>CameoAudio | Recheck Order</title>
	<script src="scripts/part2_2.js"></script>
	<link href="styles/style.css" rel="stylesheet" />
</head>



<body>
	<?php
		include "includes/menu.inc";
		if (isset($_SESSION["errMsg"])){
			$errMsg = $_SESSION["errMsg"];
		}	
		$firstname = $_SESSION["First_Name"];
		$lastname = $_SESSION["Last_Name"];
		$email = $_SESSION["Email_ID"];
		$street = $_SESSION["Street_Address"];
		$suburb = $_SESSION["Suburb/Town"];
		$state = $_SESSION["State"];
		$postcode = $_SESSION["Postcode"];
		$number = $_SESSION["Phone_Number"];
		$preferredContact = $_SESSION["Preferred_Contact"];
		$productInfo = $_SESSION["Product_Info"];
		$productFeat = $_SESSION["Product_Features"];
		$creditCard = $_SESSION["Credit_Card"];
		$ccName = $_SESSION["CC_Name"];
		$ccNumber = $_SESSION["CC_Number"];
		$ccExpiry = $_SESSION["CC_Expiry"];
		$ccCVV = $_SESSION["CC_CVV"];
		$productOrder = $_SESSION["Product_Order"];
		$quantity = $_SESSION["Quantity"];
		$date = $_SESSION["Date"];
		$daysHired = $_SESSION["Days_Hired"];
		echo "<h3>The following errors have been found. Kindly fill the form below using the correct credentials. </h3><p id='errors'><mark>";
		echo $errMsg;
		echo "</mark></p><hr />";
	?>



    <h2>Order Placement</h2>
   	<h3>Please resubmit your personal and product details and enter your Credit Card Information. </h3>
   	<form method="post" action="process_order.php" id="conf_form" novalidate="novalidate">
		<fieldset>
			<legend>Personal Details</legend>
			<p><label for="First_Name">First Name</label>
			<input value="<?php echo $firstname; ?>" type="text" name= "First_Name" id="First_Name" required="required" size="30" pattern="^[a-zA-Z ]+$"/> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label for="Last_Name">Last Name</label>
			<input value="<?php echo $lastname; ?>" type="text" name= "Last_Name" id="Last_Name" required="required" size="30" pattern="^[a-zA-Z ]+$" /></p>
			<p><label for="Email_ID">Email Address</label>
			<input value="<?php echo $email; ?>" type="email" name= "Email_ID" id="Email_ID" required="required" size="30" /></p>
		</fieldset>

		<fieldset>
			<legend>Address</legend>
			<p><label for="Street_Address">Street Address</label>
			<input value="<?php echo $street; ?>" type="text" name= "Street_Address" id="Street_Address" required="required" size="40" /></p>
			<p><label for="Suburb/Town">Suburb/Town</label>
			<input value="<?php echo $suburb; ?>" type="text" name= "Suburb/Town" id="Suburb/Town" required="required" size="20" /></p>
			<p><label for="State" >State</label>
			   <select name="State" id="State" required="required">
			   <?php
			   		if ($state == ""){
			   			echo "<option value='' selected='selected'>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "VIC"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC' selected='selected'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "NSW"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW' selected='selected'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "QLD"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD' selected='selected'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "NT"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT' selected='selected'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "WA"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA' selected='selected'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "SA"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA' selected='selected'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "TAS"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS' selected='selected'>TAS</option>";
			   			echo "<option value='ACT'>ACT</option>";
			   		}
			   		if ($state == "ACT"){
			   			echo "<option value=''>Options</option>";
			   			echo "<option value='VIC'>VIC</option>";
			  			echo "<option value='NSW'>NSW</option>";
			   			echo "<option value='QLD'>QLD</option>";
			   			echo "<option value='NT'>NT</option>";
			   			echo "<option value='WA'>WA</option>";
			  	 		echo "<option value='SA'>SA</option>";
			   			echo "<option value='TAS'>TAS</option>";
			   			echo "<option value='ACT selected='selected'>ACT</option>";
			   		}
			   ?>
			   </select></p>
			<p><label for="Postcode">Postcode</label>
			<input value="<?php echo $postcode; ?>" type="text" name= "Postcode" id="Postcode" required="required" size="10" pattern="\d{4}" /></p>
		</fieldset>

		<fieldset>
			<legend >Contact Details</legend>
			<p><label for="Phone_Number">Phone Number</label>
			<input value="<?php echo $number; ?>" type="tel" name= "Phone_Number" id="Phone_Number" required="required" size="20" pattern="\d{10}" placeholder="(##) ####-####" />
			</p>
			<p><label>Preferred Contact</label><br />
			<?php
				if ($preferredContact == ""){
					echo "<input type='radio' name='Preferred Contact' id='PC_Email' value='Email' />Email";
					echo "<input type='radio' name='Preferred Contact' id='PC_Post' value='Post'  />Post";
					echo "<input type='radio' name='Preferred Contact' id='PC_Phone' value='Phone' />Phone";
				}
				if ($preferredContact == "Email"){
					echo "<input type='radio' name='Preferred Contact' id='PC_Email' value='Email' checked='checked' />Email";
					echo "<input type='radio' name='Preferred Contact' id='PC_Post' value='Post'  />Post";
					echo "<input type='radio' name='Preferred Contact' id='PC_Phone' value='Phone' />Phone";
				}
				if ($preferredContact == "Post"){
					echo "<input type='radio' name='Preferred Contact' id='PC_Email' value='Email' />Email";
					echo "<input type='radio' name='Preferred Contact' id='PC_Post' value='Post' checked='checked' />Post";
					echo "<input type='radio' name='Preferred Contact' id='PC_Phone' value='Phone' />Phone";
				}
				if ($preferredContact == "Phone"){
					echo "<input type='radio' name='Preferred Contact' id='PC_Email' value='Email' />Email";
					echo "<input type='radio' name='Preferred Contact' id='PC_Post' value='Post'  />Post";
					echo "<input type='radio' name='Preferred Contact' id='PC_Phone' value='Phone' checked='checked' />Phone";
				}
			?>
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
			</select></p>
			<p><label for="Quantity">Quantity</label>
			<input value="<?php echo $quantity; ?>" type="text" name= "Quantity" id="Quantity" size="10" maxlength="3" /></p>
			<p><label for="Date">Select a date you wish to hire from :</label>
  			<input value="<?php echo $date; ?>" type="date" id="Date" name="Date" required="required"></p>
  			<p><label for="Days_Hired">Number of days of hire</label>
			<input value="<?php echo $daysHired; ?>" type="text" name= "Days_Hired" id="Days_Hired" size="10" required="required" /></p>			
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
		</fieldset>

		<p><input type="submit" id="Proceed" value="Proceed Checkout" class="buttonn" />
		<input type="reset" value="Clear" class="buttonn"/></p>
	</form>

    <?php
  	include "includes/footer.inc";
  	?>

</body>
</html>
