<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Helsinki');
$DB_HOST = "localhost";          
$DB_USER = "amk1011334";    
$DB_PASS = "5TCKgii3"; 
$DB_NAME = "wp_amk1011334";    

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("Connection is failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
$conn->query("SET time_zone = '+02:00'");
?>
