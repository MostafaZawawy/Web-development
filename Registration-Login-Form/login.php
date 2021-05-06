<?php
$servername ="127.0.0.1";
$username = "root";
$password = "";
$dbname = "university";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$errors = array();
session_start();
$_SESSION['success'] = "";

$password = $_POST["password2"];
$email2=$_POST["email2"];


if (empty($password)) { array_push($errors, "Password is required"); }
if (empty($email2)) { array_push($errors, "Email is required"); }

if(count($errors)==0) {
    $password = md5($password);
    $query1 = "SELECT * from user where email='$email2' and password='$password'";
    $result1 = mysqli_query($conn, $query1);
    $row = mysqli_fetch_assoc($result1);
    if (mysqli_num_rows($result1) > 0) {
        $_SESSION['name']=$row["name"];
        echo '<script type="text/javascript">';
        echo 'window.location.href = "table.php";';
        echo '</script>';
    } else {

        echo '<script type="text/javascript">';
        echo 'window.location.href = "welcome.html";';
        echo 'alert("Please enter a valid email or password");';
        echo '</script>';

    }
}
mysqli_close($conn);
?>
