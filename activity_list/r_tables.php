<?
# 檢查是否為管理者
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';
$title ="活動成員管理";
$pageName="registered_admin";

?>

<?php

require __DIR__ . '/../parts/db-connect.php';


# 套入資料
$sql_activity = sprintf("SELECT activity_list.id as activity_list_id , sport_name, activity_list.activity_name, activity_time, members.name, need_num, SUM(registered.num) AS total_registered
FROM `activity_list`
JOIN sport_type on activity_list.sport_type_id = sport_type.id
JOIN areas on activity_list.area_id = areas.area_id
JOIN court_info on activity_list.court_id = court_info.id
JOIN members on activity_list.founder_id = members.id
LEFT JOIN registered ON registered.activity_id = activity_list.id
GROUP BY activity_list.id
");
$rows = $pdo->query($sql_activity)->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- HTML開始 -->
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">活動成員管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="index_.php" class="text-decoration-none text-secondary">首頁</a></li>
            <li class="breadcrumb-item active fw-bold">活動成員管理</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-user"></i>
                活動清單列表
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>運動類型</th>
                            <th>活動名稱</th>
                            <th>活動時間</th>
                            <th>已報名人數</th>
                            <th>需求人數</th>
                            <th>揪團召集人</th>
                            <th>編輯</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>運動類型</th>
                            <th>活動名稱</th>
                            <th>活動時間</th>
                            <th>已報名人數</th>
                            <th>需求人數</th>
                            <th>揪團召集人</th>
                            <th>編輯</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><?= $r['activity_list_id'] ?></td>
                                <td><?= $r['sport_name'] ?></td>
                                <td><?= $r['activity_name'] ?></td>
                                <td><?= $r['activity_time'] ?></td>
                                <td>
                                    <?php
                                    // 顯示總報名人數
                                    $total_registered = $r['total_registered'] ? $r['total_registered'] : 0;
                                    echo $total_registered;
                                    ?>
                                </td>
                                <td>
                                    <?= $r['need_num'] ?>
                                </td>
                                <td><?= $r['name'] ?></td>
                                <td>
                                    <a href="r_activity_registered.php?id=<?= ($r['activity_list_id']) ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


<?php include __DIR__ . '/../parts/html-footer.php' ?>
<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<?php include __DIR__ . '/../parts/html-tail.php' ?>