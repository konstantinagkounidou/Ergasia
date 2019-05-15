<?php
// session_start();
?>

<link rel="shortcut icon" type = "images/png" href="../images/c.png">
<?php 


 include("includes/db.php");
?>

<div> 
	
	<form method="post" action=""> 
		
		<table width="500" align="center" bgcolor="skyblue"> 
			
			<tr align="center">
				<td colspan="3">
					<h2>Σύνδεση ή Εγγραφή</h2>
					<p id="mesg"> </p>
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Email:</b></td>
				<td><input type="text" name="email" placeholder="Εισαγωγή email" required/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Κωδικός:</b></td>
				<td><input type="password" name="pass" placeholder="Εισαγωγή Κωδικού" required/></td>
			</tr>
			
			
			
			<tr align="center">
				<td colspan="3"><input type="submit" name="login" value="Σύνδεση" /></td>
			</tr>
			
		
		
		</table> 
	
			<h2 style="float:right; padding-right:20px;"><a href="customer_register.php" style="text-decoration:none;">Καινούργιος; Κάνε εγγραφή εδώ</a></h2>
	
	
	</form>
	
	
	<?php 
	if(isset($_POST['login'])){
	
		$c_email = $_POST['email'];
		$c_pass = $_POST['pass'];
		
		$sel_c = "select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
		$run_c = mysqli_query($con, $sel_c);
		$check_customer = mysqli_num_rows($run_c); 
		/*
		$sel_id = "select customer_contact from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
		$run_id = mysqli_query($con, $sel_id);
		$c_id = mysqli_num_rows($run_id);
		*/
		$ca=mysqli_fetch_array($run_c);
		$c_id=$ca['customer_id'];
		$_SESSION['cid']=$c_id;
		//t($c_id);
		
		if($check_customer==0){
		
		echo "<script>document.getElementById('mesg').innerHTML = 'Λάθος Στοιχεία';</script>";
		exit();
		}
		$ip = getIp(); 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_customer>0 AND $check_cart==0){
		
		$_SESSION['customer_email']=$c_email; 
		
		//echo "<script>alert('Συνδέθηκες επιτυχώς!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		$_SESSION['customer_email']=$c_email; 
		
		//echo "<script>alert('Συνδέθηκες επιτυχώς!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
		
		
		}
	}
	
	
	?>

	
	

</div>