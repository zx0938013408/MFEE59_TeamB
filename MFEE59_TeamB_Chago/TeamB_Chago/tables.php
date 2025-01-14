<? 
    require __DIR__. '/../parts/init.php';
?>

<?php

require __DIR__. '/../parts/db-connect.php';


# 套入資料
$sql_activity = sprintf("SELECT activity_list.id as activity_list_id , sport_name, activity_list.activity_name, activity_time, members.name
FROM `activity_list`
JOIN sport_type on activity_list.sport_type_id = sport_type.id
JOIN areas on activity_list.area_id = areas.area_id
JOIN court_info on activity_list.court_id = court_info.id
JOIN members on activity_list.founder_id = members.id
");
$rows = $pdo -> query($sql_activity)->fetchAll(PDO::FETCH_ASSOC);

$sql_registered = sprintf("SELECT registered.id, members.name, activity_name, num, notes
FROM `registered`
JOIN members on registered.member_id = members.id
JOIN activity_list on registered.activity_id = registered.id
");
$rows_R = $pdo -> query($sql_registered)->fetchAll(PDO::FETCH_ASSOC);



?>

<!-- HTML開始 -->
<?php include __DIR__. '/../parts/html-header.php' ?>
<?php include __DIR__. '/../parts/html-navbar.php' ?>
<?php include __DIR__. '/../parts/html-outsidenav.php' ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    活動列表
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>運動類型</th>
                                <th>活動名稱</th>
                                <th>活動時間</th>
                                <th>創立者</th>
                                <th>編輯</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>運動類型</th>
                                <th>活動名稱</th>
                                <th>活動時間</th>
                                <th>創立者</th>
                                <th>編輯</th>
                                <th>刪除</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach($rows as $r): ?>
                            <tr>
                                <td><?= $r['activity_list_id'] ?></td>
                                <td><?= $r['sport_name'] ?></td>
                                <td><?= $r['activity_name'] ?></td>
                                <td><?= $r['activity_time'] ?></td>
                                <td><?= $r['name'] ?></td>
                                <td>
                                    <a href="#">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#">
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
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>




<?php include __DIR__. '/../parts/html-outsidetail.php' ?>
<?php include __DIR__. '/../parts/html-script.php' ?>
<?php include __DIR__. '/../parts/html-tail.php' ?>