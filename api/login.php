<?php
include "db.php";
require_once "redis_db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo "Missing data";
    exit();
}

$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()){
    if (password_verify($password, $user['password'])) {
        // Generate a session token
        $token = bin2hex(random_bytes(16));
        
        // Save user data in Redis
        $userData = [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $email
        ];
        createSession($token, $userData);
        
        // Return success and token
        echo json_encode(["status" => "success", "token" => $token, "email" => $email]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
    }
}else{
    echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
}
$stmt->close();
$conn->close();
?>