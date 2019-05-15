<?php header("content-type: text/html;charset=utf-8") ?>
<?php session_start(); ?>

<link rel="shortcut icon" type = "images/png" href="../images/c.png">

<?php include("functions/functions.php"); ?>
<html>
	<head>
		<title>Κατάστημα Coldplay</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
		
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
					
					<?php getPro(); ?>
					<?php getCatPro(); ?>
				
				</div>
			
			
			</div>
		</div>
		
		
		
		<div id="footer">
		
		<h2 style="text-align:center; padding-top:30px;">&copy; 2019 </h2>
		
		</div>
	
	
	
	
	
	
	</div> 

</body>
</html>