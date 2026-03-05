<?php
include "db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $db_password = $row['password'];

    if(password_verify($password, $db_password)) {
        echo "success";
    } else {
        echo "wrong password";
    }

} else {
    echo "user not found";
}
?>