<?php
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

// 檢查是否有 `id` 參數
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 定義返回的頁面URL，默認是 'list.php'
$come_from = 'o_list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    // 從哪個頁面來的，避免重定向到不存在的頁面
    $come_from = $_SERVER['HTTP_REFERER'];
}

if ($id > 0) {
    // 刪除子表中的相關記錄
    $sql_delete_items = "DELETE FROM order_items WHERE Order_id = :Order_id";
    $stmt_items = $pdo->prepare($sql_delete_items);
    $stmt_items->bindParam(':Order_id', $id, PDO::PARAM_INT);
    $stmt_items->execute();

    // 刪除主表中的記錄
    $sql_delete_order = "DELETE FROM orders WHERE Order_id = :Order_id";
    $stmt_order = $pdo->prepare($sql_delete_order);
    $stmt_order->bindParam(':Order_id', $id, PDO::PARAM_INT);

    if ($stmt_order->execute()) {
        header("Location: $come_from?rand=" . time());
        exit;
    } else {
        echo "刪除失敗：" . implode(" ", $stmt_order->errorInfo());
        exit;
    }
} else {
    echo "無效的訂單 ID!";
    exit;
}

