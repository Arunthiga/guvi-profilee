<?php
echo "<h1>Database Connection Test</h1>";

$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$database = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT') ?: 3306;

echo "<p><strong>Host:</strong> $host</p>";
echo "<p><strong>User:</strong> $user</p>";
echo "<p><strong>Port:</strong> $port</p>";
echo "<p><strong>Database:</strong> $database</p>";
echo "<p><strong>Password Length:</strong> " . strlen($password) . "</p>";

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL); 
$success = mysqli_real_connect($conn, $host, $user, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

if($success){
    echo "<h2 style='color:green'>Success! Connection established.</h2>";
} else {
    echo "<h2 style='color:red'>Failed!</h2>";
    echo "<p>Error: " . mysqli_connect_error() . "</p>";
    echo "<p>Error Code: " . mysqli_connect_errno() . "</p>";
}
?>
