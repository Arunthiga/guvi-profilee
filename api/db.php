<?php

$host = getenv('MYSQLHOST') ?: "mysql-59f16e5-ngobi9121-c89f.l.aivencloud.com";
$user = getenv('MYSQLUSER') ?: "avnadmin";
$password = getenv('MYSQLPASSWORD') ?: "AVNS_-OUNyX3kZh2UdkWYMdb";
$database = getenv('MYSQLDATABASE') ?: "defaultdb";
$port = getenv('MYSQLPORT') ?: 11496;

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL); 
mysqli_real_connect($conn, $host, $user, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}

?>