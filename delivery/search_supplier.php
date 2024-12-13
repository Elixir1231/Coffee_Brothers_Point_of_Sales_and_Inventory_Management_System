<?php
include('../server/connection.php');

// Handle both GET and POST requests
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // If it's a POST request, fetch suggestions based on the input query
    $query = $_POST['query'];
    $sql = "SELECT supplier_name FROM suppliers WHERE supplier_name LIKE '$query%'";
    $result = mysqli_query($db, $sql);

    $suppliers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $suppliers[] = $row['supplier_name'];
    }

    echo json_encode($suppliers);
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['query'])) {
    // If it's a GET request, handle it similarly to POST for consistency
    $query = $_GET['query'];
    $sql = "SELECT supplier_name FROM suppliers WHERE supplier_name LIKE '$query%'";
    $result = mysqli_query($db, $sql);

    $suppliers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $suppliers[] = $row['supplier_name'];
    }

    echo json_encode($suppliers);
}
?>
