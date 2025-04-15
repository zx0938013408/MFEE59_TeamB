<?php
require __DIR__ . '/../parts/admin-required.php'; 
require __DIR__ . '/../parts/init.php';

// 檢查是否有 `id` 參數
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 定義返回的頁面URL，默認是 'list.php'
$come_from = 'p_list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
  // 從哪個頁面來的，避免重定向到不存在的頁面
  $come_from = $_SERVER['HTTP_REFERER'];
}

// 確保 `ab_id` 是正確的
if ($id > 0) {
    // 查找商品是否存在
    $sql_check = "SELECT COUNT(1) FROM products WHERE id = :id";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':id', $id , PDO::PARAM_INT);
    $stmt_check->execute();

    $exists = $stmt_check->fetchColumn();
    
    if ($exists) {
        // 刪除該商品
        $sql_delete = "DELETE FROM products WHERE id = :id";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':id', $id , PDO::PARAM_INT);

        // 執行刪除
        if ($stmt_delete->execute()) {
            // 成功刪除，重定向回來
            header("Location: $come_from"); 
            exit;
        } else {
            // 刪除失敗，顯示錯誤訊息並跳轉
            echo "刪除失敗，請稍後再試。";
            exit;
        }
    } else {
        // 如果商品不存在
        echo "商品不存在或已被刪除。";
        exit;
    }
} else {
    // 無效的商品 ID
    echo "無效的商品 ID!";
    exit;
}

