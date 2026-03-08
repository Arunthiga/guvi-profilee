<?php
header('Content-Type: text/plain');
echo "OK\n";
echo "PHP: " . phpversion() . "\n";
echo "MongoDB: " . (extension_loaded('mongodb') ? "YES" : "NO") . "\n";
?>
