<?php
# 檢查是否為管理者
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

header('Content-Type: application/json');  // 設置回傳的資料格式為 JSON

$output = [
    'success' => false,          // 是否成功
    'bodyData' => $_POST,        // 用於除錯顯示前端傳來的資料
    'code' => 0,                 // 自訂編號，除錯用途
    'error' => '',               // 回應錯誤訊息
    'lastInsertId' => 0,         // 最後插入的 ID
];

try {
    // 假設你有 `member_id`, `activity_id`, `num`, `notes` 欄位
    $sql = "INSERT INTO `registered` (`member_id`, `activity_id`, `num`, `notes`) 
            VALUES (?, ?, ?, ?)";

    // 使用預處理語句
    $stmt = $pdo->prepare($sql);

    // 執行 SQL，將資料插入到 `members` 表中
    $stmt->execute([
        $_POST['add_memberId'],    // 會員 ID
        $_POST['add_activityId'],  // 活動 ID
        $_POST['add_num'],          // 參與數量
        $_POST['add_notes']         // 備註
    ]);

    // 確認資料是否成功插入
    $output['success'] = !!$stmt->rowCount();  // 檢查有沒有新增資料
    $output['lastInsertId'] = $pdo->lastInsertId(); // 取得最後插入的 ID
} catch (Exception $e) {
    // 如果有錯誤，將錯誤訊息存入 output
    $output['error'] = $e->getMessage();
}

echo json_encode([
    'rowCount' => $stmt->rowCount(),   // 返回影響的列數 (新增的資料筆數)
    'lastInsertId' => $pdo->lastInsertId(),  // 返回最後插入的 ID
    'success' => $output['success'],   // 新增是否成功
    'error' => $output['error'],       // 錯誤訊息（如果有）
], JSON_UNESCAPED_UNICODE);