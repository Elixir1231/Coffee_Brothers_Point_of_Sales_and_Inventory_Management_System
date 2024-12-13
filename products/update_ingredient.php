<?php 
    include("../server/connection.php");

    // Check if id parameter is provided in the URL
    if (!isset($_GET['id'])) {
        // Redirect the user or display an error message
        header("Location: error.php?message=No%20ingredient%20ID%20provided");
        exit();
    }

    // Retrieve the id parameter from the URL
    $id = $_GET['id'];

    // Retrieve ingredient information from the database
    $sql = "SELECT * FROM ingredients WHERE ingredient_id='$id'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);

    // Check if ingredient exists
    if (!$row) {
        // Redirect the user or display an error message
        header("Location: error.php?message=Ingredient%20not%20found");
        exit();
    }

    // Update ingredient information
    if (isset($_POST['update_ingredient'])) {
        $ingredient_name = $_POST['ingredient_name'];
        $min_stocks = $_POST['min_stocks'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $unit = $_POST['unit'];

        // Update ingredient in the database
        $sql_update = "UPDATE ingredients SET ingredient_name='$ingredient_name', min_stocks='$min_stocks', description='$description', quantity='$quantity', unit='$unit' WHERE ingredient_id='$id'";
        $result_update = mysqli_query($db, $sql_update);

        if ($result_update) {
            // Redirect to ingredients.php with success message
            header("Location: ingredients.php?updated=true");
            exit();
        } else {
            // Redirect to ingredients.php with error message
            header("Location: ingredients.php?error=true");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('../templates/head1.php');?>
    <style>
        /* Additional CSS to align the form to the left */
        .first_side {
            float: left;
            width: 50%; /* Adjust as needed */
            margin-right: 20px; /* Add some space between the form and side content */
        }
        .second_side {
            overflow: hidden; /* Clear float */
            padding-left: -100px;
        }
    </style>
</head>
<body>
    <div class="contain h-100">
    <?php include('../products/base.php');?>
    
        <div class="main">
            <div class="side">
                <h1 class="ml-4">Ingredient Management</h1>
                <hr>
            </div>
            <div class="first_side ml-5 mt-5 mr-3">
                <!-- Update Ingredient Form -->
                <form method="post" action="update_ingredient.php?id=<?php echo $row['ingredient_id'];?>">
                    <input type="hidden" name="id" value="<?php echo $row['ingredient_id'];?>">
            </div>
            <div class="second_side table-responsive">
                <p class="bg-danger w-50"><?php echo $msg;?></p>
                <table class="mt-5">
                    <tbody>
                        <tr>
                            <td valign="baseline">Name:</td>
                            <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="ingredient_name" class="form-control-sm form-control" value="<?php echo $row['ingredient_name'];?>" required></div></td>
                        </tr>
                        <tr>
                            <td valign="baseline">Minimum Stocks:</td>
                            <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="min_stocks" value="<?php echo $row['min_stocks'];?>" class="form-control form-control-sm" required></td>
                        </tr>
                        <tr>
                            <td valign="baseline">Description:</td>
                            <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><textarea name="description" class="form-control-sm form-control"><?php echo $row['description'];?></textarea></div></td>
                        </tr>
                        <tr>
                            <td valign="baseline">Quantity:</td>
                            <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="quantity" value="<?php echo $row['quantity'];?>" class="form-control-sm form-control" required></td>
                        </tr>
                        <tr>
                            <td valign="baseline">Unit:</td>
                            <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="unit" value="<?php echo $row['unit'];?>" class="form-control-sm form-control" required></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-primary" name="update_ingredient"><i class="fas fa-thumbs-up"></i> Update</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='../products/ingredients.php'" ><i class="fas fa-ban"></i> Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap and other scripts -->
    <script src="../bootstrap4/jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
</body>
</html>
