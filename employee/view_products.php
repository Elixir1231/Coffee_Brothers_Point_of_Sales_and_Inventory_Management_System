<?php
include('../server/connection.php');

if (isset($_POST["id"])) {
    $output = '';
    $id = $_POST['id'];
    $query = "SELECT * FROM products WHERE product_no = '$id'";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die('Query Error: ' . mysqli_error($db));
    }

    while ($row = mysqli_fetch_array($result)) {
        echo "<h1 class='d-flex'>" . $row['product_name'] . "</h1>";
        echo "<div class='d-inline-flex mt-2'>";
        echo "<img width='140' height='140' style='border:1px; border-radius:2px' src='../images/" . $row['images'] . "'>";
        echo "</div>";
        $output .= '  
            <div class="table-responsive">  
            <table class="w-75">';
        $output .= '
            <tr>  
                 <td width="50%"><label>Price :</label></td>  
                 <td width="50%"><strong>₱&nbsp;' . $row["sell_price"] . '</strong></td>  
            </tr>
            <tr>
                <td width="50%"><label>Stocks :</label></td>  
                <td width="50%"><strong>' . $row["quantity"] . '</strong></td> 
            </tr>
            <tr>  
                 <td width="50%"><label>Unit :</label></td>  
                 <td width="50%"><strong>' . $row["unit"] . '</strong>&nbsp;oz</td>  
            </tr>
            <tr>  
                 <td width="50%"><label>Minimum Stocks:</label></td>  
                 <td width="50%"><strong>' . $row["min_stocks"] . '</strong></td>  
            </tr>
            <tr>  
                <td width="50%"><label>Remarks:</label></td>  
                <td width="50%"><strong>' . $row["remarks"] . '</strong></td>  
            </tr>
            <tr>  
                <td width="50%"><label>Location:</label></td>  
                <td width="50%"><strong>' . $row["location"] . '</strong></td>  
            </tr>';

        // Query to get the ingredients
        $ingredient_query = "
		SELECT i.ingredient_name, pi.quantity AS ingredient_quantity
		FROM ingredients i
		JOIN product_ingredients pi ON i.ingredient_id = pi.ingredient_id
		WHERE pi.product_id = '$id'";
        $ingredient_result = mysqli_query($db, $ingredient_query);

        if ($ingredient_result && mysqli_num_rows($ingredient_result) > 0) {
            $output .= '
            <tr>
                <td width="50%"><label>Ingredients:</label></td>
                <td width="50%">
                    <ul>';
            while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
                $output .= '<li>' . $ingredient_row["ingredient_name"] . ' - ' . $ingredient_row["ingredient_quantity"] . '</li>';
            }
            $output .= '</ul>
                </td>
            </tr>';
        } else {
            $output .= '
            <tr>
                <td width="50%"><label>Ingredients:</label></td>
                <td width="50%">No ingredients</td>
            </tr>';
        }
    }
    $output .= '  
           </table>  
        </div>  
    ';
    echo $output;
}
?>
