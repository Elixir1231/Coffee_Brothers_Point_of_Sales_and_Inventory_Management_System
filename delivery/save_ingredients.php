<?php
include('../server/connection.php');

if(isset($_POST['create_delivery'])) {
    // Retrieve data from form
    $supplier = mysqli_real_escape_string($db, $_POST['supplier']);
    $order_no = mysqli_real_escape_string($db, $_POST['order_no']);
    
    // Loop through ingredients
    $ingredient_count = count($_POST['ingredient_name']);
    for($i = 0; $i < $ingredient_count; $i++) {
        $ingredient_name = mysqli_real_escape_string($db, $_POST['ingredient_name'][$i]);
        $quantity = mysqli_real_escape_string($db, $_POST['quantity'][$i]);
        $buy_price = mysqli_real_escape_string($db, $_POST['buy_price'][$i]);
        $unit = mysqli_real_escape_string($db, $_POST['unit'][$i]);
        $tax_rate = mysqli_real_escape_string($db, $_POST['tax_rate'][$i]);
        $min_qty = mysqli_real_escape_string($db, $_POST['min_qty'][$i]);
        $remarks = mysqli_real_escape_string($db, $_POST['remarks'][$i]);
        $location = mysqli_real_escape_string($db, $_POST['location'][$i]);
        
        // Insert into ingredients table
        $sql = "INSERT INTO ingredients (ingredient_name, description, quantity, unit, min_stocks) 
                VALUES ('$ingredient_name', '$remarks', '$quantity', '$unit', '$min_qty')";
        $result = mysqli_query($db, $sql);
        
        if(!$result) {
            // Handle insertion failure
            header("Location: add_delivery.php?failure=true");
            exit();
        }
        
        // Get the last inserted ingredient ID
        $ingredient_id = mysqli_insert_id($db);
        
        // Insert into ingredient_delivered table
        $sql_delivered = "INSERT INTO ingredient_delivered (transaction_no, ingredient_id, delivered_quantity, unit_price, tax_rate) 
                          VALUES ('$order_no', '$ingredient_id', '$quantity', '$buy_price', '$tax_rate')";
        $result_delivered = mysqli_query($db, $sql_delivered);
        
        if(!$result_delivered) {
            // Handle insertion failure
            header("Location: add_delivery.php?failure=true");
            exit();
        }
    }
    
    // Redirect on success
    header("Location: add_delivery.php?success=true");
    exit();
}
?>
