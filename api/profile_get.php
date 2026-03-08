<?php
require __DIR__ . '/../vendor/autoload.php';

$email = $_GET['email'] ?? '';

if (!$email) {
    echo json_encode(["error" => "Email required"]);
    exit();
}

$mongoUri = getenv('MONGODB_URI') ?: "mongodb+srv://arunthiga:arunthiga123@guvicluster.oha3mwh.mongodb.net/?appName=guvicluster";
$client = new MongoDB\Client($mongoUri);
$collection = $client->guvi->profiles;

$profile = $collection->findOne(["email" => $email]);

if ($profile) {
    echo json_encode($profile);
} else {
    echo json_encode(["email" => $email, "new_user" => true]);
}
?>
