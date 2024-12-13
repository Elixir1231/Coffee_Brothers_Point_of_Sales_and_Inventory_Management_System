<?php 
	include('server/connection.php');
	if(!isset($_SESSION['username'])){
		header('location: index.php');
	}
	$added = isset($_GET['added']);
	$error = isset($_GET['error']);
	$undelete = isset($_GET['undelete']);
	$updated = '';
	$deleted = '';
	$failure = isset($_GET['failure']);
	$query 	= "SELECT * FROM `customer`";
	$show	= mysqli_query($db,$query);
	if(isset($_SESSION['username'])){
		$user = $_SESSION['username'];
		$sql = "SELECT position FROM users WHERE username='$user'";
		$result	= mysqli_query($db, $sql);
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Coffee_Brothers_Co</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="180x180" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/style2.css">
	<link rel="stylesheet" href="bootstrap4/css/all.min.css"/>
	<script src="bootstrap4/jquery/sweetalert.min.js"></script>
</head>
<body>
	<div class="h-100 bg-dark" id="container">
		<div id="header">
			<?php include('alert.php'); ?>
			<div>
				<img class="img-fluid m-2 w-100" src="images/logo1.png"/>
			</div>
			<div class="text-white mt-0 ml-5">
				<table class="table-responsive-sm">
					<tbody>
						<tr>
							<td valign="baseline"><small>User Logged on:<small></td>
							<td valign="baseline"><small><p class="pt-3 ml-5"><i class="fas fa-user-shield"></i> <?php echo $row['position'];}}}?></p><small></td>
						</tr>
						<tr>
							<td valign="baseline"><small class="pb-1">Date:<small></td>
							<td valign="baseline"><small><p class="p-0 ml-5"><i class="fas fa-calendar-alt">&nbsp</i><span id='time'></span></p><small></td>
						</tr>
						<tr>
							<td valign="baseline"><small class="mt-5"></small></td>
							<td valign="baseline"><small><div class="content p-0 ml-5"><div class="customer_search" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customer"/></small></div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="header_price border p-1 mt-2">
				<h5>Grand Total:</h5>
				<p class="pb-0 mr-2 mb-2" style="float: right; font-size: 40px;" id="totalValue">₱ 0.00</p>
			</div>
		</div>
		<div id="content" class="mr-2">
		<div id="price_column" class="m-2 table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar-a">
				<form method="POST" action="">
				<table class="table-striped w-100 font-weight-bold" style="cursor: pointer;" id="table2">
					<thead>
						<tr class='text-center'>
							<th>Product No.</th>
							<th>Description</th>
							<th>Price</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Sub.Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tableData">
					</tbody>
				</table>
				</form>
			</div>
			<div id="table_buttons">
				<button id="buttons" type="button" name='enter' class="Enter btn btn-secondary border ml-2"><i class="fas fa-handshake"></i> Finish</button>
				<div class="">
					<small>
					<ul class="text-white justify-content-center">
						<li class="d-flex mb-0">Total (₱): <p id="totalValue1" class="mb-0 ml-5 pl-3">0.00</p></li>
						<li class="mb-0 mt-0">Discount (₱): <input style="width: 100px" class="text-right form-control-sm" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount" ></li>
					</ul>
				</small>
				</div>
			</div>
		</div>
		<div id="sidebar">
			<div class="mt-1">
			<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
   			<input class="form-control" type="text" placeholder="Product Search" aria-label="Search" id="search" name="search" onkeyup="loadproducts();"/>
   			</div></div>
			<div class="mt-0" id="product_area" class="table-responsive-sm mt-2" >
				<table class="w-100 table-striped font-weight-bold" style="cursor: pointer;" id="table1">
					<thead>
						<tr claclass='text-center'><b>
							<td>Product No.</td>
							<td>Product Name</td>
							<td>Price</td>
							<td>Unit</td>
							<td>Stocks</td>
						</tr></b>
						<tbody id="products">
							
						</tbody>
					</thead>
				</table>
			</div>
			<div class="w-100 mt-2" id="enter_area">
				<button id="buttons" type="button" class="cancel btn btn-secondary border"><i class="fas fa-ban"></i> Cancel</button>
			</div>
		</div>
		<div id="footer" class="w-100" align="center">
			<button id="buttons" onclick="window.location.href='employee/profile.php'" class="btn btn-secondary border mr-2 ml-2"><i class="fas fa-user-circle"></i> My Profile</button>
			<button id="buttons" onclick="window.location.href='employee/inventory.php'" class="btn btn-secondary border mr-2"><i class="fas fa-box-open"></i> Inventory</button>
			<div></div>
			<button id="buttons" name="logout" type="button" onclick="out();" class="logout btn btn-danger border mr-2"> <i class="fas fa-sign-out-alt"></i> Logout</div>
		</div>
	</div>
	<?php include('add.php');?>
	<?php include('templates/js_popper.php');?>
	<script type="text/javascript" src="script2.js"></script>
	<script src="bootstrap4/js/time.js"></script>
</body>
<script>
    // Assuming you have fetched the customer data and stored it in a variable named customerData
    var customerData = "Random Customer"; // Example customer data

    // Set the value of the input field with the customer data
    document.getElementById("customer_search").value = customerData;
</script>
</html> 
