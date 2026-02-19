<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . "/../db.php";
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid id");
$stmt = $conn->prepare("DELETE FROM cars WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
header("Location: admin_cars.php");
exit;
