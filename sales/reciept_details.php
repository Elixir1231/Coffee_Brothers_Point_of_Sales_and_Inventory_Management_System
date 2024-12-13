<?php
    include("../server/connection.php");
    include '../set.php';
    $id = $_GET['reciept_id'];
    $sql = "SELECT * FROM sales_product, products WHERE reciept_no = '$id' AND sales_product.product_id = products.product_no";
    $result1 = mysqli_query($db, $sql); // Execute the query and store the result

    // Check if there are any rows returned
    if(mysqli_num_rows($result1) > 0) {
        // Fetch the first row to get the receipt number
        $row = mysqli_fetch_array($result1);
    } else {
        // Handle the case when no rows are returned
        echo "No sales records found for the specified receipt ID.";
        exit; // Terminate further execution
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('../templates/head1.php');?>
    <style>
        /* Move the print button to the right side */
        .print-button {
            float: right;
            margin-top: 10px; /* Adjust as needed */
			margin-right:50px;
        }
    </style>
</head>
<body>
    <div class="contain h-100">
        <?php include('../sales/base.php');?>
        <div>
            <div>
                <h1 class="ml-4 pt-2 pb-4" align="left"><i class="fas fa-shopping-cart"></i> Sales Records
                <button onclick="printPage()" class="btn btn-primary print-button">Print</button></h1>
            </div>
            <div class="table-responsive pl-5 pr-5">
                <table class="table table-striped table-bordered" id="sales_table" style="margin-top: -22px;">
                    <thead>
                        <tr>
                            <td colspan="5"><h2>Reciept No.&nbsp<?php echo $row['reciept_no'];?></h2></td>
                        </tr>
                        <tr>
                            <th scope="col" class="column-text">Barcode</th>
                            <th scope="col" class="column-text">Product Name</th>
                            <th scope="col" class="column-text">Quantity</th>
                            <th scope="col" class="column-text">Price</th>
                            <th scope="col" class="column-text">Unit</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        <?php
                            // Reset the data pointer of $result1
                            mysqli_data_seek($result1, 0);
                            while($row1 = mysqli_fetch_array($result1)){ ?>
                        <tr class="table-active">
                            <td><?php echo $row1['product_id'];?></td>
                            <td><?php echo $row1['product_name'];?></td>
                            <td><?php echo $row1['qty'];?></td>
                            <td>₱<?php echo $row1['price'];?></td>
                            <td><?php echo $row1['unit'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../bootstrap4/jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/jquery.dataTables.js"></script>
    <script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sales_table').dataTable();
        });

        // Function to print the page
        function printPage() {
            window.print();
        }
    </script>
</body>
</html>
