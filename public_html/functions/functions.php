<?php 
//header('Content-type: text/html; charset=utf-8');
$con = mysqli_connect("localhost","id9568648_eshop","eshop","id9568648_eshop");



  function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
  
  
  
//creating the shopping cart
function cart(){

	if(isset($_GET['add_cart'])){

		global $con; 
		
		$ip = getIp();
		//t($ip);
		$pro_id = $_GET['add_cart'];
        
        if(isloggedin()){
            $c_id=$_SESSION['cid'];
			$check_pro = "select * from cart where customer_id='$c_id' AND p_id='$pro_id'";
		}
        else{
            $check_pro = "select * from cart where ip_add='$ip' AND customer_id='0' AND p_id='$pro_id'";
		}
        
		$run_check = mysqli_query($con, $check_pro); 
		
		if(mysqli_num_rows($run_check)!=0){
			
				
		    if(isset($_GET['add_cart_count'])){
		        $count=$_GET['add_cart_count'];
			}
		    else{
		        $count=1;
		    }
			
			if(isloggedin()){
			    //$c_id=$_SESSION['cid'];
			    $update_pro ="update cart set qty=qty+$count where customer_id='$c_id' AND p_id='$pro_id' ";
			    mysqli_query($con,$update_pro);
			
		    }
	    	else{
			    $update_pro ="update cart set qty=qty+$count where ip_add='$ip' AND customer_id='0' AND p_id='$pro_id' ";
			    mysqli_query($con,$update_pro);
			
		    }
		
			
			echo "<script>window.open('cart.php','_self')</script>";
		}
			
			//echo "<script>alert('$a $b $c')</script>";
		
    	else {
    		if(isloggedin()){
    		    $c_id=$_SESSION['cid'];
    		    $insert_pro = "insert into cart (p_id,ip_add,qty,customer_id) values ('$pro_id','$ip','1','$c_id')";
    		    $run_pro = mysqli_query($con, $insert_pro); 
    		    
    		}
    		else{
    		    $insert_pro = "insert into cart (p_id,ip_add,qty,customer_id) values ('$pro_id','$ip','1','0')";
    		    $run_pro = mysqli_query($con, $insert_pro); 
    		    
    		}
    		
    		
    		echo "<script>window.open('eshop.php','_self')</script>";
    	}
    	
	}	
    
}
 // getting the total added items
 
 function total_items(){
 
 	global $con; 
	$ip = getIp(); 
	$count_items=0;
	if(isloggedin()){
	    $c_id=$_SESSION['cid'];
	    
	    $get_items = "select * from cart where customer_id='$c_id'";
		$run_items = mysqli_query($con, $get_items); 
		while($items=mysqli_fetch_array($run_items)){
		    $item_qty=$items['qty'];
		    
		    $count_items += $item_qty;
		    
		}
		
	}
	else{
		$get_items = "select * from cart where ip_add='$ip' AND customer_id='0'";
		$run_items = mysqli_query($con, $get_items); 
		while($items=mysqli_fetch_array($run_items)){
		    $item_qty=$items['qty'];
		    
		    $count_items += $item_qty;
		    
		}
		    
	}
    
	echo $count_items." ";
	}
	
 // Getting the total price of the items in the cart 
	
	function total_price(){
	
		$total = 0;
		
		global $con; 
		
		$ip = getIp(); 
		
		
		if(isloggedin()){
		    $c_id=$_SESSION['cid'];
		    
		    $sel_price = "select * from cart where customer_id='$c_id'";
    		$run_price = mysqli_query($con, $sel_price); 
    		
    		while($p_price=mysqli_fetch_array($run_price)){
    			
    			$pro_id = $p_price['p_id']; 
    			$pro_qty =$p_price['qty'];
    			
    			$pro_price = "select * from products where product_id='$pro_id'";
    			$run_pro_price = mysqli_query($con,$pro_price); 
    			
    			while ($pp_price = mysqli_fetch_array($run_pro_price)){
        			
        			$product_price = array($pp_price['product_price']*$pro_qty);
        			$values = array_sum($product_price);
        			
        			$total +=$values;
        			
    			}
		    
		    }
		}
		else{
    		    
    		$sel_price = "select * from cart where ip_add='$ip' AND customer_id='0'";
    		$run_price = mysqli_query($con, $sel_price); 
    		
    		while($p_price=mysqli_fetch_array($run_price)){
    			
    			$pro_id = $p_price['p_id']; 
    			$pro_qty =$p_price['qty'];
    			
    			$pro_price = "select * from products where product_id='$pro_id'";
    			$run_pro_price = mysqli_query($con,$pro_price); 
    			
    			while ($pp_price = mysqli_fetch_array($run_pro_price)){
        			
        			$product_price = array($pp_price['product_price']*$pro_qty);
        			$values = array_sum($product_price);
        			
        			$total +=$values;
        			
    			}
		
		    }
		
		}
		
		echo " €" . $total."   ";
		
	}

//getting the categories

function getCats(){
	
	global $con; 
	// mysql_query($con,"SET NAMES 'utf8'");
	// mysql_query($con,"SET CHARACTER SET 'utf8'");
	
	$get_cats = "select * from categories";
	
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats=mysqli_fetch_array($run_cats)){
		
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
		
		//testing
		//echo "<script type='text/javascript'>alert('$cat_title[0]');</script>";
		
		echo "<li>
						<a href='eshop.php?cat=$cat_id'>$cat_title</a>
				</li>";
	
	}

}



function getPro(){

	if(!isset($_GET['cat'])){
		

	global $con; 
	
	$get_pro = "select * from products order by product_price";

	$run_pro = mysqli_query($con, $get_pro); 
	
		while($row_pro=mysqli_fetch_array($run_pro)){
			
			//$s="";
			$pro_id = $row_pro['product_id'];
			$pro_cat = $row_pro['product_cat'];
			$pro_title = $row_pro['product_title'];
			$pro_price = $row_pro['product_price'];
			$pro_image = $row_pro['product_image'];
			
			echo "
					<div id='single_product'>
					
						<div id='single_product_title'>$pro_title</div>
						
						<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						
						<p><b> Τιμή:  € $pro_price </b></p>
						
						<a href='details.php?pro_id=$pro_id' style='float:left; '>Λεπτομέρειες</a>
						
						<a href='eshop.php?add_cart=$pro_id'><button style='float:right'>Προσθήκη στο καλάθι </button></a>
					
					</div>
			
					";
		
		}
	}
}

function t($a){
	//$name=$_GET['name'];
	echo "<script>alert('$a')</script>";
}


function getCatPro(){

	if(isset($_GET['cat'])){
		
		$cat_id = $_GET['cat'];

		global $con; 
		
		$get_cat_pro = "select * from products where product_cat='$cat_id'";

		$run_cat_pro = mysqli_query($con, $get_cat_pro); 
		
		$count_cats = mysqli_num_rows($run_cat_pro);
		
		if($count_cats==0){
		
		echo "<h2 style='padding:20px;'>Δεν βρέθηκαν αντικείμενα για αυτήν την κατηγορία!</h2>";
		
		}
		
		while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
		
			$pro_id = $row_cat_pro['product_id'];
			$pro_cat = $row_cat_pro['product_cat'];
			$pro_title = $row_cat_pro['product_title'];
			$pro_price = $row_cat_pro['product_price'];
			$pro_image = $row_cat_pro['product_image'];
		
			echo "
					<div id='single_product'>
					
						<h3>$pro_title</h3>
						
						<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						
						<p><b>  € $pro_price </b></p>
						
						<a href='details.php?pro_id=$pro_id' style='float:left;'>Λεπτομέρειες</a>
						
						<a href='eshop.php?pro_id=$pro_id'><button style='float:right'>Προσθήκη στο καλάθι</button></a>
					
					</div>
			
			";
		}
	}
}

function isloggedin(){
    if(isset($_SESSION['customer_email'])){
        return true;   
    }
}

function dispStats(){
	
	if(isset($_SESSION['customer_email'])){
		
		echo "<b>Καλώς ήρθατε: </b>" . $_SESSION['customer_email'] . "   | " ;
		echo "<b style='color:yellow'>Καλάθι: </b>Συνολικά αντικείμενα: ";  total_items();
		echo "<b>Συνολικό ποσό: </b>"; total_price(); 
	//	echo "<b>___</b>";
		echo "<a href='logout.php' class='button b' >Έξοδος</a>";
		
	}
	else {
		
		echo "<b>Καλώς ήρθατε επισκέπτη! </b>" . "   | ";
		echo "<b style='color:yellow'>Καλάθι: </b>Συνολικά αντικείμενα: ";  total_items();
		echo "<b>Συνολικό ποσό: </b>"; total_price(); 
	//	echo "<b>___</b>";
		echo "<a href='checkout.php' class='button b' >Είσοδος </a>";
		
	}
	
	echo "<a href='cart.php' class='button a'>Στο καλάθι </a>";

}

function proDisp($pro_id,$pro_title,$pro_image,$pro_price,$pro_desc){	
	
	echo "
			<div class='display'>
			
				<h3>$pro_title</h3>
				
				<img src='admin_area/product_images/$pro_image' width='400' height='300' />
				
				<p><b> € $pro_price </b></p>
				
				<b>Περιγραφή προιόντος:   </b> $pro_desc 
				
				<a href='eshop.php' style='float:left;'>Πίσω</a>
				
				<a href='eshop.php?pro_id=$pro_id'><button style='float:right'>Προσθήκη στο καλάθι</button></a>
			
			</div>
	
	
	";
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	




?>