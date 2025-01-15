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
];


$sql = "UPDATE `members` SET 
  `name`=?,
  `gender`=?,
  `favorite_sport`=?,
  `email`=?,
  `phone`=?,
  `birthday_date`=?,
  `address`=?
  WHERE `id`=? ";

# ********* TODO: 欄位檢查 *************

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $output['code'] = 401;
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

$gender = empty($_POST['gender']) ?null : $_POST['gender'];
if (!in_array($gender, ['男', '女', '其他'])) {
    $output['error'] = '無效的性別選項';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$favorite_sport = empty($_POST['favorite_sport']) ? null : $_POST['favorite_sport'];

if (!in_array($favorite_sport, ['籃球', '羽球', '排球'])) {
    $output['error'] = '無效的球類選項';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['name'],
    $gender,
    $favorite_sport,
    $email,
    $_POST['phone'],
    $birthday,
    $_POST['address'],
    $_POST['id']
 
]);

$output['success'] = !! $stmt->rowCount(); # 修改了幾筆, 轉布林值

$output['bodyData'] = $_POST;
echo json_encode($output, JSON_UNESCAPED_UNICODE);
