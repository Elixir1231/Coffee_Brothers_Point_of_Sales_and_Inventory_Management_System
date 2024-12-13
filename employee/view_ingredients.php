<?php 
	include('../server/connection.php');

	if(isset($_POST["id"])) {  
		$output = '';
		$id = $_POST['id'];  
	  	$query = "SELECT * FROM ingredients WHERE ingredient_id = '$id'";  
	  	$result = mysqli_query($db, $query);  

	  	while($row = mysqli_fetch_array($result)) {
	  		echo "<h1 class='d-flex'>".$row['ingredient_name']."</h1>";
			echo "<div class='d-inline-flex  mt-2'>";
			echo "</div>";
			$output .= '  
	  			<div class="table-responsive">  
		   		<table class="w-75">';
		   	$output .= '
				<tr>  
					 <td width="50%"><label>Minimum Stocks :</label></td>  
					 <td width="50%"><strong>'.$row["min_stocks"].'</strong></td>  
				</tr>
				<tr>
					<td width="50%"><label>Description :</label></td>  
					<td width="50%"><strong>'.$row["description"].'</strong></td> 
				</tr>
				<tr>  
					 <td width="50%"><label>Quantity :</label></td>  
					 <td width="50%"><strong>'.$row["quantity"].'</strong></td>  
				</tr>
				<tr>  
					 <td width="50%"><label>Unit :</label></td>  
					 <td width="50%"><strong>'.$row["unit"].'</strong></td>  
				</tr> 
				<tr>  
				<td width="50%"><label>Expiration Date: Jan, 2025</label></td>  
				<td width="50%"><strong>'.'</strong></td>  
		   </tr>';  
	  }  
	  $output .= '  
		   </table>  
	  		</div>  
	  ';
	  echo $output;  
 	}  
?>
