<?php

require_once 'config.php';

$conn = mysqli_init();
if (getenv('MYSQLHOST')) {
    // Apply SSL if running on a remote host (like Aiven)
    mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL); 
    mysqli_real_connect($conn, DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, NULL, MYSQLI_CLIENT_SSL);
} else {
    mysqli_real_connect($conn, DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
}

if(!$conn){
    die("Database connection failed");
}

?>