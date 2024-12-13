<?php 
include('../server/connection.php');

if(isset($_POST["id"])) {  
    $id = $_POST['id'];  

    // Delete from ingredients table
    $query_ingredients = "DELETE FROM ingredients WHERE ingredient_id = '$id'";  
    $result_ingredients = mysqli_query($db, $query_ingredients);  

    // Delete from ingredient_delivered table
    $query_delivered = "DELETE FROM ingredient_delivered WHERE ingredient_id = '$id'";  
    $result_delivered = mysqli_query($db, $query_delivered);  

    if($result_ingredients && $result_delivered) {
        echo 'success';
    } else {
        echo 'error: ' . mysqli_error($db);
    }
}  
?>
