<?php

require __DIR__ . '/../parts/init.php';
header('content-Type: application/json');

$output = [
  'success' => false, # 有沒有登入成功
  'bodyData' => $_POST, # 除錯的用途
  'code' => 0, # 自訂的編號, 除錯的用途
];

# 帳號或密碼其中有一個欄位沒值, 就離開
if (empty($_POST['email']) or empty($_POST['password'])) {
  echo json_encode($output);
  exit;
}
# trim() 去掉頭尾的空白字元
$email = trim($_POST['email']);
$password = trim($_POST['password']);
# 1. 先確認帳號是否正確
$sql = "SELECT * FROM admins WHERE email=? ";

$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$row = $stmt->fetch();

# 2. 找不到帳號, 帳號是錯的, 就離開
if (empty($row)) {
  $output['code'] = 400;
  echo json_encode($output);
  exit;
}
if ($password !== $row['password']) {
  $output['code'] = 420;
  echo json_encode($output);
  exit;
}

# 帳密都是對的, 把狀態存到 session

$_SESSION['admin'] = [
  'id' => $row['id'],
  'email' => $email,
  'phone' => $row['phone']
];
$output['success'] = true;

echo json_encode($output, JSON_UNESCAPED_UNICODE);

# 登入成功後記錄登入日誌
$admin_id = $_SESSION['admin']['id'];  // 獲取已登入管理員ID
$ip_address = $_SERVER['REMOTE_ADDR'];  // 獲取用戶IP地址

# 準備 SQL 語句
$log_sql = "INSERT INTO admin_login_logs 
(adminer_id, 
ip_address) VALUES 
(?, ?)";
$log_stmt = $pdo->prepare($log_sql);

# 執行 SQL 語句
$log_stmt->execute([$admin_id, $ip_address]);

if ($log_stmt->rowCount()) {
    $log_message = "登入日誌記錄成功";
} else {
    $log_message = "登入日誌記錄失敗";
}

$output['success'] = true;
$output['logMessage'] = $log_message;  // 添加日誌消息到輸出

echo json_encode($output, JSON_UNESCAPED_UNICODE);