<?php
// Safe setup script using environment variables
require_once 'db.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if(mysqli_query($conn, $sql)){
    echo "<h1 style='color:green'>Table 'users' created successfully!</h1>";
} else {
    echo "<h1 style='color:red'>Error creating table:</h1>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
