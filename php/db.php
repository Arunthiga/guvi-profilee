
<?php
$conn = new mysqli("localhost", "root", "", "guvi_users");
if ($conn->connect_error) {
    die("DB Connection Failed");
}
?>
