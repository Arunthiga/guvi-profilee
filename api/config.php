<?php
// Database Credentials
define('DB_HOST', getenv('MYSQLHOST') ?: 'localhost');
define('DB_USER', getenv('MYSQLUSER') ?: 'root');
define('DB_PASS', getenv('MYSQLPASSWORD') ?: '');
define('DB_NAME', getenv('MYSQLDATABASE') ?: 'guvi_internship');
define('DB_PORT', getenv('MYSQLPORT') ?: 3306);

// MongoDB Configuration
define('MONGO_URI', getenv('MONGODB_URI') ?: 'mongodb://localhost:27017');
define('MONGO_DB', 'guvi_internship');

// Redis Configuration
define('REDIS_HOST', getenv('REDISHOST') ?: '127.0.0.1');
define('REDIS_PORT', getenv('REDISPORT') ?: 6379);
define('REDIS_PASS', getenv('REDISPASSWORD') ?: null);
?>
