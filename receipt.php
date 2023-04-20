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
	<title>CameoAudio | Your Recepit</title>
	<link href="styles/style.css" rel="stylesheet" />
</head>



<body>
	<?php
		include "includes/menu.inc";
		if (isset($_SESSION["tableResult"])){
			$tableResult = $_SESSION["tableResult"];
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
		$productOrder = $_SESSION["Product_Order"];
		$quantity = $_SESSION["Quantity"];
		$date = $_SESSION["Date"];
		$daysHired = $_SESSION["Days_Hired"];
		$cost =  $_SESSION["cost"];
		$creditCard = $_SESSION["Credit_Card"];
		$ccName = $_SESSION["CC_Name"];
		$ccNumber = $_SESSION["CC_Number"];
		$masked =  str_pad(substr($ccNumber, -4), strlen($ccNumber), '*', STR_PAD_LEFT);
		$ccExpiry = $_SESSION["CC_Expiry"];
		$ccCVV = $_SESSION["CC_CVV"];
		echo "<h3>$tableResult</h3>";
	?>

	<h3>Thank you for choosing CameoAudio!!! We hope to see you soon again :)</h3>
	<h2>Your Order Summary</h2>
   	<form method="post" action="index.php" id="conf_form" novalidate="novalidate">
		<fieldset>
			<legend>Personal Details</legend>
			<p>Your Name : <?php echo "$firstname $lastname" ; ?></p>
			<p>Email ID : <?php echo $email; ?></p>
			<p>Phone Number : <?php echo $number; ?></p>
			<p>Address : <?php echo "$street, $suburb, $state, $postcode"; ?></p>
		</fieldset>

		<fieldset>
			<legend>Order Details</legend>
			<?php echo "You have ordered $quantity $productOrder for a period of $daysHired days starting from $date ."; ?>
			<p>Total cost : <?php echo "A$ $cost"; ?></p>
		</fieldset>

		<fieldset>
			<legend>Credit Card Details</legend>
			<p>Credit Card Company : <?php echo $creditCard; ?></p>
			<p>Name on Credit Card : <?php echo $ccName; ?></p>
			<p>Credit Card Number : <?php echo $masked; ?></p>
			<p>CVV Number : <?php echo "***"; ?></p>
		</fieldset>

		<p><input type="submit" id="Finish" value="Finish" class="buttonn" /></p>
	</form>


    <?php
    session_destroy();
  	include "includes/footer.inc";
  	?>

</body>
</html>
