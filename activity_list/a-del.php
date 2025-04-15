<?php
require __DIR__ ."/../parts/admin-required.php";
require __DIR__ . '/../parts/init.php';

# 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

if ($id) {
  $sql = "DELETE FROM admins WHERE id={$id} ";
  $pdo->query($sql);
}

$come_from = 'a-list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
  # 從哪個頁面來的
  $come_from = $_SERVER['HTTP_REFERER'];
}


header("Location: $come_from");