<?php
require __DIR__. '/../parts/init.php';

// 從資料庫中選取資料
// 會員資料
$sql_member = "SELECT id, name FROM members";
$result_member = $pdo->query($sql_member);



// 獲取活動 ID
$activity_id = $_GET['id'] ?? null;

# TODO: 輸入會員名稱, 會轉成會員 ID 輸入到 registered 資料庫
// 從 URL 獲取活動 ID，假設 URL 如: activity_register.php?activity_id=42
$activity_id = isset($_GET['activity_id']) ? $_GET['activity_id'] : null;

# TODO: 如何自動抓取 活動ID 並轉成頁面 , 自動更動畫面內容, 以及 新增時ID會輸入到 registered 資料庫
// if (!$activity_id) {
//     echo "活動 ID 無效！";
//     exit;
// }

# 套入資料
$sql = sprintf("
SELECT registered.id as registered_id, members.name, activity_id, activity_name, num, notes, need_num, activity_time, activity_list.introduction as introduction
FROM `registered`
JOIN members on registered.member_id = members.id
JOIN activity_list on registered.activity_id = activity_list.id
WHERE activity_list.id= 3
");
# TODO: 設定id自動抓取轉換

$stmt = $pdo->prepare($sql);
// $stmt->execute([$activity_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$row = $pdo -> query($sql)->fetch(PDO::FETCH_ASSOC);
$rows = $pdo -> query($sql)->fetchAll(PDO::FETCH_ASSOC);

// 計算報名人數總和
$sql_sum = sprintf("
SELECT SUM(num) AS total_registered FROM `registered` where activity_id = 3
");
# TODO: 設定id自動抓取轉換

$stmt_sum = $pdo->prepare($sql_sum);
$stmt_sum->execute();

// 獲取結果
$row_sum = $stmt_sum->fetch(PDO::FETCH_ASSOC);

// 取得總和並賦值給變數
$total_registered = $row_sum['total_registered'];





// 顯示查詢結果
// foreach ($rows as $row) {
//     echo "參加者 ID: " . $row['registered_id'] . "<br>";
//     echo "姓名: " . $row['name'] . "<br>";
//     echo "活動名稱: " . $row['activity_name'] . "<br>";
//     echo "人數: " . $row['num'] . "<br>";
//     echo "備註: " . $row['notes'] . "<br><hr>";
// }


# TODO: 代辦
// if ($activity_list_id) {
//     $stmt->execute(['id' => $activity_id]);
//     // 設定活動名稱，如果沒有找到資料則為空
//     $activity_name = $activity ? $activity['activity_name'] : '';
// } else {
//     $activity_name = '';
// }

# 篩選
$uniqueActivities = [];
foreach ($rows as $r) {
    if (!in_array($r['activity_name'], $uniqueActivities)) {
        $uniqueActivities[] = $r['activity_name'];
    }
}

?>

<!-- HTML開始 -->
<?php include __DIR__. '/../parts/html-header.php' ?>
<?php include __DIR__. '/../parts/html-navbar.php' ?>
<?php include __DIR__. '/../parts/html-outsidenav.php' ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">活動與報名人數清單</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
                <li class="breadcrumb-item"><a href="tables.php">活動列表</a></li>
                <li class="breadcrumb-item active">活動與報名人數清單</li>
            </ol>
            <div class="card mb-4">
                <div class="container">
                    <?php foreach($uniqueActivities as $activity_name): ?>
                    <div class="col">
                    <form>
                    <div class="col mb-3">
                        <label for="activity" class="mt-3 form-label">活動名稱</label>
                        <input type="text" class="col form-control" id="activity" name="activity" value="<?= htmlspecialchars($activity_name) ?>">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="founder" class="form-label">創建者</label>
                            <input type="text" class="col form-control" id="founder" name="founder" value="<?= $r['name'] ?>" disabled>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="activity-time" class="form-label">活動時間</label>
                            <input type="datetime-local" class="col form-control" id="activity-time" name="activity-time" value="<?= $r['activity_time'] ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="introduction" class="form-label">活動詳情</label>
                            <textarea class="col form-control" id="introduction" name="introduction"><?= $r['introduction'] ?></textarea>
                        </div>

                    </div>
                    <div class="col6 mb-3">
                        <div class="row d-flex align-items-end">
                            <div class="col-2 mb-3">
                                <label for="founder" class="form-label">需求人數</label>
                                <input type="text" class="col form-control" id="founder" name="founder" value="<?= $r['need_num'] ?>">
                            </div>
                        <?php endforeach; ?>
                            <span class="col-1 mb-3">/</span>
                            <div class="col-2 mb-3">
                                <label for="founder" class="form-label">已報名人數</label>
                                <input type="text" class="col form-control-plaintext" id="founder" name="founder" value="<?= htmlspecialchars($total_registered) ?>">
    
                            </div>
                        </div>
                    </div>

                    <?php # TODO: 待修改 ?>
                    <?php # foreach($rows as $r): ?>
                    <button type="submit" class="btn btn-primary mb-3">送出修改</button>

                    <a href="del_activity.php?id=<?= ($r['activity_id']) ?>">
                    <button type="button"  class="btn btn-danger mb-3" >取消活動</button>
                    </a>
                    <?php # endforeach; ?>
                    </form>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-user-pen"></i>
                    &nbsp報名人數總覽
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-user-plus"></i>&nbsp新增人員
                </button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>報名者</th>
                                <th>報名人數</th>
                                <th>編輯</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $r): ?>
                            <tr>
                                <td><?= $r['registered_id'] ?></td>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['num'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= ($r['registered_id']) ?>">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="del_member.php?id=<?= ($r['registered_id']) ?>">
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

<!-- Modal_add -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <h5 class="modal-title" id="exampleModalLabel">新增活動人數</h5>
            <form action="" id="insert_members" class="w-75 mx-auto" onsubmit="sendData(event)">
                <div class="mb-3 text-start">
                    <label for="name" class="form-label">報名者</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="請輸入報名者姓名">
                </div>
                <div class="mb-3 text-start">
                    <label for="numbers" class="form-label ">報名人數</label>
                    <input type="text" class="form-control" id="numbers" name="numbers" placeholder="請輸入報名人數">
                </div>
                <div class="mb-3 text-start">
                    <label for="notes" class="form-label ">備註</label>
                    <textarea class="form-control" id="notes" name="notes" placeholder="如: 3男2女"></textarea>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">確定新增</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal_edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <h5 class="modal-title" id="editModalLabel">修改活動人數</h5>
            <form action="" id="insert_members" class="w-75 mx-auto" onsubmit="sendData(event)">
                <div class="mb-3 text-start">
                    <label for="name" class="form-label">報名者</label>
                    <input type="text" class=" form-control-plaintext" id="name" name="name" value="報名者">
                </div>
                <div class="mb-3 text-start">
                    <label for="numbers" class="form-label ">報名人數</label>
                    <input type="text" class="form-control" id="numbers" name="numbers" placeholder="請輸入報名人數">
                </div>
                <div class="mb-3 text-start">
                    <label for="notes" class="form-label ">備註</label>
                    <textarea class="form-control" id="notes" name="notes" placeholder="如: 3男2女"></textarea>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">確定新增</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>


<?php include __DIR__. '/../parts/html-script.php' ?>

<script>
    const myModal = new bootstrap.Modal('#exampleModal');
    const editModal = new bootstrap.Modal('#editModal');


const sendData = e => {
    e.preventDefault(); //不要讓表單以傳統方式送出


    // TODO: 資料欄位檢查
    const fd = new FormData(document.forms[2]);
    console.log(document.forms[2]);
    
    fetch(`add-r-api.php`, {
            method: 'POST',
            body: fd
        }).then(r => r.json())
        .then(obj => {
            console.log(obj);

        }).catch(console.warn);
}
</script>

<?php include __DIR__. '/../parts/html-tail.php' ?>