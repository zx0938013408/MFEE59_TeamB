<?php
# 要是管理者才可以看到這個頁面

require __DIR__ . '/../parts/init.php';

# 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

if ($id > 0) {
    try {
        $pdo->beginTransaction(); // 開始交易

        // 刪除 registered 表中與 activity_id 關聯的記錄
        $sql1 = "DELETE FROM registered WHERE activity_id = :id";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([':id' => $id]);

        // 刪除 activity_list 表中的記錄
        $sql2 = "DELETE FROM activity_list WHERE id = :id";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([':id' => $id]);

        $pdo->commit(); // 提交交易
        echo "刪除成功";
    } catch (Exception $e) {
        $pdo->rollBack(); // 回滾交易
        echo "刪除失敗：" . $e->getMessage();
    }
} else {
    echo "無效的 ID";
}

$come_from = 'activity_registered.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    # 從哪個頁面來的
    $come_from = $_SERVER['HTTP_REFERER'];
}


header("Location: tables.php");

exit();
