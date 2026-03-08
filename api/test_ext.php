<?php
echo "<h1>Extension Test</h1>";
echo "MongoDB Extension: " . (extension_loaded('mongodb') ? "<span style='color:green'>LOADED</span>" : "<span style='color:red'>MISSING</span>");
echo "<br>PHP Version: " . phpversion();
?>
