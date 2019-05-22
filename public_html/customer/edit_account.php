		<?php 	
		       // session_start();
				include("includes/db.php"); 
				
				$user = $_SESSION['customer_email'];
				
				$get_customer = "select * from customers where customer_email='$user'";
				
				$run_customer = mysqli_query($con, $get_customer); 
				
				$row_customer = mysqli_fetch_array($run_customer); 
				
				$c_id = $row_customer['customer_id'];
				$name = $row_customer['customer_name'];
				$email = $row_customer['customer_email'];
				$pass = $row_customer['customer_pass'];
				$country = $row_customer['customer_country'];
				$city = $row_customer['customer_city'];
				$contact = $row_customer['customer_contact'];
				$address= $row_customer['customer_address'];
			
				
				
		?>
			
		<form action="" method="post" enctype="multipart/form-data">
					
					<table align="center" width="750">
						
						<tr align="center">
							<td colspan="6"><h2>Ενημέρωση λογαριασμού</h2></td>
						</tr>
						
						<tr>
							<td align="right">Όνομα:</td>
							<td><input type="text" name="c_name" required/></td>
						</tr>
						
						<tr>
							<td align="right">Email:</td>
							<td><input type="text" name="c_email" required/></td>
						</tr>
						
						<tr>
							<td align="right">Κωδικός:</td>
							<td><input type="password" name="c_pass" required/></td>
						</tr>
						
						
						
						
						
						<tr>
							<td align="right">Χώρα:</td>
							<td>
							<select name="c_country">
								<option>Επιλογή Χώρας</option>
								<option>Ελλάδα</option>
								<option>Κύπρος</option>
								
							</select>
							
							</td>
						</tr>
						
						<tr>
							<td align="right">Πόλη:</td>
							<td><input type="text" name="c_city" required/></td>
						</tr>
						
						<tr>
							<td align="right">Επικοινωνία:</td>
							<td><input type="text" name="c_contact" required/></td>
						</tr>
						
						<tr>
							<td align="right">Διεύθυνση</td>
							<td><input type="text" name="c_address" required/></td>
						</tr>
						
						
					<tr align="center">
						<td colspan="6"><input type="submit" name="update" value="Ενημέρωση λογαριασμού" /></td>
					</tr>
					
					
					
					</table>
				
				</form>
		
		
		
	
<?php 
	if(isset($_POST['update'])){
	
		
		$ip = getIp();
		
		$customer_id = $c_id;
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
	
		
		
		
		 $update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass',customer_city='$c_city', customer_contact='$c_contact',customer_address='$c_address' where customer_id='$customer_id'";
	
		$run_update = mysqli_query($con, $update_c); 
		
		if($run_update){
		
		echo "<script>alert('Ο λογαριασμός σας επεξεργάστηκε επιτυχώς')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		
		}
	}





?>










