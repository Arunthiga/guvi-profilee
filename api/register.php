<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if($name=="" || $email=="" || $password==""){
    echo "Missing data";
    exit();
}

$sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";

if(mysqli_query($conn,$sql)){
    echo "Register success";
}else{
    if (mysqli_errno($conn) == 1062) {
        echo "Email already exists! Please login instead.";
    } else {
        echo "Error: Something went wrong.";
    }
}
?>