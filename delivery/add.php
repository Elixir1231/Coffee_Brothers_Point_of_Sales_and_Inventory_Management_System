<?php 
	include('../server/connection.php');

	if(isset($_POST['barcode'])){
		$barcode 	= $_POST['barcode'];
		$product 	= $_POST['ingredient_name']; // Change 'product_name' to 'ingredient_name'
		$qty 		= $_POST['quantity'];
		$buy_price 	= $_POST['buy_price'];
		$unit 		= $_POST['unit'];
		$tax		= $_POST['tax_rate'];
		$min_qty 	= $_POST['min_qty'];
		// $sell_price = $_POST['sell_price']; // Remove 'sell_price' field
		$remarks 	= $_POST['remarks'];
		$location 	= $_POST['location'];
		$supplier 	= mysqli_real_escape_string($db,$_POST['supplier']);
		$transaction_no = mysqli_real_escape_string($db,$_POST['order_no']); // Change 'transaction_no' to 'order_no'
		$user 		= mysqli_real_escape_string($db,$_SESSION['username']);
		$transaction = array();
		$insert = '';

		$search = "SELECT supplier_id FROM supplier WHERE company_name = '$supplier'";
		$show = mysqli_query($db,$search);
		
		if(mysqli_num_rows($show) == 0 || $show == false){
			echo "failure";
		}else{
			$row = mysqli_fetch_array($show);
			$supplier_1 = $row['supplier_id'];
			$sql = "INSERT INTO delivery(transaction_no,supplier_id,username) VALUES('$transaction_no',$supplier_1,'$user')";
			$result = mysqli_query($db, $sql);

			$insert1 = "INSERT INTO logs (username,purpose) VALUES('$user','Delivery Added')";
			$res = mysqli_query($db, $insert1);
			if($res == true){
				for($count = 0; $count<count($_POST['barcode']); $count++){
					$transaction[] = $transaction_no;
				}
				for($num= 0; $num < count($_POST['barcode']); $num++){
					$transaction1 	= mysqli_real_escape_string($db, $transaction[$num]);
					$barcode_1		= mysqli_real_escape_string($db, $barcode[$num]);
					$product_1		= mysqli_real_escape_string($db, $product[$num]);
					$qty_1 			= mysqli_real_escape_string($db, $qty[$num]);
					$buy_price_1	= mysqli_real_escape_string($db, $buy_price[$num]);
					$unit_1			= mysqli_real_escape_string($db, $unit[$num]);
					$tax_1			= mysqli_real_escape_string($db, $tax[$num]);
					$min_qty_1 		= mysqli_real_escape_string($db, $min_qty[$num]);
					// $sell_price_1 	= mysqli_real_escape_string($db, $sell_price[$num]); // Remove 'sell_price' field
					$remarks_1 		= mysqli_real_escape_string($db, $remarks[$num]);
					$location_1 	= mysqli_real_escape_string($db, $location[$num]);

					$query = "SELECT ingredient_id,quantity FROM ingredients WHERE ingredient_id='$barcode_1'"; // Change 'product_no' to 'ingredient_id'
					$result1 = mysqli_query($db, $query);
					if(mysqli_num_rows($result1)>0){
						while($row = mysqli_fetch_array($result1)){
							$newqty = $row['quantity'] + $qty_1;
							$query1 = "UPDATE ingredients SET ingredient_name='$product_1',quantity = $newqty,unit = '$unit_1',min_stocks=$min_qty_1, description='$remarks_1' WHERE ingredient_id = '$barcode_1'"; // Modify the query to update ingredients table
							mysqli_query($db, $query1);
						}
						$insert .= "
						INSERT INTO product_delivered(transaction_no,ingredient_id,total_qty,buy_price,tax_rate)
						VALUES('$transaction1','$barcode_1',$qty_1,$buy_price_1,$tax_1);
						";
					}else{
						$insert .= "
						INSERT INTO ingredients(ingredient_id,ingredient_name,quantity,unit,min_stocks,description) 
						VALUES('$barcode_1','$product_1',$qty_1,'$unit_1',$min_qty_1,'$remarks_1');
							";

						$insert .= "
						INSERT INTO product_delivered(transaction_no,ingredient_id,total_qty,buy_price,tax_rate)
						VALUES('$transaction1','$barcode_1',$qty_1,$buy_price_1,$tax_1);
						";
					}
				}
			}
			if($insert != ''){
				if (mysqli_multi_query($db, $insert)) {
	    			do {
			       		if ($insert = mysqli_store_result($db)) {
			            	mysqli_free_result($insert);

			            }
		        		if (mysqli_more_results($db)) {
		        		}
		    		}while (mysqli_more_results($db) && mysqli_next_result($db));
		    		echo "success";
				}else{
					echo "failure";
				}
			}else{
				echo "failure";
			}		
		}
	}
?>
