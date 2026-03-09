require_once "redis_db.php";
require_once "mongo_db.php";

$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';

if (!$token || !$email) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit();
}

$session = getSession($token);

if (!$session || $session['email'] !== $email) {
    echo json_encode(["status" => "error", "message" => "Invalid session"]);
    exit();
}

$collection = $mongoDb->profiles;
$profile = $collection->findOne(["email" => $email]);

if ($profile) {
    echo json_encode($profile);
} else {
    echo json_encode(["email" => $email, "new_user" => true]);
}
