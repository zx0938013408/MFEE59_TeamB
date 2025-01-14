<?php
# 要是管理者才可以看到這個頁面
require __DIR__ . '/../parts/init.php';

# 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

if ($id) {
  $sql = "DELETE FROM members WHERE id={$id} ";
  $pdo->query($sql);
}


$come_from = 'list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
  # 從哪個頁面來的
  $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: $come_from");
exit;
?>