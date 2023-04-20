
	<?php

		if ($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
        	header('HTTP/1.0 403 Forbidden', TRUE, 403);
        	die(header('location: login.php'));
    	}

		session_start();

		if (isset($_POST["authenticate_2"])){
			$continue_2 = ($_POST["authenticate_2"]);
			$_SESSION["authenticate_2"] = $continue_2;
		}

		$forwardMsg = "";
		$forward = true;

		if (isset($_POST["Username"])){
			$username = ($_POST["Username"]);
		}
		if (isset($_POST["Password"])){
			$password = ($_POST["Password"]);
		}
		if (($username == "") || ($password == "")){
			$forwardMsg .= "You must enter a Username and Password.<br />";
			$forward = false;
		}
		if ($username == $password){
			$forwardMsg .= "Username and Password need to be unique.<br />";
			$forward = false;
		}
		else {
			if (!preg_match('/^[A-Za-z][A-Za-z0-9]{1,31}$/', $username)){
			$forwardMsg .= "Invalid Username format.<br />";
			$forward = false;
			}
			if (!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)){
				$forwardMsg .= "Invalid Password format.<br />";
				$forward = false;
			}
		}

		if ($forward){
			require ('settings.php');
			$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
			if (!$conn) {
				echo "<h3 class='login_head'>Database connection failure</h3>"; 
			} 
			else {
				$sql_table = "managers";
				$query = "insert into managers VALUES ('$username','$password')";
				$result = mysqli_query($conn, $query);
				if (!$result){
					echo "<h3 class='login_head'>Something is wrong with ", $query, "</h3>";
				} 
				else {
					mysqli_close($conn);
					(header('location: manage.php'));
				}
			}
		}
		else {
			$_SESSION["forwardMsg"] = $forwardMsg;
			(header('location: login.php'));
		}
	?>
