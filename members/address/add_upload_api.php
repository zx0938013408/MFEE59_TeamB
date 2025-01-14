<?php
# 要是管理者才可以看到這個頁面
// require __DIR__ . '/../parts/admin_required.php';

require __DIR__ . '/../parts/init.php';
header('content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'bodyData' => $_POST, # 除錯的用途
  'code' => 0, # 自訂的編號, 除錯的用途
  'error' => '', # 回應給前端的錯誤訊息
  'lastInsertId' => 0, # 最新拿到的 PK
];
$sql = "INSERT INTO `members` 
  ( `avatar`, `name`, `phone`, `birthday_date`, `address`) VALUES ( ?, ?, ?, ?, ? )";

# ********* TODO: 欄位檢查 *************

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if (! $email) {
  $output['code'] = 401; # 自行決定的除錯編號
  $output['error'] = '請填寫正確的 Email !';
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}


# *** 處理日期
if (empty($_POST['birthday_date'])) {
  $birthday = null;
} else {
  $birthday = strtotime($_POST['birthday_date']); # 轉換成 timestamp
  if ($birthday === false) {
    // 如果格式是錯的, 無法轉換
    $birthday = null;
  } else {
    $birthday = date("Y-m-d", $birthday);
  }
}

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['avatar'] ?? null,
    $gender,
    $birthday,
  $_POST['phone'],
  $_POST['address'],
]);

$output['success'] = !! $stmt->rowCount(); # 新增了幾筆, 轉布林值
$output['lastInsertId'] = $pdo->lastInsertId(); # 最新拿到的 PK

echo json_encode($output, JSON_UNESCAPED_UNICODE);
