<?php
# 檢查是否為管理者
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

// 檢查是否收到 POST 資料
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 確保有收到必要的資料
    if (isset($_POST['registered_id'], $_POST['num'], $_POST['notes'])) {
        // 獲取 POST 資料
        $registeredId = intval($_POST['registered_id']); // 註冊資料的 ID
        $num = intval($_POST['num']); // 人數
        $notes = $_POST['notes']; // 備註

        // 更新 SQL 語句
        $sql = "UPDATE registered SET num = ?, notes = ? WHERE id = ?";
        // $sql = "UPDATE registered SET num = ?, notes = ? WHERE id = ?";
        
        // 使用 PDO 預處理語句
        $stmt = $pdo->prepare($sql);
        
        // 執行 SQL，將資料更新到資料庫
        $stmt->execute([$num, $notes, $registeredId]);

        // 檢查更新是否成功
        if ($stmt->rowCount() > 0) {
            // 回傳成功
            echo json_encode(['success' => true, 'message' => '資料已成功更新']);
        } else {
            // 若沒有資料被更新
            echo json_encode(['success' => false, 'message' => '資料更新失敗']);
        }
    } else {
        // 若未收到必要資料
        echo json_encode(['success' => false, 'message' => '缺少必要的資料']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '無效的請求方法']);
}

?>