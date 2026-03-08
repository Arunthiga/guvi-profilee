<?php
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mongoUri = getenv('MONGODB_URI') ?: "mongodb+srv://arunthiga:arunthiga123@guvicluster.oha3mwh.mongodb.net/?appName=guvicluster";
    $client = new MongoDB\Client($mongoUri);
    $collection = $client->guvi->profiles;

    $data = [
        "email" => $_POST['email'] ?? "",
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
        ["email" => $_POST['email']],
        ['$set' => $data],
        ["upsert" => true]
    );

    echo "Profile Saved Successfully";
}
?>