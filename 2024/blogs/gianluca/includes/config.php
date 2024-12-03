<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'mysql2.webland.ch');
define('DB_NAME', 'd041e_gibarbieri');
define('DB_USER', 'd041e_gibarbieri'); 
define('DB_PASS', 'BLJ_db_2024');

define('BASE_URL', '/PHP-Projekt/WorkingDir/2024/blogs/gianluca');

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/html; charset=utf-8');
?>