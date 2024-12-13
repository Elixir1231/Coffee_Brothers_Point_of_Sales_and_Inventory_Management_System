<?php
    include("../server/connection.php");
    $msg = '';
    if(isset($_POST['update_ingredient'])){
        $id = $_POST['id'];
        $ingredient_name = mysqli_real_escape_string($db, $_POST['ingredient_name']);
        $min_stocks = mysqli_real_escape_string($db, $_POST['min_stocks']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
        $unit = mysqli_real_escape_string($db, $_POST['unit']);

        // Update the ingredient details in the database
        $sql = "UPDATE ingredients SET ingredient_name='$ingredient_name', min_stocks=$min_stocks, description='$description', quantity=$quantity, unit='$unit' WHERE ingredient_id = '$id'";
        $result = mysqli_query($db, $sql);

        if($result) {
            // Log the update action
            $log_sql = "INSERT INTO logs (username, purpose) VALUES ('$username', 'Ingredient $ingredient_name updated')";
            mysqli_query($db, $log_sql);
            
            header('location: ../ingredients/ingredients.php?updated');
        } else {
            $msg = "Error updating ingredient";
        }
    }
?>
