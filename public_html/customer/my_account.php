<?php header("content-type: text/html;charset=utf-8") ?>
<?php
session_start();
?>

<link rel="shortcut icon" type = "images/png" href="../images/c.png">
<?php 

 include("functions/functions.php");

?>
<html>
	<head>
		<title>Κατάστημα Coldplay</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
		
	<link rel="stylesheet" href="../styles/style.css" media="all" /> 
	</head>
	
<body>
	

	<div class="main_wrapper">
	
		<div class="header_wrapper">
		
			<a href="../eshop.php"><img id="logo" src="images/logo.gif" /> </a>
			
		</div>
	
		<div class="menubar">
			
			<ul id="menu">
			    
				<li><a href="../index.php"> Πίσω</a></li>
				<li><a href="../eshop.php">Αρχική</a></li>
				<li><a href="../all_products.php">Όλα τα προιόντα</a></li>
				<li><a href="../customer/my_account.php">Ο λογαριασμός μου</a></li>
				<li><a href="../cart.php">Καλάθι</a></li>
				
			
			</ul>
			
			
			
			
		</div>
		
		<div class="content_wrapper">
		
			<div id="sidebar">
			
				<div id="sidebar_title">Ο λογαριασμός μου:</div>
				
				<ul id="cats">
			
				
			
				
				
				
				
				<li><a href="my_account.php?my_orders">Οι παραγγελίες μου</a></li>
				<li><a href="my_account.php?edit_account">Επεξεργασία λογαριασμού</a></li>
				<li><a href="my_account.php?change_pass">Αλλαγή κωδικού</a></li>
				<li><a href="my_account.php?delete_account">Διαγραφή λογαριασμού</a></li>
				<li><a href="logout.php">Αποσύνδεση</a></li>
				
				<ul>
				
				</div>
					
		
			<div id="content_area">
			
			<?php cart(); ?>
			<?php 
				if(!isset($_SESSION['customer_email'])){
					
					$c_name= 'Πελάτη';
					//τεστινγ
					//echo "<script>alert('Συνδέθηκες επιτυχώς!')</script>";
				}
				else{
						$user = $_SESSION['customer_email'];
						$get_img = "select * from customers where customer_email='$user'";
						
						$run_img = mysqli_query($con, $get_img); 
						
						while($row_img = mysqli_fetch_array($run_img)){
						    $c_name=$row_img['customer_name'];
						}
						
				}
				
				
				
				?>
			
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:17px; padding:5px; line-height:40px;">
					
					<?php 
					
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='../checkout.php' style='color:orange;'>Είσοδος</a>";
					
					}
					
					
					
					
					?>
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Καλώς ήρθατε:</b>" . $_SESSION['customer_email'] ;
					
					}
					

					?>
					
					
					
					
					
					
					</span>
			</div>
			
				<div id="products_box">
				
				
				
				<?php 
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
							if(!isset($_GET['delete_account'])){
							
				echo "
				<h2 style='padding:20px;'>Καλώς ήρθατε: $c_name </h2>
				<b>Εξέλιξη παραγγελίας <a href='../cart.php'>Εδώ</a></b>";
				}
				}
				}
				}

				?>
				
				<?php 
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
				if(isset($_GET['delete_account'])){
				include("delete_account.php");
				}
				
				
				?>
				
				</div>
			
			</div>
		</div>
		
		
		
		
		<div id="footer">
		
		<h2 style="text-align:center; padding-top:30px;">&copy; 2019</h2>
		
		</div>
	
	
	
	
	
	
	</div> 



</body>
</html>