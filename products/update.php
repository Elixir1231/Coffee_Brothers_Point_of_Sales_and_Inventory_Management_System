<?php
// Include connection.php which contains database connection settings
include("../server/connection.php");

$msg = '';

// Check if the 'update' form is submitted
if (isset($_POST['update'])) {
    // File upload target directory
    $target = "../images/" . basename($_FILES['images']['name']);
    $image = $_FILES['images']['name'];
    $id = $_POST['id'];
    $pro_name = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $unit = mysqli_real_escape_string($db, $_POST['unit']);
    $remarks = mysqli_real_escape_string($db, $_POST['remarks']);
    $location = mysqli_real_escape_string($db, $_POST['location']);
    $username = $_SESSION['username'];

    // Update product information
    if (!empty($image)) {
        $sql = "UPDATE products SET product_name='$pro_name', sell_price=$price, unit='$unit', remarks='$remarks', location='$location', images='$image' WHERE product_no = '$id'";
    } else {
        $sql = "UPDATE products SET product_name='$pro_name', sell_price=$price, unit='$unit', remarks='$remarks', location='$location' WHERE product_no = '$id'";
    }

    // Execute the update query
    $result = mysqli_query($db, $sql);

    // Check if the update was successful
    if ($result) {
        // Clear existing ingredients for the product
        $delete_query = "DELETE FROM product_ingredients WHERE product_no='$id'";
        mysqli_query($db, $delete_query);

       // Insert new ingredients and quantities
	if (!empty($_POST['ingredients']) && !empty($_POST['ingredient_quantities'])) {
    $ingredients = $_POST['ingredients'];
    $quantities = $_POST['ingredient_quantities'];

    // Loop through ingredients and quantities to insert into product_ingredients table
    for ($i = 0; $i < count($ingredients); $i++) {
        $ingredient_id = mysqli_real_escape_string($db, $ingredients[$i]);
        $quantity = mysqli_real_escape_string($db, $quantities[$i]);

        // Insert each ingredient and quantity into product_ingredients table
        $insert_query = "INSERT INTO product_ingredients (product_no, ingredient_id, quantity) VALUES ('$id', '$ingredient_id', '$quantity')";
        mysqli_query($db, $insert_query);
    }
}	

        // Log the update
        $log_sql = "INSERT INTO logs (username, purpose) VALUES ('$username', 'Product $pro_name updated')";
        mysqli_query($db, $log_sql);

        // Redirect after successful update
        header('location: ../products/products.php?updated');
    } else {
        // If update failed, display error message
        echo "Error updating product: " . mysqli_error($db);
    }
}
?>
