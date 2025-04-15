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
  'debug' => '',
];

try {
$sql = "UPDATE `products` 
        SET 
          `image` = ?,
          -- `product_code` = ?,
          `product_name`= ?,
          `category_id` = ?,
          `size` = ?,
          `price` = ?,
          `color` = ?,
          `inventory` = ?,
          `product_description` = ?
        WHERE `id` = ?";
# ********* TODO: 欄位檢查 *************

$requiredFields = [ 'product_name', 'category_id', 'price', 'inventory'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $output['code'] = 400;
        $output['error'] = '請填寫完整的資料';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

#  empty() 檢查欄位是否為空。這可能導致數值為 0 時被判定為空。建議改用 isset() 和嚴格比較
// $requiredFields = ['product_name', 'category_id', 'price', 'inventory'];
// foreach ($requiredFields as $field) {
//     if (!isset($_POST[$field]) || $_POST[$field] === '') {
//         $output['code'] = 400;
//         $output['error'] = '請填寫完整的資料';
//         echo json_encode($output, JSON_UNESCAPED_UNICODE);
//         exit;
//     }
// }

# 驗證數值類型欄位
if ($_POST['price'] <= 0 || $_POST['inventory'] < 0) {
  $output['code'] = 401;
  $output['error'] = '價格需大於 0，庫存不能小於 0';
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['image'],
  // $_POST['product_code'],
  $_POST['product_name'],
  $_POST['category_id'],
  $_POST['size'],
  $_POST['price'],
  $_POST['color'],
  $_POST['inventory'], 
  $_POST['product_description'],
  $_POST['id'],

]);
$id = isset($_POST['id']) ? $_POST['id'] : null;
$image = isset($_POST['image']) ? $_POST['image'] : null;
// $product_code = isset($_POST['product_code']) ? $_POST['product_code'] : null;

$output['success'] = !! $stmt->rowCount(); # 修改了幾筆, 轉布林值

} catch (PDOException $e) {
  $output['error'] = '資料庫操作失敗';
  $output['debug'] = [
      'message' => $e->getMessage(),
      'file' => $e->getFile(),
      'line' => $e->getLine(),
  ];
} catch (Exception $e) {
  $output['error'] = '系統發生錯誤';
  $output['debug'] = [
      'message' => $e->getMessage(),
      'file' => $e->getFile(),
      'line' => $e->getLine(),
  ];
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
