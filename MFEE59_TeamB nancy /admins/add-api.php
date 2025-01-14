<?php

require __DIR__ . '/../parts/init.php';
header('Content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'bodyData' => $_POST, # 除錯的用途
  'code' => 0, # 自訂的編號, 除錯的用途
  'error' => '', # 回應給前端的錯誤訊息
  'lastInsertId' => 0, # 最新拿到的 PK
];
$sql = "INSERT INTO admins
  ( `name`, `phone`, `email`,`password`) VALUES ( ?, ?, ?, ? )";

# ********* TODO: 欄位檢查 *************

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$email) {
    $output['code'] = 401;
    $output['error'] = '請填寫正確的 Email !';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['name'],
  $_POST['phone'],
  $_POST['email'],
  $_POST['password'],
  
]);

$output['success'] = !! $stmt->rowCount(); # 新增了幾筆, 轉布林值
$output['lastInsertId'] = $pdo->lastInsertId(); # 最新拿到的 PK

echo json_encode($output, JSON_UNESCAPED_UNICODE);