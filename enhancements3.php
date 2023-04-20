<!--
This PHP document shows the code for the 2 PHP-MySQL Enhancements used in my website.
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
    include "includes/meta.inc";
    include "includes/menu.inc";
  ?>
	<title>CameoAudio | PHP Enhacements</title>
	<link href="styles/style.css" rel="stylesheet" />
</head>


<body>

  <h2>The following PHP enhancements have been used : </h2>
  <ol class="text_info">
     <li><h3>Manager Login</h3>
        In the first enhancement, I have added an extra level of security to the manage.php page by requiring a unique 
        <a href="login.php#login_form" class="enhance_link"><strong>Manager Username and Password</strong></a> 
        to be entered by the user. There is also a specific rule checking for the username and password that is mentioned on the Login page. If the submission is successful, the values are stored in the 'managers' table in MySQL and can proceed managing the order tables. Once logged in, the manager can use the logout link to sign-out.<br /><br />
    </li>
    <li><h3>Product Table MySQL link</h3>
       In the second enhancement, I have utilized the PHP-MySQL link to fetch values from a 'products' table and display it on the page in the
        <a href="product.php#Diff_Prd" class="enhance_link"><strong>Product Range Table</strong></a> 
       dynamically rather than using the table element of html. Using this method is more advantageous as now, it is easier to change the values in the table using MySQL and consequently, it will automatically change the values of the table on the website, hence reducing the hastle of the Web Page Developer.
       <br /><br />
    </li>
  </ol>


  <?php
  	include "includes/footer.inc";
  ?>

</body>
</html>
