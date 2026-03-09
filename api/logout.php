<?php
require_once "redis_db.php";

$token = $_POST['token'] ?? '';

if ($token) {
    destroySession($token);
}

echo "success";
