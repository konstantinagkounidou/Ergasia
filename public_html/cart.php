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
				
				
			
			
			</div>
		
			<div id="content_area">
			
			<?php cart(); ?>
			
			
			<div id="shopping_cart"> 
					
					<span > <?php dispStats(); ?> </span>
			
			</div>
			
				<div id="products_box">
				
			<form action="" method="post" enctype="multipart/form-data">
			
				<table align="center" width="700" bgcolor="skyblue">
					
					<tr align="center">
						<th>Αφαίρεση</th>
						<th>Προιόντα</th>
						<th>Ποσότητα</th>
						<th>Συνολική αξία αγοράς</th>
					</tr>
			
		<?php 
		$total = 0;
		
		global $con; 
    	$ip = getIp();
    	
    	if(isloggedin()){
    	    $ce=$_SESSION['cid'];
    	    //$cp=$_SESSION['customer_password'];
    	    $sel_price = "select * from cart where customer_id='$ce'";
    	}
    	else{
    	    //$ip = getIp(); 
    		//t($ip);
    		$sel_price = "select * from cart where ip_add='$ip'AND customer_id='0' ";
    	}
    		
		$run_price = mysqli_query($con, $sel_price); 
		
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			if(isloggedin()){
			    
			    $qp= "select * from cart where p_id='$pro_id'AND customer_id='$ce' ";
			
			}
			else{
		    	$qp= "select * from cart where p_id='$pro_id' ";
			
			}
			
			$run_qp= mysqli_query($con,$qp);
			
			$qty1= mysqli_fetch_array($run_qp);
			
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
				//echo "<script>alert('$pro_id')</script>";
				$qty=$qty1['qty'];
				
				if($qty==0){
				    break;
				}
				
				$product_price = array($pp_price['product_price']*$qty);
				
				$product_title = $pp_price['product_title'];
				
				$product_image = $pp_price['product_image']; 
				
				$single_price = $pp_price['product_price']*$qty;
				
				$values = array_sum($product_price); 
				
				$total += $values; 
						
				
				echo "
					<tr align='center'>
						<td><input type='checkbox' name='remove[]' value=$pro_id></td>
						<td>$product_title<br>
							<img src='admin_area/product_images/$product_image' width='60' height='60'/>
						</td>
						
						<td >
								<div name='pqty1' >$qty </div>
								
						
							<div color=black>
            					<a href='cart.php?add_cart=$pro_id&add_cart_count=-1'style='text-decoration: none; color: blue;' >-1</a>
            					<a href='cart.php?add_cart=$pro_id&add_cart_count=+1'style='text-decoration: none; color: blue;'>+1</a>
						    </div>
						</td> 
						  
				
						
										
						
				
						<td>€  $single_price</td>
					</tr>";
		}
		}
			 ?>
				
				<tr>
						<td colspan="4" align="right"><b>Συνολική αξία:</b></td>
						<td><?php echo "€" . $total;?></td>
					</tr>
					
					<tr align="center">
						<td colspan="2"><input type="submit" href="cart.php?add_cart=$pro_id?add_cart_count=$qty" name="update_cart" value="Ανανέωση καλαθιού"/></td>
						<td><input type="submit" name="continue" value="Συνέχεια αγοράς" /></td>
						<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Πληρωμή</a></button></td>
					</tr>
					
				</table> 
			
			</form>
			
	<?php 
			//$p=$pro_list[0,0,0];
			//echo "<script>alert('$p')</script>";
						 
	function updatecart(){
		
		global $con; 
		
		$ip = getIp();
					
		if(isset($_POST['update_cart'])){
        			
			if(isloggedin()){
			    $c_id=$_SESSION['cid'];
			    foreach($_POST['remove'] as $remove_id){
			
        			$delete_product = "delete from cart where p_id='$remove_id' AND customer_id='$c_id' ";
        			$run_delete = mysqli_query($con, $delete_product); 
        			
        			if($run_delete){
        			
        			echo "<script>window.open('cart.php','_self')</script>";
        			
			        }
			    
			    }

			}
			else{
			    foreach($_POST['remove'] as $remove_id){
			
        			$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'AND customer_id='0' ";
        			$run_delete = mysqli_query($con, $delete_product); 
        			
        			if($run_delete){
        			
        			echo "<script>window.open('cart.php','_self')</script>";
        			
			        }
			    
			    }
			
			}
		
		}
		if(isset($_POST['continue'])){
		
		echo "<script>window.open('eshop.php','_self')</script>";
		
		}
	
			
	}
	echo @$up_cart = updatecart();
	
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