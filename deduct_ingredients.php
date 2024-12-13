<?php
include __DIR__ . '/db_connection.php'; // Ensure the path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_ids = $_POST['product'];
    $quantities = $_POST['quantity'];

    foreach ($product_ids as $index => $product_id) {
        $quantity = $quantities[$index];

        // Fetch the ingredients required for this product
        $ingredient_query = "SELECT ingredient_id, quantity_required FROM product_ingredients WHERE product_id = '$product_id'";
        $ingredient_result = mysqli_query($db, $ingredient_query);

        if ($ingredient_result) {
            while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
                $ingredient_id = $ingredient_row['ingredient_id'];
                $quantity_required = $ingredient_row['quantity_required'] * $quantity;

                // Check if the ingredient stock is sufficient
                $stock_query = "SELECT stock FROM ingredients WHERE id = '$ingredient_id'";
                $stock_result = mysqli_query($db, $stock_query);

                if ($stock_result) {
                    $stock_row = mysqli_fetch_assoc($stock_result);
                    $current_stock = $stock_row['stock'];

                    if ($current_stock >= $quantity_required) {
                        // Deduct the quantity from the stock
                        $new_stock = $current_stock - $quantity_required;
                        $update_query = "UPDATE ingredients SET stock = '$new_stock' WHERE id = '$ingredient_id'";
                        $update_result = mysqli_query($db, $update_query);

                        if (!$update_result) {
                            echo "Error updating ingredient quantities.";
                            exit;
                        }
                    } else {
                        echo "Insufficient stock for ingredient: " . $ingredient_id;
                        exit;
                    }
                } else {
                    echo "Error retrieving ingredient stock.";
                    exit;
                }
            }
        } else {
            echo "Error retrieving ingredient details.";
            exit;
        }
    }

    echo "success";
} else {
    echo "Invalid request.";
}
?>
