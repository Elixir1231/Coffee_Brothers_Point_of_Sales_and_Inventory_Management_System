<?php 
include('server/connection.php');
$error = array();

if (isset($_POST['login'])){
    $password = md5(mysqli_real_escape_string($db, $_POST['password']));
    $username = mysqli_real_escape_string($db, $_POST['username']);

    if($username != '' && $password != ''){
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $position = $row['position']; // Retrieve user's position from the database

            $_SESSION['username'] = $row['username'];
            $user = $_SESSION['username'];
            $insert = "INSERT INTO logs (username,purpose) VALUES('$user','User $user login')";
            $logs = mysqli_query($db,$insert);

            if ($position == 'Employee') {
                header('location: employee_page.php');
            } elseif ($position == 'Admin') {
                header('location: main.php');
            } else {
                array_push($error, "Invalid position!");
            }
        } else {
            array_push($error, "Wrong username/password!");
        }
    } else {
        array_push($error, "Username and password are required!");
    }
}
?>
