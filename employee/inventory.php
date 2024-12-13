<?php 
    include("../server/connection.php");
    include '../set.php';
    $sql = "SELECT * FROM products";
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
    <style>
        .alert-notification {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="contain h-100">
	<?php include('../employee/base2.php');?>
        <div>
            <div class="header-container ml-4 pt-2">
                <h1><i class="fas fa-box-open"></i> Product Management</h1>
                <button onclick="printTable()" class="btn btn-primary mr-5 mt-3">Print</button> <!-- Print button -->
            </div>
            <hr>
            <?php include('../alert.php');?>
            <div class="table-responsive mt-4 pl-5 pr-5">
                <table class="table table-striped table-bordered" id="product_table" style="margin-top: -22px;">
                    <thead>
                        <tr>
                            <th scope="col" class="column-text">Item No.</th>
                            <th scope="col" class="column-text">Product Name</th>
                            <th scope="col" class="column-text">Price</th>
                            <th scope="col" class="column-text">Unit</th>
                         
                            <th scope="col" class="column-text">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        <?php 
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr class="table-active">
                            <td><?php echo $row['product_no'];?></td>
                            <td><?php echo $row['product_name'];?></td>
                            <td align="right">₱&nbsp<?php echo $row['sell_price'];?></td>
                         
                            <td><?php echo $row['unit'];?>&nbspoz</td>
                       
                            <td>
                            
                                <button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['product_no'];?>" class="btn btn-success btn-xs view_data"><i class="fas fa-eye"></i></button>
                                
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="alert-notification" id="alertNotification"></div>
    <script src="../bootstrap4/jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/jquery.dataTables.js"></script>
    <script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <?php include('../products/delete_products.php');?>
    <script>
        $(document).ready(function() {
            // Function to show notification with fadeIn and fadeOut effects
            function showNotification(message, index) {
                var alertMessage = $('<div class="alert alert-danger" role="alert">' + message + '</div>').hide();
                $('#alertNotification').prepend(alertMessage);
                setTimeout(function() {
                    alertMessage.fadeIn('slow').delay(10000).fadeOut('slow', function() {
                        $(this).remove();
                    });
                }, index * 500); // Adjust the delay between notifications here
            }

            // Check product quantities against minimum stocks and if they have ingredients
            $('#product_table tbody tr').each(function(index) {
                var quantity = parseFloat($(this).find('td:eq(3)').text().replace('g', ''));
                var minStocks = parseFloat($(this).find('td:eq(5)').text().replace('g', ''));
                var hasIngredients = $(this).find('.ingredient').length > 0;

                if (quantity <= minStocks) {
                    var productName = $(this).find('td:eq(1)').text();
                    var message = productName + ' has reached the minimum stock level!';
                    showNotification(message, index);
                }

                if (!hasIngredients) {
                    var productName = $(this).find('td:eq(1)').text();
                    var message = productName + ' has no ingredients!';
                    showNotification(message, index);
                }
            });

            // Trigger add ingredient modal and set the product ID
            $('.add_ingredients').click(function() {
                var productId = $(this).data('product-id');
                // Set the product ID in the modal
                $('#productId').val(productId);
                // Show the modal
                $('#addIngredientModal').modal('show');
            });

            // Save ingredients
            $('#saveIngredientsBtn').click(function() {
                saveIngredients();
            });
        });

        // Function to save ingredients
        function saveIngredients() {
            var productId = $('#productId').val(); // Assuming you have an input field with id 'productId' to store the product id

            var ingredients = [];
            var quantities = [];

            $('input[name="ingredients[]"]').each(function() {
                ingredients.push($(this).val());
            });

            $('input[name="ingredient_quantities[]"]').each(function() {
                quantities.push($(this).val());
            });

            // Check if productId is empty
            if (!productId) {
                alert('Product ID is required.');
                return; // Stop further execution
            }

            $.ajax({
                type: 'POST',
                url: 'save_ingredients.php',
                data: {
                    productId: productId,
                    ingredients: ingredients,
                    ingredientQuantities: quantities
                },
                success: function(response) {
                    alert(response); // Display the response from the server
                    $('#addIngredientModal').modal('hide'); // Close the modal after saving
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while saving ingredients.');
                }
            });
        }

        // Function to add ingredient
        function addIngredient() {
            var ingredientSelect = document.getElementById('ingredient_select');
            var selectedOption = ingredientSelect.options[ingredientSelect.selectedIndex];
            if (selectedOption.value !== 'Select ingredient') {
                var ingredientList = document.getElementById('ingredient_list');

                var ingredientDiv = document.createElement('div');
                ingredientDiv.className = 'form-group-inline';
                ingredientDiv.innerHTML = `
                    <label>${selectedOption.text}</label>
                    <input type="hidden" name="ingredients[]" value="${selectedOption.value}">
                    <input type="number" name="ingredient_quantities[]" step="0.01" placeholder="Quantity" required style="width:100px;">
                    <button type="button" class="btn btn-danger btn-sm remove_ingredient" onclick="removeIngredient(this)">Remove</button>
                `;
                ingredientList.appendChild(ingredientDiv);

                ingredientSelect.selectedIndex = 0; // Reset the select box
            }
        }

        // Function to remove ingredient
        function removeIngredient(button) {
            var ingredientDiv = button.parentNode;
            ingredientDiv.parentNode.removeChild(ingredientDiv);
        }

        // Function to print the table
        function printTable() {
            var printContents = document.getElementById('product_table').outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = "<html><head><title>Product Table</title></head><body>" + printContents + "</body>";

            window.print();

            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
    <div class="modal fade" id="addIngredientModal" tabindex="-1" role="dialog" aria-labelledby="addIngredientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIngredientModalLabel">Add Ingredients</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add an input field to store the product ID -->
                    <input type="hidden" id="productId">
                    <div id="ingredients_section" class="mt-3" style="width:90%; margin-left:20px;">
                        <h4>Ingredients</h4>
                        <div class="form-group">
                            <select class="form-control" id="ingredient_select">
                                <option selected disabled>Select ingredient</option>
                                <?php
                                $sql = "SELECT * FROM ingredients";
                                $result = mysqli_query($db, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row['ingredient_id']."'>".$row['ingredient_name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addIngredient()">Add Ingredient</button>
                        <div id="ingredient_list" class="mt-3"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveIngredients()">Save Ingredients</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="dataModal" class="modal fade bd-example-modal-md" data-backdrop="static" data-keyboard="false">  
        <div class="modal-dialog modal-md"  role="document">  
            <div class="modal-content">   
                <div class="modal-body d-inline" id="Contact_Details"></div> 
                <div class="modal-footer"> 
                    <input type="button" class="btn btn-default btn-success" data-dismiss="modal" value="Okay">   
                </div>  
            </div>  
        </div>  
    </div>
    <script src="../products/javascript.js"></script>
</body>
</html>
