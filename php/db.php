<?php

$host = "sql206.byetcluster.com";
$user = "if0_41323346";
$password = "arunthi1825";
$database = "if0_41323346_guvi_users";

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    die("Database connection failed");
}

?>