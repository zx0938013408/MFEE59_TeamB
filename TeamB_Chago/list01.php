<?php
header('Content-Type: application/json');

require __DIR__ . '/parts/db-connect.php';

$sql = "SELECT * FROM `activity_list` LIMIT 3";
$stmt = $pdo->query($sql); # 代理文件

#只拿一筆資料 (最常用先到前面先設定, 這邊不填)
// $row = $stmt->fetch(PDO::FETCH_ASSOC);  #以關聯式陣列取樣
// $row = $stmt->fetch(PDO::FETCH_NUM);  #以索引值呈現
// $row = $stmt->fetch(); #只拿一筆資料
// $row = $stmt->fetch(); #取締二筆資料 ...
// $row = $stmt->fetch();

$rows = $stmt->fetchAll();
echo json_encode($rows, JSON_UNESCAPED_UNICODE);
