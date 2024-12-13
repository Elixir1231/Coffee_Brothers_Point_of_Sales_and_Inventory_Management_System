<?php 
include 'server/connection.php';

if(isset($_POST['product'])){
	$user = $_SESSION['username'];
	$discount = $_POST['discount'];
	$total = $_POST['totalvalue'];
	$price = $_POST['price'];
	$product = $_POST['product'];
	$customer = $_POST['customer'];
	$quantity = $_POST['quantity'];
	$reciept = array();
	
	$query = '';
	$customer_id = mysqli_query($db, "SELECT customer_id FROM customer WHERE CONCAT(firstname,' ',lastname) LIKE '$customer'");

	if(mysqli_num_rows($customer_id) == 0){
		echo "failure";
	}else{
		$cust_id 	= mysqli_fetch_array($customer_id);
		$cust_id_new = $cust_id['customer_id'];

		$sql = "INSERT INTO sales(customer_id,username,discount,total) VALUES($cust_id_new,'$user',$discount, $total)";
		$result = mysqli_query($db,$sql);

		if($result == true){
			$select = "SELECT reciept_no FROM sales ORDER BY reciept_no DESC LIMIT 1";
			$res = mysqli_query($db,$select);
			$id = mysqli_fetch_array($res);
			for($i = 0;  $i < count($product); $i++){
				$reciept[] = $id[0];
			}

			for($num=0; $num<count($product); $num++){
				$product_id = mysqli_real_escape_string($db, $product[$num]);
				$qtyold = mysqli_real_escape_string($db, $quantity[$num]);

				// Retrieve ingredient quantities needed for this product
				$ingredient_query = "SELECT ingredient_id, quantity FROM product_ingredients WHERE product_id='$product_id'";
				$ingredient_result = mysqli_query($db, $ingredient_query);

				// Deduct the ingredient quantities from inventory
				while($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
					$ingredient_id = $ingredient_row['ingredient_id'];
					$ingredient_quantity = $ingredient_row['quantity'] * $qtyold;

					$update_ingredient_query = "UPDATE ingredients SET quantity = quantity - $ingredient_quantity WHERE ingredient_id = $ingredient_id";
					mysqli_query($db, $update_ingredient_query);
				}

				// Update product quantity
				$sql2 = "UPDATE products SET quantity = quantity - $qtyold WHERE product_no='$product_id'";
				$result2 = mysqli_query($db, $sql2);
			}

			$query1 = "INSERT INTO logs (username,purpose) VALUES('$user','Product sold')";
	 		$insert = mysqli_query($db,$query1);

			for($count = 0; $count < count($product); $count++){
				$price_clean = mysqli_real_escape_string($db, $price[$count]);
				$reciept_clean = mysqli_real_escape_string($db, $reciept[$count]);
				$product_clean = mysqli_real_escape_string($db, $product[$count]);
				$quantity_clean = mysqli_real_escape_string($db, $quantity[$count]);
				if($product_clean != '' && $quantity_clean != '' && $price_clean != '' && $reciept_clean != ''){
					$query .= "
						INSERT INTO sales_product(reciept_no,product_id,price,qty) 
						VALUES($reciept_clean,$product_clean,$price_clean,$quantity_clean);
						";
				}
			} 
		}else{
			echo "failure";
		}
	
		if ($query != ''){
			if(mysqli_multi_query($db,$query)){
				echo "success";
			}else{
				echo "failure";
			}
		}else{
			echo 'failure';
		}
	}
} 
?>
