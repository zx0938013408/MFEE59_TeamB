<?php

require __DIR__ . '/parts1/init.php';

header('content-Type: application/json');

# echo json_encode($_POST, JSON_UNESCAPED_UNICODE);

$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST, # 除錯用途
    'code' => 0, # 自訂編號, 除錯用途
    'error' => '', # 回應給前端的錯誤訊息
    'lastInsertId' => 0, # 拿到最新 PK
];
$sql = "INSERT INTO `activity_list`(`activity_name`, `sport_type_id`, `area_id`, `court_id`, `activity_time`, `deadline`, `payment`, `need_num`, `introduction`, `founder_id`) 
VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['activity_name'],
    $_POST['sport_type_id'],
    $_POST['area_id'],
    $_POST['court_id'],
    $_POST['activity_time'],
    $_POST['deadline'],
    $_POST['payment'],
    $_POST['need_num'],
    $_POST['introduction'],
    $_POST['founder_name']
]);

# TODO:
// try{
// // 檢查表單是否提交
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// // 獲取表單資料
// $founder_name = $_POST['founder_name'];

// // 查詢會員資料庫，根據會員姓名獲取對應的 ID
// $sql = "SELECT id FROM members WHERE name = :name";
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':name', $founder_name, PDO::PARAM_STR);
// $stmt->execute();

// // 檢查是否找到對應的會員
// if ($stmt->rowCount() > 0) {
// // 取得會員 ID
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// $founder_id = $row['id'];

// // 將 founder_id 插入 activity_list 資料表
// $insert_sql = "INSERT INTO activity_list (founder_id) VALUES (:founder_id)";
// $insert_stmt = $pdo->prepare($insert_sql);
// $insert_stmt->bindParam(':founder_id', $founder_id, PDO::PARAM_INT);
// $insert_stmt->execute();

// echo "活動已成功建立，創建者 ID: " . $founder_id;
// } else {
// echo "找不到對應的會員名稱，請確認姓名是否正確。";
// }
// }
// } catch (PDOException $e) {
// // 捕捉 PDO 異常並顯示錯誤訊息
// echo "資料庫連接錯誤: " . $e->getMessage();
// exit();
// }


$output['success'] = !! $stmt->rowCount(); # 新增了幾筆, 轉布林值
$output['lastInsertId'] = $pdo->lastInsertId(); # 最新拿到的 PK

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