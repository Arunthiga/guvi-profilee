<?php
echo "PHP Version: " . phpversion() . "\n";
echo "MongoDB Extension: " . (extension_loaded('mongodb') ? "FOUND" : "NOT FOUND") . "\n";
if (class_exists('MongoDB\Driver\Manager')) {
    echo "MongoDB Driver Class: FOUND\n";
} else {
    echo "MongoDB Driver Class: NOT FOUND\n";
}
?>
