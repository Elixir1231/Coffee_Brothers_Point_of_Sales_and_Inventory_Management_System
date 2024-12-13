<?php
// save_ingredients.php

// Include database connection
include("../server/connection.php");

// Retrieve data from AJAX request
$productId = isset($_POST['productId']) ? $_POST['productId'] : '';
$ingredients = isset($_POST['ingredients']) ? $_POST['ingredients'] : array();
$ingredientQuantities = isset($_POST['ingredientQuantities']) ? $_POST['ingredientQuantities'] : array();

// Validate productId
if (empty($productId)) {
    echo "Error: Product ID is empty";
    exit();
}

// Process and save ingredients
for ($i = 0; $i < count($ingredients); $i++) {
    $ingredientId = $ingredients[$i];
    $quantity = $ingredientQuantities[$i];
    
    // Perform SQL query to save ingredient data
    $sql = "INSERT INTO product_ingredients (product_id, ingredient_id, quantity) VALUES ('$productId', '$ingredientId', '$quantity')";
    
    if (mysqli_query($db, $sql)) {
        // Ingredient saved successfully
    } else {
        // Error occurred while saving ingredient
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
        exit(); // Stop further execution
    }
}

// Send response
echo "Ingredients saved successfully!";
?>
