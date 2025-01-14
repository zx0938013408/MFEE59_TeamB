<?php
# 要是管理者才可以看到這個頁面
// require __DIR__ . '/../parts/admin-required.php';

require __DIR__ . '/../parts/init.php';
header('content-Type: application/json');

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST, # 除錯的用途
    'code' => 0, # 自訂的編號, 除錯的用途
    'error' => '', # 回應給前端的錯誤訊息
];


$sql = "UPDATE `address_book` SET 
  `name`=?,
  `email`=?,
  `mobile`=?,
  `birthday`=?,
  `address`=?
  WHERE `ab_id`=? ";

# ********* TODO: 欄位檢查 *************

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if (! $email) {
    $output['code'] = 401; # 自行決定的除錯編號
    $output['error'] = '請填寫正確的 Email !';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


# *** 處理日期
if (empty($_POST['birthday'])) {
    $birthday = null;
} else {
    $birthday = strtotime($_POST['birthday']); # 轉換成 timestamp
    if ($birthday === false) {
        // 如果格式是錯的, 無法轉換
        $birthday = null;
    } else {
        $birthday = date("Y-m-d", $birthday);
    }
}

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $birthday,
    $_POST['address'],
    $_POST['ab_id']
]);

$output['success'] = !! $stmt->rowCount(); # 修改了幾筆, 轉布林值


echo json_encode($output, JSON_UNESCAPED_UNICODE);
