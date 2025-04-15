<?php
# 要是管理者才可以看到這個頁面
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

header('Content-Type: application/json'); // 設定回傳格式為 JSON

$output = [
    'success' => false,
    'error' => '',
    'data' => [],
    'totalPrice' => 0,
];

// 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

// 沒拿到 id 就不做，回傳錯誤訊息
if (empty($id)) {
    $output['error'] = '缺少訂單編號';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 讀取該筆資料
$sql = "SELECT 
            orders.Order_id, 
            products.product_code, 
            products.product_name, 
            products.price, 
            products.size, 
            products.color, 
            order_items.quantity
        FROM 
            orders
        JOIN 
            order_items ON orders.Order_id = order_items.order_id
        JOIN 
            products ON products.id = order_items.item_id
        WHERE 
            orders.Order_id = :order_id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['order_id' => $id]); // 傳入參數
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)) {
    $output['error'] = '查無訂單的商品資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$totalPrice = 0; // 初始化總金額

foreach ($rows as $r) {
    $totalPrice += $r['price'] * $r['quantity']; // 計算總金額
}

// 設置回應資料
$output['success'] = true;
$output['data'] = $rows;
$output['totalPrice'] = number_format($totalPrice);

echo json_encode($output, JSON_UNESCAPED_UNICODE);