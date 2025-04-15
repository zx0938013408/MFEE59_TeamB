<?php
# 要是管理者才可以看到這個頁面
require __DIR__ . '/../parts/admin-required.php';

require __DIR__ . '/../parts/init.php';
header('content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'bodyData' => $_POST, # 除錯的用途
  'code' => 0, # 自訂的編號, 除錯的用途
  'error' => '', # 回應給前端的錯誤訊息
];

try {
$sql = "UPDATE `orders` 
        SET 
          `PaymentStatus` = ?,
          `OrderStatus` = ?,
          `TotalPrice` = ?
        WHERE `Order_id` = ?";

# 重新計算總金額
$sql_items = "SELECT order_items.quantity, products.price 
              FROM order_items 
              JOIN products ON order_items.item_id = products.id 
              WHERE order_items.order_id = ?";
$stmt_items = $pdo->prepare($sql_items);
$stmt_items->execute([$_POST['Order_id']]);
$orderItems = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

$totalPrice = 0;
foreach ($orderItems as $item) {
    $totalPrice += $item['quantity'] * $item['price'];
}
# ********* TODO: 欄位檢查 *************



#  empty() 檢查欄位是否為空。這可能導致數值為 0 時被判定為空。建議改用 isset() 和嚴格比較
$requiredFields = ['PaymentStatus', 'OrderStatus'];
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || $_POST[$field] === '') {
        $output['code'] = 400;
        $output['error'] = '請填寫完整的資料';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

# 驗證數值類型欄位
if ($_POST['TotalPrice'] <= 0 || trim( $_POST['TotalPrice']) === "") {
  $output['code'] = 401;
  $output['error'] = '總金額需大於 0，且不得為空值';
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['PaymentStatus'],   
  $_POST['OrderStatus'],     
  $_POST['TotalPrice'],          
  $_POST['Order_id'],        // WHERE 條件的參數
]);
$id = isset($_POST['Order_id']) ? $_POST['Order_id'] : null;

$output['success'] = !! $stmt->rowCount(); # 修改了幾筆, 轉布林值

} catch (PDOException $e) {
  $output['error'] = '資料庫操作失敗';
 
} catch (Exception $e) {
  $output['error'] = '系統發生錯誤';
  
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
