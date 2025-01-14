<?php
require __DIR__ . '/../parts/init.php';
$title = "管理員資料";
$pageName = "list";

$perPage = 2;


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(*) FROM `admins` ";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
$rows = [];
if ($totalRows > 0) {
    if ($page  > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }




    $sql = sprintf("SELECT * FROM admins ORDER BY id LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}



?>


<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index_.php">後台</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'list' ? 'active' : '' ?>" href="list.php">管理員資料</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'add' ? 'active' : '' ?>" href="add.php">新增管理員</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-4">
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item<?= $page == 1 ? 'disabled' : '' ?> ">
                            <a class="page-link" href="?page=1">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">
                                <i class="fa-solid fa-angle-left"></i>
                            </a>
                        </li>

                        <?php for ($i = $page - 2; $i <= $page + 2; $i++):
                            if ($i >= 1 and $i <= $totalPages):
                        ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                        <?php endif;
                        endfor; ?>
                        <li class="page-item <?= $page == $totalPages ? 'disable' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $totalPages ?> ">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
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
                        <th><i class="fa-solid fa-trash"></i></th>
                            <th>#</th>
                            <th>姓名</th>
                            <th>手機</th>
                            <th>電子信箱</th>
                            <th>密碼</th>
                            <th><i class="fa-solid fa-pen-to-square"></i></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><a href="javascript:deleteOne(<?=$r['id'] ?>)"><i class="fa-solid fa-trash"></i></a></td>
                                <td><?= $r['id'] ?></td>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['phone'] ?></td>
                                <td><?= $r['email'] ?></td>
                                <td><?= $r['password'] ?></td>
                                <td><a href="edit.php?id=<?= $r['id'] ?>">
                <i class="fa-solid fa-pen-to-square"></i>
                </a></td>


                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
    const deleteOne = id =>{
        if (confirm(`是否要刪除編號為 ${id} 的資料？`)){
            location.href = `del.php?id=${id}`;
        }
    }

</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>