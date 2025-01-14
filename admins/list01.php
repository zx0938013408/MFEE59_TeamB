<?php
header('Content-Type: application/json');

require __DIR__. "/../parts/db-connect.php";

$sql = "SELECT * FROM `admins`";
$stmt = $pdo ->query($sql);

$rows = $stmt->fetchAll();
echo json_encode($rows, JSON_UNESCAPED_UNICODE);
