<?php

require __DIR__ . '/parts/init.php';

header('content-Type: application/json');

# echo json_encode($_POST, JSON_UNESCAPED_UNICODE);

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST, # 除錯用途
    'code' => 0, # 自訂編號, 除錯用途
    'error' => '', # 回應給前端的錯誤訊息
    'lastInsertId' => 0, # 拿到最新 PK
];

/*
// 獲取用戶輸入的創建人姓名
$founder_name = $_POST['name'];  // 假設表單中傳遞的欄位為 'founder_name'

// 查詢 `members` 資料表中的 id
$sql_member = "SELECT id FROM members WHERE name = :name LIMIT 1";
$stmt_member = $pdo->prepare($sql_member);
$stmt_member->bindParam(':name', $founder_name, PDO::PARAM_STR);
$stmt_member->execute();

if ($stmt_member->rowCount() > 0) {
    // 如果找到該創建人的 ID
    $member_id = $stmt_member->fetch(PDO::FETCH_ASSOC)['id'];
    
    // 確保活動名稱的 id (這邊假設有一個 `activity_list` 的活動名稱與 id 的關聯)
    // $activity_id = $_POST['activity_id'];  // 假設前端傳來的活動 id
*/

// 插入新參加者資料
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 從表單獲取其他資料
    $member_id = $_POST['name'];  // 參加者 ID
    $num = $_POST['numbers'];  // 參加人數
    $notes = $_POST['notes'];  // 備註

$sql_insert = "INSERT INTO `registered`
(`member_id`, `num`, `notes`) 
VALUES ( ?, ?, ? )";

$stmt = $pdo->prepare($sql_insert);
$stmt->execute([
    // TODO:　檢查如何套入　member_id
    $_POST['name'],
    // $_POST['activity_id'],
    $_POST['numbers'],
    $_POST['notes']
]);

echo "成功加入參加者！";
}


/*
$output['success'] = !! $stmt->rowCount(); # 新增了幾筆, 轉布林值
$output['lastInsertId'] = $pdo->lastInsertId(); # 最新拿到的 PK
} else {
    // 如果找不到該創建人姓名，返回錯誤訊息
    $output['error'] = '創建人姓名未找到';
}
*/

/*
#錯誤作法: 直接把值塞進去
$sql = "INSERT INTO `activity_list`(`activity_name`, `sport_type_id`, `area_id`, `court_id`, `activity_time`, `deadline`, `payment`, `need_num`, `introduction`, `founder_id`) 
VALUES (
'{$_POST['activity_name']}',
'{$_POST['sport_type_id']}',
'{$_POST['area_id']}',
'{$_POST['court_id']}',
'{$_POST['activity_time']}',
'{$_POST['deadline']}',
'{$_POST['payment']}',
'{$_POST['need_num']}',
'{$_POST['introduction']}',
'{$_POST['founder_id']}'
)";

$stmt = $pdo->query($sql);
*/

// echo json_encode($output, JSON_UNESCAPED_UNICODE);


echo json_encode([
    'rowCount'=>$stmt->rowCount(), # 影響了幾列, 新增幾筆
    'lastInsertId' => $pdo->lastInsertId(), # 最新拿到的 PK

], JSON_UNESCAPED_UNICODE);