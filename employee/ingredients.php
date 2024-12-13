<?php 
    include("../server/connection.php");
    include '../set.php';

    // If form is submitted, add new ingredient
    if(isset($_POST['add_ingredient'])) {
        $ingredient_name = $_POST['ingredient_name'];
        $min_stocks = $_POST['min_stocks'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $unit = $_POST['unit'];

        // Insert into database
        $sql = "INSERT INTO ingredients (ingredient_name, min_stocks, description, quantity, unit) VALUES ('$ingredient_name', '$min_stocks', '$description', '$quantity', '$unit')";
        $result = mysqli_query($db, $sql);

        if($result) {
            header("Location: ingredients.php?added=true");
            exit();
        } else {
            header("Location: ingredients.php?error=true");
            exit();
        }
    }

    // Fetch all ingredients
    $sql = "SELECT * FROM ingredients";
    $result = mysqli_query($db, $sql);

    $deleted = isset($_GET['deleted']);
    $added = isset($_GET['added']);
    $updated = isset($_GET['updated']);
    $undelete = isset($_GET['undelete']);
    $error = isset($_GET['error']);
    $failure = "";    
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('../templates/head1.php');?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <style>
        .alert-notification {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9;
        }
    </style>
</head>
<body>
    <div class="contain h-100" style="overflow:hidden;">
        <?php include('../employee/base2.php');?>
        <div>
            <div class="row">
                <div class="col">
                    <h1 class="ml-4 pt-2"><i class="fas fa-box-open"></i> Ingredients Management</h1>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary mt-4 mr-2" data-toggle="modal" data-target="#addIngredientModal">
                        Add New Ingredient
                    </button>
                    <button type="button" class="btn btn-primary mt-4 mr-5" onclick="printTable()">
                        Print
                    </button>
                </div>
            </div>
            <hr>
            <?php include('../alert.php');?>


            <!-- List of Ingredients -->
            <div class="table-responsive mt-2 pl-5 pr-5">
                <table class="table table-striped table-bordered" id="ingredient_table">
                    <thead>
                        <tr>
                            <th scope="col" class="column-text">Item No.</th>
                            <th scope="col" class="column-text">Ingredient Name</th>
                            <th scope="col" class="column-text">Available</th>
                            <th scope="col" class="column-text">Unit</th>
                            <th scope="col" class="column-text">Minimum Stocks</th>
                            <th scope="col" class="column-text">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                    <?php 
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr class="table-active">
                        <td><?php echo $row['ingredient_id'];?></td>
                        <td><?php echo $row['ingredient_name'];?></td>
                        <td align="right">&nbsp<?php echo $row['quantity'];?></td>
                        <td align="left"><?php echo $row['unit'];?>&nbsp</td>
                        <td><?php echo $row['min_stocks'];?>&nbsp</td>
                        <td>
                         
                            <button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['ingredient_id'];?>" class="btn btn-success btn-xs view_data" data-toggle="modal" data-target="#viewIngredientsModal"><i class="fas fa-eye"></i></button>
                           
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="alert-notification" id="alertNotification"></div>

    <!-- Add Ingredient Modal -->
    <div class="modal fade" id="addIngredientModal" tabindex="-1" role="dialog" aria-labelledby="addIngredientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIngredientModalLabel">Add New Ingredient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="ingredient_name">Ingredient Name:</label>
                            <input type="text" class="form-control" name="ingredient_name" required>
                        </div>
                        <div class="form-group">
                            <label for="min_stocks">Minimum Stocks:</label>
                            <input type="number" class="form-control" name="min_stocks" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit:</label>
                            <input type="text" class="form-control" name="unit" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_ingredient">Add Ingredient</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Ingredient Modal -->
    <div id="viewIngredientsModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Ingredients</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
               
                    </div>
                <div class="modal-body" id="ingredient_details">
                    <!-- Ingredient details will be displayed here -->
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap4/jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="../products/delete_ingredients.js"></script>
    <script>
    $(document).ready(function(){
        $('#ingredient_table').DataTable({
            "lengthMenu": [ [5], [5] ], // Set options for the user to choose from
            "pageLength": 5 // Set the default number of entries to display
        });

        $('.view_data').click(function(){
            var id = $(this).attr("id");
            $.ajax({
                url:"view_ingredients.php", // Updated URL to view_ingredients.php
                method:"post",
                data:{id:id},
                success:function(data){
                    $('#ingredient_details').html(data);
                    $('#viewIngredientsModal').modal("show");
                }
            });
        });

        $('.delete').click(function(){
            var id = $(this).data("id");
            if(confirm("Are you sure you want to delete this ingredient?")) {
                $.ajax({
                    url:"delete_ingredient.php",
                    method:"post",
                    data:{id:id},
                    success:function(data){
                        if(data == 'success') {
                            // Reload the page after successful deletion
                            window.location.reload(true);
                        } else {
                            alert("Failed to delete the ingredient.");
                        }
                    }
                });
            }
        });

        // Function to show notification with fadeIn and fadeOut effects
        function showNotification(message, index) {
            var alertMessage = $('<div class="alert alert-warning alert-dismissible fade show" role="alert">' + message +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button></div>').hide();
            $('.alert-notification').prepend(alertMessage);
            setTimeout(function() {
                alertMessage.fadeIn('slow').delay(5000).fadeOut('slow', function() {
                    $(this).remove();
                });
            }, index * 500); // Adjust the delay between notifications here
        }

        // Check ingredient quantities against minimum stocks
        $('#ingredient_table tbody tr').each(function(index) {
            var quantity = parseFloat($(this).find('td:eq(2)').text().trim());
            var minStocks = parseFloat($(this).find('td:eq(4)').text().trim());

            if (quantity <= minStocks) {
                var ingredientName = $(this).find('td:eq(1)').text().trim();
                var message = ingredientName + ' has reached the minimum stock level!';
                showNotification(message, index);
            }
        });
    });

    function printTable() {
        var printContents = document.getElementById('ingredient_table').outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = "<html><head><title>Ingredients List</title></head><body>" + printContents + "</body>";

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

    <script src="../products/javascript2.js"></script>
</body>
</html>
