
<?php
	session_start();
	if (!isset($_SESSION["authenticate_2"])){
		(header('location: login.php'));
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include "includes/meta.inc";
		include "includes/menu.inc";
	?>
	<title>CameoAudio | Manage Orders</title>
	<link href="styles/style.css" rel="stylesheet" />
</head>



	<body>
		<h2>CameoAudio Management</h2>
		<h3>Manage Orders and Order Updates</h3>
		<a href="index.php"><p class='logout'>Log out</p></a>
		<form method="post" action="manage.php">
			<fieldset>
				<legend>Orders Search</legend>
				<p><input type="radio" name="manage_option" id="all_orders" value="all_orders"/>All Orders
				<p><input type="radio" name="manage_option" id="customer_orders" value="customer_orders" />Customer Orders
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="First_Name">First Name</label>
				<input type="text" name= "First_Name" id="First_Name" size="30" /> 
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="Last_Name">Last Name</label>
				<input type="text" name= "Last_Name" id="Last_Name" size="30" /></p>
				<p><input type="radio" name="manage_option" id="product_orders" value="product_orders" />Product Orders
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="Product_Order" id="Product_Order" >
			   	<option value="">None</option>	
			   	<option value="Projectors">Projectors</option>
			   	<option value="Display Screens">Display Screens</option>
			   	<option value="Studio Lights">Studio Lights</option>
			  	<option value="Speakers">Speakers</option>
			   	<option value="Microphones">Microphones</option>
			   	<option value="Headphones">Headphones</option>
			   	</select></p>
				<p><input type="radio" name="manage_option" id="pending_orders" value="pending_orders" />Pending Orders</p>
				<p><input type="radio" name="manage_option" id="cost_orders" value="cost_orders" />Order Cost Sorted</p>
				<p><input type="radio" name="manage_option" id="status_orders" value="status_orders" />Change Order Status
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				To : &nbsp;&nbsp;
				<select name="status" id="status" >
			   	<option value="PENDING">PENDING</option>
			   	<option value="FULFILLED">FULFILLED</option>
			   	<option value="PAID">PAID</option>
			  	<option value="ARCHIVED">ARCHIVED</option>
			   	</select>
			   	&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
			  	<label for="order">Order ID</label>
				<input type="number" id="order" name="order" min="1" max="100"></p>
				<p><input type="radio" name="manage_option" id="delete_orders" value="delete_orders" />Cancel an Order
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
			  	<label for="order">Order ID</label>
				<input type="number" id="order_2" name="order_2" min="1" max="100"></p>
			</fieldset>
		<p><input type="submit" id="result_orders" value="Show Results" class="buttonn" /></p>
		</form>
		<?php
			if (isset($_POST["manage_option"])){
				$option = ($_POST["manage_option"]);
				if (!$option == ""){
		        	require ('settings.php');
					$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
					function sanitise_input($data){
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}
					if (!$conn) {
						echo "<h3>Database connection failure</h3>"; 
					} 
					else {
						$sql_table = "orders";


						if ($option == "all_orders"){
							$query = "select order_id, order_fname, order_lname, order_time, order_product, order_quantity, order_days, order_date, order_cost, order_status FROM orders";
							$result = mysqli_query($conn, $query);
							if(!$result) {
								echo "<h3>Something is wrong with ", $query, "</h3>";
							} 
							else {
								if (mysqli_num_rows($result) >0 ){
									echo "<h3>Table for All Orders</h3>";
									echo "<table id='table_head' border='1'>";
									echo "<tr>\n"
										 ."<th scope='col'>Order ID</th>\n"
									     ."<th scope='col'>First Name</th>\n"
										 ."<th scope='col'>Last Name</th>\n"
										 ."<th scope='col'>Time of Order</th>\n"
										 ."<th scope='col'>Product</th>\n"
										 ."<th scope='col'>Quantity</th>\n"
										 ."<th scope='col'>Days Hired</th>\n"
										 ."<th scope='col'>Start of Hire</th>\n"
										 ."<th scope='col'>Total Cost</th>\n"
										 ."<th scope='col'>Order Status</th>\n"
										 ."</tr>\n";
									
									while ($row = mysqli_fetch_assoc($result)){
										echo "<tr>";
										echo "<td>",$row["order_id"],"</td>";
										echo "<td>",$row["order_fname"],"</td>";  
										echo "<td>",$row["order_lname"],"</td>";
										echo "<td>",$row["order_time"],"</td>";
										echo "<td>",$row["order_product"],"</td>";  
										echo "<td>",$row["order_quantity"],"</td>";  
										echo "<td>",$row["order_days"],"</td>";  
										echo "<td>",$row["order_date"],"</td>";  
										echo "<td>",$row["order_cost"],"</td>";  
										echo "<td>",$row["order_status"],"</td>";  
										echo "</tr>";
									}
									echo "</table>";
									mysqli_free_result($result);
								}
								else {
									echo "<h3>No records exist</h3>"; 
								}
							}
							mysqli_close($conn);
						}


						if ($option == "customer_orders"){
							if (isset($_POST["First_Name"])){
	    						$firstname = sanitise_input($_POST["First_Name"]);
	    					}
	    					if (isset($_POST["Last_Name"])){
	    						$lastname = sanitise_input($_POST["Last_Name"]);
	    					}
	    					if (($firstname == "") && ($lastname == "")){
								$query = "select null from orders where false;";
	    					}
	    					if (($firstname != "") && ($lastname == "")){
								$query = "select order_id, order_fname, order_lname, order_time, order_product, order_quantity, order_days, order_date, order_cost, order_status FROM orders WHERE order_fname like '%$firstname%'";
	    					}
	    					if (($firstname == "") && ($lastname != "")){
								$query = "select order_id, order_fname, order_lname, order_time, order_product, order_quantity, order_days, order_date, order_cost, order_status FROM orders WHERE order_lname like '%$lastname%'";
	    					}
	    					if (($firstname != "") && ($lastname != "")){
								$query = "select order_id, order_fname, order_lname, order_time, order_product, order_quantity, order_days, order_date, order_cost, order_status FROM orders WHERE order_fname like '%$firstname%' AND order_lname like '%$lastname%'";
	    					}
							$result = mysqli_query($conn, $query);
							if(!$result) {
								echo "<h3>Something is wrong with ", $query, "</h3>";
							} 
							else {
								if (mysqli_num_rows($result) >0 ){
									echo "<h3>Orders of $firstname $lastname</h3>";
									echo "<table id='table_head' border='1'>";
									echo "<tr>\n"
										 ."<th scope='col'>Order ID</th>\n"
										 ."<th scope='col'>First Name</th>\n"
										 ."<th scope='col'>Last Name</th>\n"
										 ."<th scope='col'>Time of Order</th>\n"
										 ."<th scope='col'>Product</th>\n"
										 ."<th scope='col'>Quantity</th>\n"
										 ."<th scope='col'>Days Hired</th>\n"
										 ."<th scope='col'>Start of Hire</th>\n"
										 ."<th scope='col'>Total Cost</th>\n"
										 ."<th scope='col'>Order Status</th>\n"
										 ."</tr>\n";
									
									while ($row = mysqli_fetch_assoc($result)){
										echo "<tr>";
										echo "<td>",$row["order_id"],"</td>";
										echo "<td>",$row["order_fname"],"</td>";
										echo "<td>",$row["order_lname"],"</td>";
										echo "<td>",$row["order_time"],"</td>";
										echo "<td>",$row["order_product"],"</td>";  
										echo "<td>",$row["order_quantity"],"</td>";  
										echo "<td>",$row["order_days"],"</td>";  
										echo "<td>",$row["order_date"],"</td>";  
										echo "<td>",$row["order_cost"],"</td>";
										echo "<td>",$row["order_status"],"</td>";   
										echo "</tr>";
									}
									echo "</table>";
									mysqli_free_result($result);
								}
								else {
									echo "<h3>No records exist</h3>"; 
								}
							}
							mysqli_close($conn);
						}


						if ($option == "product_orders"){
	    					if (isset($_POST["Product_Order"])){
	    						$product = sanitise_input($_POST["Product_Order"]);
	    						if ($product != ""){
									$query = "select order_id, order_fname, order_lname, order_time, order_quantity, order_days, order_date, order_cost, order_status FROM orders WHERE order_product='$product'";
									$result = mysqli_query($conn, $query);
									if(!$result) {
										echo "<h3>Something is wrong with ", $query, "</h3>";
									} 
									else {
										if (mysqli_num_rows($result) >0 ){
											echo "<h3>Orders for $product</h3>";
											echo "<table id='table_head' border='1'>";
											echo "<tr>\n"
												 ."<th scope='col'>Order ID</th>\n"
												 ."<th scope='col'>First Name</th>\n"
												 ."<th scope='col'>Last Name</th>\n"
												 ."<th scope='col'>Time of Order</th>\n"
												 ."<th scope='col'>Quantity</th>\n"
												 ."<th scope='col'>Days Hired</th>\n"
												 ."<th scope='col'>Start of Hire</th>\n"
												 ."<th scope='col'>Total Cost</th>\n"
												 ."<th scope='col'>Order Status</th>\n"
												 ."</tr>\n";
										
											while ($row = mysqli_fetch_assoc($result)){
												echo "<tr>";
												echo "<td>",$row["order_id"],"</td>";
												echo "<td>",$row["order_fname"],"</td>";
												echo "<td>",$row["order_lname"],"</td>";
												echo "<td>",$row["order_time"],"</td>";  
												echo "<td>",$row["order_quantity"],"</td>";  
												echo "<td>",$row["order_days"],"</td>";  
												echo "<td>",$row["order_date"],"</td>";  
												echo "<td>",$row["order_cost"],"</td>";
												echo "<td>",$row["order_status"],"</td>";   
												echo "</tr>";
											}
											echo "</table>";
											mysqli_free_result($result);
										}
										else {
											echo "<h3>No records exist</h3>"; 
										}
									}
									mysqli_close($conn);
								}
								else {
									echo "<h3>Please select a Product.<h3>";
								}
							}
						}


						if ($option == "pending_orders"){
							$query = "select order_id, order_fname, order_lname, order_time, order_product, order_quantity, order_days, order_date, order_cost FROM orders WHERE order_status='PENDING'";
							$result = mysqli_query($conn, $query);
							if(!$result) {
								echo "<h3>Something is wrong with ", $query, "</h3>";
							} 
							else {
								if (mysqli_num_rows($result) >0 ){
									echo "<h3>Pending Orders</h3>";
									echo "<table id='table_head' border='1'>";
									echo "<tr>\n"
										 ."<th scope='col'>Order ID</th>\n"
									     ."<th scope='col'>First Name</th>\n"
										 ."<th scope='col'>Last Name</th>\n"
										 ."<th scope='col'>Time of Order</th>\n"
										 ."<th scope='col'>Product</th>\n"
										 ."<th scope='col'>Quantity</th>\n"
										 ."<th scope='col'>Days Hired</th>\n"
										 ."<th scope='col'>Start of Hire</th>\n"
										 ."<th scope='col'>Total Cost</th>\n"
										 ."</tr>\n";
									
									while ($row = mysqli_fetch_assoc($result)){
										echo "<tr>";
										echo "<td>",$row["order_id"],"</td>";
										echo "<td>",$row["order_fname"],"</td>";  
										echo "<td>",$row["order_lname"],"</td>";
										echo "<td>",$row["order_time"],"</td>";
										echo "<td>",$row["order_product"],"</td>";  
										echo "<td>",$row["order_quantity"],"</td>";  
										echo "<td>",$row["order_days"],"</td>";  
										echo "<td>",$row["order_date"],"</td>";  
										echo "<td>",$row["order_cost"],"</td>";   
										echo "</tr>";
									}
									echo "</table>";
									mysqli_free_result($result);
								}
								else {
									echo "<h3>No records exist</h3>"; 
								}
							}
							mysqli_close($conn);
						}


						if ($option == "cost_orders"){
							$query = "select order_id, order_fname, order_lname, order_time, order_product, order_quantity, order_days, order_date, order_cost, order_status FROM orders ORDER BY order_cost DESC";
							$result = mysqli_query($conn, $query);
							if(!$result) {
								echo "<h3>Something is wrong with ", $query, "</h3>";
							} 
							else {
								if (mysqli_num_rows($result) >0 ){
									echo "<h3>Sort by cost of Orders</h3>";
									echo "<table id='table_head' border='1'>";
									echo "<tr>\n"
										 ."<th scope='col'>Order ID</th>\n"
									     ."<th scope='col'>First Name</th>\n"
										 ."<th scope='col'>Last Name</th>\n"
										 ."<th scope='col'>Time of Order</th>\n"
										 ."<th scope='col'>Product</th>\n"
										 ."<th scope='col'>Quantity</th>\n"
										 ."<th scope='col'>Days Hired</th>\n"
										 ."<th scope='col'>Start of Hire</th>\n"
										 ."<th scope='col'>Total Cost</th>\n"
										 ."<th scope='col'>Order Status</th>\n"
										 ."</tr>\n";
									
									while ($row = mysqli_fetch_assoc($result)){
										echo "<tr>";
										echo "<td>",$row["order_id"],"</td>";
										echo "<td>",$row["order_fname"],"</td>";  
										echo "<td>",$row["order_lname"],"</td>";
										echo "<td>",$row["order_time"],"</td>";
										echo "<td>",$row["order_product"],"</td>";  
										echo "<td>",$row["order_quantity"],"</td>";  
										echo "<td>",$row["order_days"],"</td>";  
										echo "<td>",$row["order_date"],"</td>";  
										echo "<td>",$row["order_cost"],"</td>"; 
										echo "<td>",$row["order_status"],"</td>";    
										echo "</tr>";
									}
									echo "</table>";
									mysqli_free_result($result);
								}
								else {
									echo "<h3>No records exist.</h3>"; 
								}
							}
							mysqli_close($conn);
						}


						if ($option == "status_orders"){
							if ((isset($_POST["status"])) && (isset($_POST["order"]))){
	    						$status = sanitise_input($_POST["status"]);
	    						$order = sanitise_input($_POST["order"]);
	    						if (($status != "") && ($order != "")){
									$query = "update orders set order_status='$status' where order_id='$order'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										echo "<h3>Something is wrong with ", $query, "</h3>";
									} 
									else {
										if (mysqli_affected_rows($conn) > 0){
											echo "<h3>Order Status of Order ID-$order successfully changed to $status.</h3>";
											$query_2 = "select order_id, order_fname, order_lname, order_time, order_product, order_quantity, order_days, order_date, order_cost, order_status FROM orders where order_id='$order'";
											$result_2 = mysqli_query($conn, $query_2);
											if (!$result_2){
												echo "<h3>Something is wrong with ", $query_2, "</h3>";
											}
											else {
												if (mysqli_num_rows($result_2) > 0 ){
													echo "<h3>New updated record...</h3>";
													echo "<table id='table_head' border='1'>";
													echo "<tr>\n"
														 ."<th scope='col'>Order ID</th>\n"
													     ."<th scope='col'>First Name</th>\n"
														 ."<th scope='col'>Last Name</th>\n"
														 ."<th scope='col'>Time of Order</th>\n"
														 ."<th scope='col'>Product</th>\n"
														 ."<th scope='col'>Quantity</th>\n"
														 ."<th scope='col'>Days Hired</th>\n"
														 ."<th scope='col'>Start of Hire</th>\n"
														 ."<th scope='col'>Total Cost</th>\n"
														 ."<th scope='col'>Order Status</th>\n"
														 ."</tr>\n";
									
													while ($row = mysqli_fetch_assoc($result_2)){
														echo "<tr>";
														echo "<td>",$row["order_id"],"</td>";
														echo "<td>",$row["order_fname"],"</td>";  
														echo "<td>",$row["order_lname"],"</td>";
														echo "<td>",$row["order_time"],"</td>";
														echo "<td>",$row["order_product"],"</td>";  
														echo "<td>",$row["order_quantity"],"</td>";  
														echo "<td>",$row["order_days"],"</td>";  
														echo "<td>",$row["order_date"],"</td>";  
														echo "<td>",$row["order_cost"],"</td>"; 
														echo "<td>",$row["order_status"],"</td>";    
														echo "</tr>";
													}
													echo "</table>";
													mysqli_free_result($result_2);
												}
											}
										}
										else {
											echo "<h3>No records exist.</h3>"; 
										}
									}
									mysqli_close($conn);
								}
								else {
									echo "<h3>Please set the new order Status and enter the Order ID.</h3>"; 
								}
							}
						}


						if ($option == "delete_orders"){
							if (isset($_POST["order_2"])){
	    						$order = sanitise_input($_POST["order_2"]);
	    						if ($order != ""){
									$query = "delete from orders where order_id='$order' and order_status='PENDING'";
									$result = mysqli_query($conn, $query);
									if(!$result) {
										echo "<h3>Something is wrong with ", $query, "</h3>";
									} 
									else {
										if (mysqli_affected_rows($conn) > 0){
											echo "<h3>Order successfully deleted.</h3>";
										}
										else {
											echo "<h3>Record cannot be deleted.</h3>"; 
										}
									}
									mysqli_close($conn);
								}
								else {
									echo "<h3>Please enter the Order ID to be deleted.</h3>"; 
								}
							}
						}
					}
				}
			}
		?>

	<?php
  		include "includes/footer.inc";
  	?>
	</body>
</html>