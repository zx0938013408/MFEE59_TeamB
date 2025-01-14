<?php

require __DIR__ . '/../parts/init.php';
header('Content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'bodyData' => $_POST, # 除錯的用途
  'code' => 0, # 自訂的編號, 除錯的用途
  'error' => '', # 回應給前端的錯誤訊息
];

 

$sql = "UPDATE `admins` SET
 `name`=?,
 `phone`=?,
 `email`=?,
 `password`=? 
 WHERE `id` = ?";

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
  $_POST['id'],
  
]);

$output['success'] = !! $stmt->rowCount();


echo json_encode($output, JSON_UNESCAPED_UNICODE);