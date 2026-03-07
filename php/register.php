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
    echo "DB Error: " . mysqli_error($conn);
}
?>