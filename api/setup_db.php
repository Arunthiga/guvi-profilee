<?php
// This is a one-time setup script. 
// RUN THIS LOCALLY AND DELETE IT IMMEDIATELY. DO NOT PUSH TO GITHUB.

$host = "mysql-59f16e5-ngobi9121-c89f.l.aivencloud.com";
$user = "avnadmin";
$password = "AVNS_-OUNyX3kZh2UdkWYMdb";
$database = "defaultdb";
$port = 11496;

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL); 
mysqli_real_connect($conn, $host, $user, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if(mysqli_query($conn, $sql)){
    echo "<h1>Table 'users' created successfully!</h1>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
