<?php

$host = getenv('MYSQLHOST') ?: "sql206.byetcluster.com";
$user = getenv('MYSQLUSER') ?: "if0_41323346";
$password = getenv('MYSQLPASSWORD') ?: "arunthi1825";
$database = getenv('MYSQLDATABASE') ?: "if0_41323346_guvi_users";

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    die("Database connection failed");
}

?>