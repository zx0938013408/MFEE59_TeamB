<?php

# 僅允許管理者存取此頁面
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'bodyData' => $_POST,
    'code' => 0,
    'error' => '',
    'lastInsertId' => 0,
];

# 檢查必要欄位是否存在
if (
    empty($_POST['activity_name']) ||
    empty($_POST['sport_type_id']) ||
    empty($_POST['area_id']) ||
    empty($_POST['court_id']) ||
    empty($_POST['founder_id'])
) {
    $output['error'] = '必填欄位缺失';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

# 定義 SQL 語句
$sql = "INSERT INTO `activity_list`(
    `activity_name`,
    `photo_url`,
    `sport_type_id`,
    `area_id`,
    `court_id`,
    `activity_time`,
    `deadline`,
    `payment`,
    `need_num`,
    `introduction`,
    `founder_id`
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

# 處理活動時間
$activity_time = null;
if (!empty($_POST['activity_time'])) {
    $activity_time = strtotime($_POST['activity_time']);
    if ($activity_time !== false) {
        $activity_time = date("Y-m-d H:i:s", $activity_time);
    }
}

# 處理截止日期
$deadline = null;
if (!empty($_POST['deadline'])) {
    $deadline = strtotime($_POST['deadline']);
    if ($deadline !== false) {
        $deadline = date("Y-m-d H:i:s", $deadline);
    }
}

# 預設圖片 URL
$photo_url = $_POST['photo_url'] ?? 'https://example.com/photo.jpg';

try {
    # 插入活動資料
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['activity_name'],
        $photo_url,
        $_POST['sport_type_id'],
        $_POST['area_id'],
        $_POST['court_id'],
        $activity_time,
        $deadline,
        $_POST['payment'] ?? 0.00, # 預設為 0.00
        $_POST['need_num'] ?? 0,   # 預設為 0
        $_POST['introduction'] ?? '',
        $_POST['founder_id']
    ]);

    $output['success'] = !!$stmt->rowCount();
    $output['lastInsertId'] = $pdo->lastInsertId(); # 獲取最後插入的活動 ID
} catch (PDOException $e) {
    $output['error'] = $e->getMessage();
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
