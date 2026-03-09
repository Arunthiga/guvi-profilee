<?php
require_once "redis_db.php";
require_once "mongo_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $token = $_POST['token'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!$token || !$email) {
        echo "Unauthorized";
        exit();
    }

    $session = getSession($token);
    if (!$session || $session['email'] !== $email) {
        echo "Invalid session";
        exit();
    }

    $collection = $mongoDb->profiles;

    $data = [
        "email" => $email,
        "fullname" => $_POST['fullname'] ?? "",
        "skills" => $_POST['skills'] ?? "",
        "gender" => $_POST['gender'] ?? "",
        "country" => $_POST['country'] ?? "",
        "age" => $_POST['age'] ?? "",
        "dob" => $_POST['dob'] ?? "",
        "contact" => $_POST['contact'] ?? "",
        "city" => $_POST['city'] ?? "",
        "bio" => $_POST['bio'] ?? ""
    ];

    $collection->updateOne(
        ["email" => $email],
        ['$set' => $data],
        ["upsert" => true]
    );

    echo "Profile Saved Successfully";
}
?>