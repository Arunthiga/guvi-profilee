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

// Hashing password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);

if($stmt->execute()){
    echo "Register success";
}else{
    if ($stmt->errno == 1062) {
        echo "Email already exists! Please login instead.";
    } else {
        echo "Error: Something went wrong.";
    }
}
$stmt->close();
$conn->close();
?>