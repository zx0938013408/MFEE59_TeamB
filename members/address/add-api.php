<?php
require __DIR__ . '/../parts/init.php';
header('content-Type: application/json');

$output = [
  'success' => false,
  'bodyData' => $_POST,
  'code' => 0,
  'error' => '',
  'lastInsertId' => 0,
];


$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$favorite_sport = empty($_POST['favorite_sport']) ? null : $_POST['favorite_sport'];

// 從資料庫動態獲取合法選項
$valid_sports = [];
$sql_get_set = "SHOW COLUMNS FROM `members` LIKE 'favorite_sport'";
$result = $pdo->query($sql_get_set)->fetch();
if ($result) {
    // 解析 SET 定義中的合法選項
    preg_match("/^set\((.*)\)$/i", $result['Type'], $matches);
    if (isset($matches[1])) {
        $valid_sports = str_getcsv($matches[1], ',', "'");
    }
}

if ($favorite_sport) {
    $sports_array = explode(',', $favorite_sport);
    foreach ($sports_array as $sport) {
        if (!in_array($sport, $valid_sports)) {
            $output['error'] = "包含無效的球類選項: $sport";
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    $favorite_sport = implode(',', $sports_array);
} else {
    $output['error'] = "必須選擇至少一個球類選項";
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `members`(`name`, `gender`, `favorite_sport`, `birthday_date`, `address`, `phone`, `email`, `password`, `created_at`, `updated_at`) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['name'],
  $favorite_sport,
  $_POST['email'],
  $password
]);

$output['success'] = !!$stmt->rowCount();
$output['lastInsertId'] = $pdo->lastInsertId();
$output['rowCount'] = $stmt->rowCount();

echo json_encode($output, JSON_UNESCAPED_UNICODE);
