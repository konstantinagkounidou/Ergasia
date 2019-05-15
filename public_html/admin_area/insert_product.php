<?php header("content-type: text/html;charset=utf-8") ?>
<!DOCTYPE>
<?php
include("includes/db.php");
?>


<html>
	<head>
		<title>Εισαγωγή</title> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
	</head>
	
<body bgcolor="skyblue">


	<form action="insert_product.php" method="post" enctype="multipart/form-data"> 
		
		<table align="center" width="795" border="2" bgcolor="#187eae">
			
			<tr align="center">
				<td colspan="7"><h2>Εισαγωγή</h2></td>
			</tr>
			
			<tr>
				<td align="right"><b>Τίτλος Προιόντος:</b></td>
				<td><input type="text" name="product_title" size="60" required/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Κατηγορία προιόντος</b></td>
				<td>
				<select name="product_cat" >
					<option>Επιλογή κατηγορίας</option>
					<?php 
		$get_cats = "select * from categories";
	
		$run_cats = mysqli_query($con, $get_cats);
	
		while ($row_cats=mysqli_fetch_array($run_cats)){
	
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
	
		echo "<option value='$cat_id'>$cat_title</option>";
	
	
	}
					
					?>
				</select>
				
				
				</td>
			</tr>
			
			
			
			<tr>
				<td align="right"><b>Εικόνα προιόντος:</b></td>
				<td><input type="file" name="product_image" /></td>
			</tr>
			
			<tr>
				<td align="right"><b>Τιμή προιόντος:</b></td>
				<td><input type="text" name="product_price" required/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Περιγραφή Προιόντος:</b></td>
				<td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
			</tr>
			<tr>
				<td align="right"><b>Product Keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50" /></td>
			</tr>
			
			<tr align="center">
				<td colspan="7"><input type="submit" name="insert_post" value="Εισαγωγή προιόντος"/></td>
			</tr>
		
		</table>
	
	
	</form>


</body> 
</html>
<?php 
	//header('Content-type: text/html; charset=utf-8');
	if(isset($_POST['insert_post'])){
	
		$product_cat= $_POST['product_cat'];
		$product_title = $_POST['product_title'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];
	
		
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		
		move_uploaded_file($product_image_tmp,"product_images/$product_image");
	
		 $insert_product = "insert into products (product_cat,product_title,product_price,product_desc,product_image,product_keywords) values ('$product_cat','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
		 
		 $insert_pro = mysqli_query($con, $insert_product);
		 
		 if($insert_pro){
		 
		 echo "<script>alert('Product Has been inserted!')</script>";
		 //echo "<script>window.open('eshop.php?insert_product','_self')</script>";
		 
		 }
	}








?>



