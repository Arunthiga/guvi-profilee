<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Predis\Client as RedisClient;

try {
    $redis = new RedisClient([
        'scheme'   => 'tcp',
        'host'     => REDIS_HOST,
        'port'     => REDIS_PORT,
        'password' => REDIS_PASS,
    ]);
} catch (Exception $e) {
    die(json_encode(["status" => "error", "message" => "Redis Connection failed: " . $e->getMessage()]));
}

function createSession($token, $userData) {
    global $redis;
    // Store user data in Redis with 1 hour expiration
    $redis->setex("session:$token", 3600, json_encode($userData));
}

function getSession($token) {
    global $redis;
    $data = $redis->get("session:$token");
    return $data ? json_decode($data, true) : null;
}

function destroySession($token) {
    global $redis;
    $redis->del("session:$token");
}
?>

