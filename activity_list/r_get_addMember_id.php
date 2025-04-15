<?php
# 檢查是否為管理者
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

// 獲取姓名
$data = json_decode(file_get_contents('php://input'), true);
$name = isset($data['name']) ? trim($data['name']) : '';
// 獲取id
$member_id = isset($data['id']) ? trim($data['id']) : '';

$response = ['success' => false, 'member_id' => ''];

// 檢查姓名是否有提供
if (!empty($name)) {
    // 查詢資料庫中對應的會員
    $sql = "SELECT `id` FROM `members` WHERE `name` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name]);
    $member = $stmt->fetch();

    if ($member) {
        // 如果找到對應的會員 ID，回傳成功並顯示會員 ID
        $response['success'] = true;
        $response['member_id'] = $member['id'];
    }
}


// 回傳 JSON 格式的結果
echo json_encode($response);

?>
