<?php

    if ($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
        header('HTTP/1.0 403 Forbidden', TRUE, 403);
        die(header('location: enquire.php'));
    }

    session_start();

	function sanitise_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function calcCost($quantity, $days, $product){
		$cost = 0;
		if ($product == "Projectors"){
			$cost = ($quantity * $days * 21);
		}
		if ($product == "Display Screens"){
			$cost = ($quantity * $days * 44);
		}
		if ($product == "Studio Lights"){
			$cost = ($quantity * $days * 12);
		}
		if ($product == "Speakers"){
			$cost = ($quantity * $days * 77);
		}
		if ($product == "Microphones"){
			$cost = ($quantity * $days * 9);
		}
		if ($product == "Headphones"){
			$cost = ($quantity * $days * 23);
		}
		return $cost;
	}


	function split_num($postcode){
		$digits = (string)$postcode;
		$firstDigit = substr($digits, 0, 1);
		$firstDigit = (int)$firstDigit;
		return $firstDigit;
	}


	function postValidate($state, $first_digit){
		$errMsg = "";
		if ((($state == "NT")||($state == "ACT")) && ($first_digit != 0)){
			$errMsg .= "The selected state must match the first digit of the postcode.<br />";
		}
		if (($state == "WA") && ($first_digit != 6)){
			$errMsg .= "The selected state must match the first digit of the postcode.<br />";
		}
		if (($state == "SA") && ($first_digit != 5)){
			$errMsg .= "The selected state must match the first digit of the postcode.<br />";
		}
		if (($state == "TAS") && ($first_digit != 7)){
			$errMsg .= "The selected state must match the first digit of the postcode.<br />";
		}
		if ($state == "VIC"){
			if (($first_digit != 3) && ($first_digit != 8)){
				$errMsg .= "The selected state must match the first digit of the postcode.<br />";
			}
		}
		if ($state == "NSW"){
			if (($first_digit != 1) && ($first_digit != 2)){
				$errMsg .= "The selected state must match the first digit of the postcode.<br />";
			}
		}
		if ($state == "QLD"){
			if (($first_digit != 4) && ($first_digit != 9)){
				$errMsg .= "The selected state must match the first digit of the postcode.<br />";
			}
		}
		return $errMsg;
	}


	function visa_validate($number){
		$errMsg = "";
		$strNum = (string)$number;
		$lenNum = strlen($strNum);
		$digit = (int)$strNum[0];
		if ($lenNum != 16){
			$errMsg .= "Visa card numbers must be 16 digits.<br />";
		}
		if ($digit != 4){
			$errMsg .= "Visa card numbers start with a 4.<br />";
		}
		return $errMsg;
	}


	function mastercard_validate($number){
		$errMsg = "";
		$strNum = (string)$number;
		$lenNum = strlen($strNum);
		$digit = (int)($strNum[0].$strNum[1]);
		$list = [51,52,53,54,55];
		$j = 0;
		if ($lenNum != 16){
			$errMsg .= "Mastercard numbers must be 16 digits.<br />";
		}
		for ($i = 0; $i < 5; $i++){
			if ($digit != $list[$i]){
				$j = $j + 1;
			}
		}
		if ($j == 5){
			$errMsg .= "Mastercard numbers start with 51-55.<br />";
		}
		return $errMsg;
	}


	function amex_validate($number){ 
		$errMsg = "";
		$strNum = (string)$number;
		$lenNum = strlen($strNum);
		$digit = (int)$strNum[0].$strNum[1];
		if ($lenNum != 15){
			$errMsg .= "American Express card numbers must be 15 digits.<br />";
		}
		if (($digit != 34) && ($digit != 37)){
			$errMsg .= "American Express card numbers start with a 34 or 37.<br />";
		}
		return $errMsg;
	}

	$errMsg = "";
	$result = true;
	$secondResult = true;
	$thirdResult = true;
	$fourthResult = true;


	if (isset($_POST["authenticate"])){
	    $continue = $_POST["authenticate"];
	    $_SESSION["authenticate"] = $continue;
	}


	if (isset($_POST["First_Name"])){
	    $firstname = sanitise_input($_POST["First_Name"]);
	    $_SESSION["First_Name"] = $firstname;
	    if ($firstname == ""){
			$errMsg .= "Please enter a Firstname.<br />";
			$result = false;
		}
	    elseif (!preg_match("/^[a-zA-Z\s]*$/", $firstname)){
	    	$errMsg .= "Invalid Firstname.<br />";
	    	$result = false;
	    }
	    elseif (strlen($firstname) > 25){
	    	$errMsg .= "Firstname should be 25 characters or less.<br />";
	    	$result = false;
	    }
	}


	if (isset($_POST["Last_Name"])){
	    $lastname = sanitise_input($_POST["Last_Name"]);
	    $_SESSION["Last_Name"] = $lastname;
	    if ($lastname == ""){
			$errMsg .= "Please enter a Lastname.<br />";
			$result = false;
		}
	    elseif (!preg_match('/^[a-zA-Z\s]*$/', $lastname)){
	    	$errMsg .= "Invalid Lastname.<br />";
	    	$result = false;
	    }
	    elseif (strlen($lastname) > 25){
	    	$errMsg .= "Lastname should be 25 characters or less.<br />";
	    	$result = false;
	   	}
	}


	if (isset($_POST["Email_ID"])){
	    $email = sanitise_input($_POST["Email_ID"]);
	    $_SESSION["Email_ID"] = $email;
	    if ($email == ""){
			$errMsg .= "Please enter an Email ID.<br />";
			$result = false;
		}
	    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	  		$errMsg .= "Invalid Email format.<br />";
	  		$result = false;
		}
	}


	if (isset($_POST["Street_Address"])){
	    $street = sanitise_input($_POST["Street_Address"]);
	    $_SESSION["Street_Address"] = $street;
	    if ($street == ""){
			$errMsg .= "Please enter a Street Address.<br />";
			$result = false;
		}
	   	elseif ((!preg_match('/^[a-zA-Z0-9\s]+$/', $street)) || (strlen($street) > 40 )){
	    	$errMsg .= "Enter a valid Street Address.<br />";
	    	$result = false;
	    }
	}


	if (isset($_POST["Suburb/Town"])){
	    $suburb = sanitise_input($_POST["Suburb/Town"]);
	    $_SESSION["Suburb/Town"] = $suburb;
	    if ($suburb == ""){
			$errMsg .= "Please enter a Suburb/Town.<br />";
			$result = false;
		}
	    elseif ((!preg_match('/^[a-zA-Z\s]*$/', $suburb)) || (strlen($suburb) > 20 )){
	    	$errMsg .= "Enter a valid Suburb/Town.<br />";
	    	$result = false;
	   	}
	}


	if (isset($_POST["State"])){
    	$state = sanitise_input($_POST["State"]);
    	$_SESSION["State"] = $state;
    	if ($state == ""){
			$errMsg .= "Please select a State.<br />";
			$result = false;
			$secondResult = false;
		}
	}


	if (isset($_POST["Postcode"])){
    	$postcode = sanitise_input($_POST["Postcode"]);
    	$_SESSION["Postcode"] = $postcode;
    	$first_digit = split_num($postcode);
    	if ($postcode == ""){
			$errMsg .= "Please enter a Postcode.<br />";
			$result = false;
			$secondResult = false;
		}
    	elseif ((!preg_match('/^[0-9]+$/', $postcode)) || (strlen(strval($postcode)) != 4 )){
	    	$errMsg .= "Enter a valid Postcode.<br />";
	    	$result = false;
	    	$secondResult = false;
	   	}
	}



	if ($secondResult){
		$tempMsg = postValidate($state, $first_digit);
		if ($tempMsg != ""){
			$errMsg .= $tempMsg;
			$result = false;
		}
	}
	else {
		$errMsg .= "Postcode and State needs to be entered correctly for validation.<br />";
		$result = false;
	}


	if (isset($_POST["Phone_Number"])){
	    $number = sanitise_input($_POST["Phone_Number"]);
	    $_SESSION["Phone_Number"] = $number;
	    if ($number == ""){
			$errMsg .= "Please enter a Phone Number.<br />";
			$result = false;
		}
	    elseif ((!preg_match('/^[0-9]+$/', $number)) || (strlen(strval($number)) > 10 )){
	    	$errMsg .= "Enter a valid Phone Number.<br />";
	    	$result = false;
	    }
	}


	if (isset($_POST["Preferred_Contact"])){
    	$preferredContact = sanitise_input($_POST["Preferred_Contact"]);
    	$_SESSION["Preferred_Contact"] = $preferredContact;
    	if ($preferredContact == ""){
			$errMsg .= "Please select a Preferred Contact.<br />";
			$result = false;
		}
	}


	if (isset($_POST["Product_Info"])){
    	$productInfo = sanitise_input($_POST["Product_Info"]);
    	$_SESSION["Product_Info"] = $productInfo;
    }
    if (isset($_POST["Product_Features"])){
    	$productFeat = sanitise_input($_POST["Product_Features"]);
    	$_SESSION["Product_Features"] = $productFeat;
	}
	

	if (isset($_POST["Product_Order"])){
    	$productOrder = sanitise_input($_POST["Product_Order"]);
    	$_SESSION["Product_Order"] = $productOrder;
    	if ($productOrder == ""){
			$errMsg .= "Please select a Product to be ordered.<br />";
			$result = false;
			$fourthResult = false;
		}
	}


	if (isset($_POST["Quantity"])){
    	$quantity = sanitise_input($_POST["Quantity"]);
    	$_SESSION["Quantity"] = $quantity;
    	if ($quantity == ""){
			$errMsg .= "Please enter a Quantity.<br />";
			$result = false;
			$fourthResult = false;
		}
    	elseif (!preg_match('/^[0-9]+$/', $quantity)){
	    	$errMsg .= "Invalid Quantity.<br />";
	   		$result = false;
	   		$fourthResult = false;
	   	}
	   	elseif (((int)$quantity) < 1){
	   		$errMsg .= "Quantity should be more than 0.<br />";
	   		$result = false;
	   		$fourthResult = false;
	   	}
	}


	if (isset($_POST["Date"])){
    	$date = sanitise_input($_POST["Date"]);
    	$_SESSION["Date"] = $date;
    	if ($date == ""){
			$errMsg .= "Please select a date from the calender.<br />";
			$result = false;
		}
	}


	if (isset($_POST["Days_Hired"])){
    	$daysHired = sanitise_input($_POST["Days_Hired"]);
    	$_SESSION["Days_Hired"] = $daysHired;
    	if ($daysHired == ""){
			$errMsg .= "Please enter the number of Days of Hire.<br />";
			$result = false;
			$fourthResult = false;
		}
    	elseif (!preg_match('/^[0-9]+$/', $daysHired)){
	    	$errMsg .= "Invalid Days of Hire.<br />";
	   		$result = false;
	   		$fourthResult = false;
	   	}
	    elseif (((int)$daysHired) <= 0){
	    	$errMsg .= "Days of Hire should be more than 0.<br />";
	    	$result = false;
	    	$fourthResult = false;
	    }
	}


	if ($fourthResult){
		$cost = calcCost($quantity, $daysHired, $productOrder);
		$_SESSION["cost"] = $cost;
	}
	else {
		$errMsg .= "The product, quantity and days of hire need to be entered correctly to display total cost.<br />";
		$result = false;
	}


	if (isset($_POST["Credit_Card"])){
    	$creditCard = sanitise_input($_POST["Credit_Card"]);
    	$_SESSION["Credit_Card"] = $creditCard;
    	if ($creditCard == ""){
			$errMsg .= "Please select one of the Credit Card Company.<br />";
			$result = false;
			$thirdResult = false;
    	}
	}


	if (isset($_POST["CC_Name"])){
    	$ccName = sanitise_input($_POST["CC_Name"]);
    	$_SESSION["CC_Name"] = $ccName;
    	if ($ccName == ""){
			$errMsg .= "Please enter the name on your Credit Card.<br />";
			$result = false;
		}
	    elseif (!preg_match("/^[a-zA-Z\s]*$/", $ccName)){
	    	$errMsg .= "The name on the Credit Card can only be alphabetic characters.<br />";
	   		$result = false;
	   	}
	   	elseif (strlen($ccName) > 40){
	   		$errMsg .= "Maximum 40 characters allowed on Credit Card name.<br />";
	   		$result = false;
	   	}
	}


	if (isset($_POST["CC_Number"])){
    	$ccNumber = sanitise_input($_POST["CC_Number"]);
    	$_SESSION["CC_Number"] = $ccNumber;
    	if ($ccNumber == ""){
			$errMsg .= "Please enter your Credit Card number.<br />";
			$result = false;
			$thirdResult = false;
		}
    	elseif (!preg_match("/^[0-9]*$/", $ccNumber)){
	   		$errMsg .= "The number on the Credit Card can only be digits.<br />";
	   		$result = false;
	   		$thirdResult = false;
	   	}
	}


	if ($thirdResult){
		if ($creditCard == "Visa"){
			$temp_Msg = visa_validate($ccNumber);
			if ($temp_Msg != ""){
				$errMsg .= $temp_Msg;
				$result = false;
			}
		}
		if ($creditCard == "Mastercard"){
			$temp_Msg = mastercard_validate($ccNumber);
			if ($temp_Msg != ""){
				$errMsg .= $temp_Msg;
				$result = false;
			}
		}
		if ($creditCard == "American_Express"){
			$temp_Msg = amex_validate($ccNumber);
			if ($temp_Msg != ""){
				$errMsg .= $temp_Msg;
				$result = false;
			}
		}
	}
	else {
		$errMsg .= "Credit Card Company and Number needs to be entered correctly for validation.<br />";
		$result = false;
	}


	if (isset($_POST["CC_Expiry"])){
    	$ccExpiry = sanitise_input($_POST["CC_Expiry"]);
    	$_SESSION["CC_Expiry"] = $ccExpiry;
    	if ($ccExpiry == ""){
			$errMsg .= "Please enter the Credit Card Expiry date.<br />";
			$result = false;
		}
    	elseif (!preg_match("/^[0-9.-]{5}$/", $ccExpiry)){
	    	$errMsg .= "Invalid Credit Card expiry date.<br />";
	   		$result = false;
	   	}
	}


	if (isset($_POST["CC_CVV"])){
    	$ccCVV = sanitise_input($_POST["CC_CVV"]);
    	$_SESSION["CC_CVV"] = $ccCVV;
    	if ($ccCVV == ""){
			$errMsg .= "Please enter the CVV number given on the back of your Card.<br />";
			$result = false;
		}
    	elseif (!preg_match('/^[0-9]{3}$/', $ccCVV)){
    		$errMsg .= "Invalid CVV Number.<br />";
			$result = false;
    	}
	}


	if (isset($_POST["comments"])){
    	$comments = sanitise_input($_POST["comments"]);
    	$_SESSION["comments"] = $comments;
	}

	if (isset($_POST["feedback"])){
    	$feedback = sanitise_input($_POST["feedback"]);
    	$_SESSION["feedback"] = $feedback;
	}


	if ($result){
		require_once('settings.php');
		$tableResult = "";
		// The @ operator suppresses the display of any error messages
		// mysqli_connect returns false if connection failed, otherwise a connection value
		$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
		if ($conn){
			$sql_table = "orders";
		    $fieldDefinition = "order_id INT AUTO_INCREMENT PRIMARY KEY, order_fname VARCHAR(25) NOT NULL, order_lname VARCHAR(25) NOT NULL, order_email NVARCHAR(255) NOT NULL, order_phone VARCHAR(10) NOT NULL, order_street VARCHAR(40) NOT NULL, order_suburb VARCHAR(20) NOT NULL, order_state CHAR(3) NOT NULL, order_postcode INT(4) NOT NULL, order_contact VARCHAR(10) NOT NULL, order_product VARCHAR(20) NOT NULL, order_quantity INT(5) NOT NULL, order_time DATE NOT NULL, order_days INT(5) NOT NULL, order_date VARCHAR(15) NOT NULL, order_cost INT(10) NOT NULL, order_creditCard VARCHAR(20) NOT NULL, order_cardName VARCHAR(40) NOT NULL, order_cardNumber CHAR(16) NOT NULL, order_cardExpiry VARCHAR(5) NOT NULL, order_cardCVV INT(3) NOT NULL, order_status VARCHAR(20) DEFAULT 'PENDING'";	
			// check: if table does not exist, create it
			$sqlString = "show tables like '$sql_table'";  // another alternative is to just use 'create table if not exists ...'
			$result = @mysqli_query($conn, $sqlString);
			// checks if any tables of this name
			if (mysqli_num_rows($result) == 0){
				$sqlString = "CREATE TABLE " . $sql_table . "(" . $fieldDefinition . ")";
				$result2 = @mysqli_query($conn, $sqlString);
			  	// checks if the table was created
				if($result2 === false) {
					$tableResult .= "Unable to create Table orders ". msqli_errno($conn) . " : ". mysqli_error($conn) . "<br />"; 
				} 
				else {
					$tableResult .= "Table orders successfully created!!!<br />"; 
				}
			} 
			else {
				$tableResult .= "The table orders already exists!!!<br />";
			}
			$query = "insert into orders (order_fname, order_lname, order_email, order_phone, order_street, order_suburb, order_state, order_postcode, order_contact, order_product, order_quantity, order_time, order_days, order_date, order_cost, order_creditCard, order_cardName, order_cardNumber, order_cardExpiry, order_cardCVV) VALUES ('$firstname', '$lastname', '$email', '$number', '$street', '$suburb', '$state', '$postcode', '$preferredContact', '$productOrder', '$quantity', CURRENT_DATE, '$daysHired', '$date', '$cost', '$creditCard', '$ccName', '$ccNumber', '$ccExpiry', '$ccCVV')";
			$result = mysqli_query($conn, $query);
			if (!$result) {
				$tableResult .= "Something is wrong with ". $query . "<br />";   
			} 
			else {
				$tableResult .= "Your order has been successfully placed and the data has been stored in the orders table!!!<br />";
			}
			mysqli_close($conn);
		}
		else {
			$tableResult .= "Database connection failure. Try again!!!<br />";
		}
		$_SESSION["tableResult"] = $tableResult; 
		(header('location: receipt.php'));
	}
	else {
		$_SESSION["errMsg"] = $errMsg;
		(header('location: fix_order.php'));
	}

?>

