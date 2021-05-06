<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "university";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
$_SESSION['success'] = "";
$errors = array();
//initialize variables
$name = $_POST["name"];
$email = $_POST["email"];
$password1 = $_POST["password"];
$password2 = $_POST["password1"];

//check that fields are not empty
if (empty($name)) {
    array_push($errors, "Username is required");
}
if (empty($email)) {
    array_push($errors, "Email is required");
}
if (empty($password1)) {
    array_push($errors, "Password is required");
}


if ($password1 != $password2) {
    array_push($errors, "The two passwords do not match");
    // Checking if the passwords match
}
if (count($errors) == 0) {
    //encrypt password
    $password1 = md5($password1);
    $query = "SELECT * from user where email='$email'";
    $result = mysqli_query($conn, $query);
    // check if email already exists
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO user (name ,email,password)
    VALUES ('$name','$email','$password1')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['name']=$name;
            echo '<script type="text/javascript">';
            echo 'window.location.href = "table.php";';
            echo '</script>';

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href = "Welcome.html";';
        echo 'alert("This email is already used please try again");';
        echo '</script>';
    }
}
mysqli_close($conn);
?>
