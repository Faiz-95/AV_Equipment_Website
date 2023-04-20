<!--
This PHP document shows the code for the Login Page of my website that.
It then verifies user input and displays the manage.php
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		session_start(); 
		include "includes/meta.inc";
	?>
	<title>CameoAudio | Manager Login</title>
	<link href="styles/style.css" rel="stylesheet">
</head>



<body>
	
	<?php
		include "includes/menu.inc";
	?>


	<h3 class="login_head">Manager Login</h3>
   	<form method="post" action="login_2.php" novalidate="novalidate">
		<fieldset id="login_form">
			<p><label for="Username">Username*</label>
			<input type="text" name= "Username" id="Username" size="30" /></p> 
			<label for="Password">Password**</label>
			<input type="password" name= "Password" id="Password" size="30" /></p><br />
			<input type="hidden" name="authenticate_2" id="authenticate_2" />
			<p>*Username can only contain letters and numbers.</p>
			<p>**Passwords must be atleast 8 characters long and must contain atleast one lowercase, one uppercase and one number.</p>
		</fieldset>
		<p class="login_button"><input type="submit" value="Login" id="login_buttonn" /></p>
	</form>

	<?php
		if (isset($_SESSION["forwardMsg"])){
			$forwardMsg = $_SESSION["forwardMsg"];
			echo "<h3 class='login_head'>$forwardMsg</h3>";
			session_destroy();
		}	
	?>


    <?php
  	include "includes/footer.inc";
  	?>

</body>
</html>
