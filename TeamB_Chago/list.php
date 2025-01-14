<?php
require __DIR__ . '/parts1/init.php';
    $title = "活動列表";
    $pageName = "activity-list";

$perPage = 5; # 設定每頁最多幾筆

# 設定頁碼
# 變數 ? 如果"是"的呈現方式 : 如果"無"的呈現方式
# if 有頁碼, 設定為整數, if 無, 預設為1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
# 設定page <1 時的處理方法
if ($page < 1) {
    // header('Location: list.php?page=1'); # 跳轉頁面 'Loacation:'後一定要空一格在輸入
    header('Location: ?page=1'); # 可直接設定頁碼
    exit;
};


$t_sql = "SELECT COUNT(1) FROM `activity_list`";
// $rows = $pdo ->query($t_sql)->fetch(PDO::FETCH_NUM);
# 總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

# 總頁數
$totalPages = ceil($totalRows / $perPage);

# 有資料時才抓取
$rows = []; # 設定預設值
if($totalRows > 0){
    if($page > $totalPages){
        #要看的頁碼超出範圍, 到最後一頁
        header('Location: ?page=' . $totalPages);
        exit;
    }

    #第一頁資料 (20筆)
    $sql = sprintf("SELECT activity_list.id as id , sport_name, activity_list.activity_name, activity_time, members.name
    FROM `activity_list`
    JOIN sport_type on activity_list.sport_type_id = sport_type.id
    JOIN areas on activity_list.area_id = areas.area_id
    JOIN court_info on activity_list.court_id = court_info.id
    JOIN members on activity_list.founder_id = members.id
    LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


?>
<!-- HTML開始 -->
<?php include __DIR__ . '/parts1/html-header.php' ?>
<?php include __DIR__ . '/parts1/html-navbar.php' ?>

<!-- 放進表格 -->
<div class="container">
    <div class="row mt-4">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- 設定跳回第一頁 -->
                    <li class="page-item <?= $page==1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page= 1"><i class="fa-solid fa-angles-left"></i></a>
                    </li>
                    <!-- 設定按上一頁 -->
                    <li class="page-item <?= $page==1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                    </li>
                    <!-- 設定頁碼 -->
                    <?php for($i= $page-5; $i<= $totalPages+5; $i++): 
                        if($i>=1 and $i<= $totalPages):
                            ?>
                    <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endif; endfor; ?>
                    <!-- 設定按下一頁 -->
                    <li class="page-item <?= $page==$totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                    </li>
                    <!-- 設定跳到最後一頁 -->
                    <li class="page-item <?= $page==$totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>運動類型</th>
                        <th>活動名稱</th>
                        <th>活動時間</th>
                        <th>創立者</th>
                        <th>編輯</th>
                        <th>刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= htmlentities($r['sport_name']) ?></td>
                            <td><?= htmlentities($r['activity_name']) ?></td>
                            <td><?= htmlentities($r['activity_time']) ?></td>
                            <td><?= htmlentities($r['name']) ?></td>
                            <!-- 編輯 -->
                            <td>
                                <a href="edit.php?id=<?= ($r['id']) ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <!-- 刪除 -->
                            <td>
                                <a href="del.php?id=<?= ($r['id']) ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<?php include __DIR__ . '/parts/html-script.php' ?>
<?php include __DIR__ . '/parts/html-tail.php' ?>




<?php
/*
// echo json_encode($rows, JSON_UNESCAPED_UNICODE);
echo json_encode([
    'totalRows'=>$totalRows,
    'totalPages'=>$totalPages,
    'rows'=>$rows,
],JSON_UNESCAPED_UNICODE);
*/
?>