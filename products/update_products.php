<?php 
    include("../server/connection.php");
    include '../set.php';

    if (isset($_GET['id'])){
        $id   =   $_GET['id'];
        $sql  =   "SELECT * FROM products WHERE product_no='$id'";
        $result1   = mysqli_query($db, $sql);
        $row1  =   mysqli_fetch_array($result1);

        // Update product information
        if(isset($_POST['update'])) {
            $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $unit = mysqli_real_escape_string($db, $_POST['unit']);
            $min_stocks = $_POST['min_stocks'];
            $remarks = mysqli_real_escape_string($db, $_POST['remarks']);
            $location = mysqli_real_escape_string($db, $_POST['location']);

            // Update product table
            $update_query = "UPDATE products SET product_name='$product_name', sell_price='$price', unit='$unit', remarks='$remarks', location='$location' WHERE product_no='$id'";
            mysqli_query($db, $update_query);

            header("Location: ../products/products.php?update_success=true");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('../templates/head1.php');?>
    <style>
        .form-group-inline {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .form-group-inline label {
            width: 70%;
            margin-right: 10px;
        }
        .form-group-inline input {
            width: 30%;
            margin-right: 10px;
        }
        .form-group-inline button {
            margin-left: 10px;
        }
        .table-wrapper {
            display: flex;
            justify-content: space-between;
        }
        .table-wrapper .left-side,
        .table-wrapper .right-side {
            width: 48%;
        }
        #ingredients_section {
            border: 1px dashed #ced4da;
            padding: 10px;
            border-radius: 5px;
            max-height: 300px;
            overflow-y: auto;
        }
        #ingredients_section h4 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="contain h-100">
    <?php include('../products/base.php');?>
        <div class="header bg-dark">
            <img class="img-fluid w-100 mt-2 ml-1" src="../images/logo.png">
        </div>
        <div class="main">
            <div class="side">
                <h1 class="ml-4">Product Management</h1>
                <hr>
            </div>
            <div class="first_side ml-5 mt-5 mr-3">
                <div style="border:1px dashed black; width: 250px;height: 250px;">
                    <?php echo "<img class='img-fluid p-2 h-100 w-100' src='../images/".$row1['images']."'>"; ?>
                </div>
                <form method="post" enctype="multipart/form-data" action="../products/update.php">
                    <input type="hidden" name="size" value="1000000">
                    <input type="hidden" name="id" value="<?php echo $row1['product_no'];?>">
            </div>
            <div class="second_side table-wrapper">
                <div class="left-side">
                    <p class="bg-danger w-50"><?php echo $msg;?></p>
                    <table class="mt-5">
                        <tbody>
                            <tr>
                                <td valign="baseline">Name:</td>
                                <td class="pl-5 pb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span>
                                        </div>
                                        <input type="text" name="product_name" class="form-control-sm form-control" value="<?php echo $row1['product_name'];?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Sell Price:</td>
                                <td class="pl-5 pb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span>
                                        </div>
                                        <input type="number" name="price" step="0.01" value="<?php echo $row1['sell_price'];?>" class="form-control form-control-sm" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Unit:</td>
                                <td class="pl-5 pb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span>
                                        </div>
                                        <input type="text" name="unit" value="<?php echo $row1['unit'];?>" class="form-control-sm form-control" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Remarks:</td>
                                <td class="pl-5 pb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span>
                                        </div>
                                        <input type="text" name="remarks" value="<?php echo $row1['remarks'];?>" class="form-control-sm form-control" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Location:</td>
                                <td class="pl-5 pb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span>
                                        </div>
                                        <input type="text" name="location" value="<?php echo $row1['location'];?>" class="form-control-sm form-control" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Change Photo:</td>
                                <td><input class="form-control-sm pl-5" type="file" name="images"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-left mt-3" style="width: 100%;">
                        <button type="submit" name="update" class="btn btn-secondary"><i class="fas fa-thumbs-up"></i> Update</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='../products/products.php'"><i class="fas fa-ban"></i> Cancel</button>
                    </div>
                </div>
                <div class="right-side">
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
            </div>
        </div>
    </div>
    <script src="../bootstrap4/jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function () {
              $('[data-toggle="popover"]').popover()
        })

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
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeIngredient(this)">Remove</button>
                `;
                ingredientList.appendChild(ingredientDiv);

                ingredientSelect.selectedIndex = 0; // Reset the select box
            }
        }

        function removeIngredient(button) {
            var ingredientDiv = button.parentNode;
            ingredientDiv.parentNode.removeChild(ingredientDiv);
        }
    </script>
</body>
</html>
