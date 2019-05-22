
<br>

<h2 style="text-align:center; ">Θέλεις να διαγράψεις τον λογαριασμό σου;</h2>

<form action="" method="post">

<br>
<input type="submit" name="yes" value="Ναι, θέλω" /> 
<input type="submit" name="no" value="'Όχι, δεν θέλω" />


</form>

<?php 
include("includes/db.php"); 

	//$user = $_SESSION['customer_email']; 
	$cid = $_SESSION['cid'];
	
	if(isset($_POST['yes'])){
	
	$delete_customer = "delete from customers where customer_id='$cid'";
	$delete_products = "delete from cart where customer_id='$cid' ";
	
	$run_customer = mysqli_query($con,$delete_customer); 
	$run_products = mysqli_query($con,$delete_products); 
	
	echo "<script>alert('Ο λογαριασμός σας διαγράφτηκε!')</script>";
	echo "<script>window.open('logout.php','_self')</script>";
	}
	if(isset($_POST['no'])){
	
	
	echo "<script>window.open('my_account.php','_self')</script>";
	
	}
	


?>