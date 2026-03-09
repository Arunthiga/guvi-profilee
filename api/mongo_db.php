<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

try {
    $mongoClient = new MongoDB\Client(MONGO_URI);
    $mongoDb = $mongoClient->selectDatabase(MONGO_DB);
} catch (Exception $e) {
    die(json_encode(["status" => "error", "message" => "MongoDB Connection failed: " . $e->getMessage()]));
}
?>

