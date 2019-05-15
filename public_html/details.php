<?php header("content-type: text/html;charset=utf-8") ?>
<?php session_start(); ?>

<link rel="shortcut icon" type = "images/png" href="../images/c.png">
<?php include("functions/functions.php");?>

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
			    <li><a href="index.php"> Πίσω</a></li>
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
		
			<div class="content_wrapper">
			
				<div id="sidebar">
				
					<div id="sidebar_title">Κατηγορίες</div>
					
					<ul id="cats">
					
						<?php getCats(); ?>
					
					</ul>
					
				</div>
			
			
				<div id="content_area">
					
					<?php cart(); ?>
					
					<div id="shopping_cart"> 
							
							<span > <?php dispStats(); ?> </span>
					
					</div>
				
					<div id="products_box">
						
						<?php 
							if(isset($_GET['pro_id'])){
								
								$product_id = $_GET['pro_id'];
								
								$get_pro = "select * from products where product_id='$product_id'";

								$run_pro = mysqli_query($con, $get_pro); 
								
								while($row_pro=mysqli_fetch_array($run_pro)){
								
									$pro_id = $row_pro['product_id'];
									$pro_title = $row_pro['product_title'];
									$pro_price = $row_pro['product_price'];
									$pro_image = $row_pro['product_image'];
									$pro_desc = $row_pro['product_desc'];
								
									proDisp($pro_id,$pro_title,$pro_image,$pro_price,$pro_desc);
								
								}
							}
						?>
					
					</div>
				
			</div>
		</div>
		
		
		
		
		<div id="footer">
		
		<h2 style="text-align:center; padding-top:30px;">&copy; 2019 </h2>
		
		</div>
	
	
	
	
	
	
	</div> 


</body>
</html>