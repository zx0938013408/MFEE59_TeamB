<?php
# 檢查是否為管理者
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

header('Content-Type: application/json');


$output = [
    'success' => false, # 有沒有新增成功
    'bodyData' => $_POST, # 除錯的用途
    'code' => 0, # 自訂的編號, 除錯的用途
    'error' => '', # 回應給前端的錯誤訊息
    'lastInsertId' => 0, # 最新拿到的 PK
    'debug' => '',
];


try {
    # 將商品資料寫入資料庫
    $sql = "INSERT INTO `products` 
(`image`, `product_code`, `product_name`, `category_id`, `size`, `price`, `color`, `inventory`, `product_description`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";


    # ********* TODO: 欄位檢查 *************

    // $requiredFields = ['product_code', 'product_name', 'category_id', 'price', 'inventory'];
    // foreach ($requiredFields as $field) {
    //     if (empty($_POST[$field])) {
    //         $output['code'] = 400;
    //         $output['error'] = '請填寫完整的資料';
    //         echo json_encode($output, JSON_UNESCAPED_UNICODE);
    //         exit;
    //     }
    // }

    $requiredFields = ['image', 'product_code', 'product_name', 'category_id', 'size', 'price', 'color', 'inventory', 'product_description'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === '') {
            $output['code'] = 400;
            $output['error'] = '請填寫完整的資料';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    # 驗證數值類型欄位
    if ($_POST['price'] <= 0 || $_POST['inventory'] < 0) {
        $output['code'] = 401;
        $output['error'] = '價格需大於 0，庫存不能小於 0';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }

    #檢查商品編號重複
    $sqlCheck = "SELECT COUNT(*) FROM products WHERE product_code = ?";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([$_POST['product_code']]);
    $rowCount = $stmtCheck->fetchColumn();

    if ($rowCount > 0) {
        $output['error'] = '此產品代碼已經存在';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }



    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST["image"],
        $_POST['product_code'],
        $_POST['product_name'],
        $_POST['category_id'],
        $_POST['size'],
        $_POST['price'],
        $_POST['color'],
        $_POST['inventory'],
        $_POST['product_description'],
    ]);

    $output['success'] = !! $stmt->rowCount(); # 新增了幾筆, 轉布林值
    $output['lastInsertId'] = $pdo->lastInsertId(); # 最新拿到的 PK

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
