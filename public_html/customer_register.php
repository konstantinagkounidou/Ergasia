<?php header("content-type: text/html;charset=utf-8") ?>
<?php
session_start();
?>

<link rel="shortcut icon" type = "images/png" href="../images/c.png">
<?php 

include("functions/functions.php");
include("includes/db.php"); 
?>
<html>
	<head>
		<title>Κατάστημα Coldplay</title>
		
		
	<link rel="stylesheet" href="styles/style.css" media="all" /> 
	</head>
	
<body>
	
	
	<div class="main_wrapper">
	<div class="header_wrapper">
	<a href="eshop.php"><img id="logo" src="images/logo.gif" /> </a>
			
		</div>
		
		<div class="menubar">
			
			<ul id="menu">
			    <li><a href="Coldplay.php"> Πίσω</a></li>
				<li><a href="eshop.php">Αρχική</a></li>
				<li><a href="all_products.php">Όλα τα προιόντα</a></li>
				<li><a href="customer/my_account.php">Ο λογαριασμός μου</a></li>
				<li><a href="cart.php">Καλάθι</a></li>
			
			
			</ul>
			
			<div id="form">
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Αναζήτηση προιόντος"/ > 
					<input type="submit" name="search" value="Search" />
				</form>
			
			</div>
			
		</div>
	
		<div class="content_wrapper">
		
			<div id="sidebar">
			
				<div id="sidebar_title">Κατηγορίες</div>
				
				<ul id="cats">
				
				<?php getCats(); ?>
				
				
			
			</div>
		
			<div id="content_area">
			
			<?php cart(); ?>
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
					Καλώς ήρθες!<b style="color:yellow">Καλάθι-</b>  Συνολικά αντικείμενα: <?php total_items();?>  Συνολικό ποσό: <?php total_price(); ?> <a href="cart.php" style="color:yellow">Στο καλάθι</a>

					
					
					
					</span>
			</div>
			
				<form action="customer_register.php" method="post" enctype="multipart/form-data">
					
					<table align="center" width="750">
						
						<tr align="center">
							<td colspan="6"><h2>Δημιουργία λογαριασμού</h2></td>
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
						<td colspan="6"><input type="submit" name="register" value="Δημιουργία Λογαριασμού" /></td>
					</tr>
					
					
					
					</table>
				
				</form>
			
			</div>
		</div>
	
		
		
		
		<div id="footer">
		
		<h2 style="text-align:center; padding-top:30px;">&copy; 2019</h2>
		
		</div>
	
	</div> 



</body>
</html>
<?php 
	if(isset($_POST['register'])){
	
		
		$ip = getIp();
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
	
		
		
		 $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address')";
	
		$run_c = mysqli_query($con, $insert_c); 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$sel_c = "select * from customers where customer_email='$c_email'";
		$run_c = mysqli_query($con, $sel_c); 
		
		$c_ida=mysqli_fetch_array($run_c);
		$c_id=$c_ida['customer_id'];
		$_SESSION['cid']=$c_id;
		
		$check_cart = mysqli_num_rows($run_cart); 
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('Ο λογαριασμός δημιουργήθηκε επιτυχώς! $c_id')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		/*
		if($check_cart==0){
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('Ο λογαριασμός δημιουργήθηκε επιτυχώς!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('Ο λογαριασμός δημιουργήθηκε επιτυχώς!')</script>";
		
		echo "<script>window.open('checkout.php','_self')</script>";
		
		
		}
		*/
	}







?>










