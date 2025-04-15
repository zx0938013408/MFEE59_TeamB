<?php
# 檢查是否為管理者
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';
$title = "活動報名情形";
$pageName = "registered";

// 從資料庫中選取資料
// 會員資料
$sql_member = "SELECT id, `name` FROM members";
$result_member = $pdo->query($sql_member);

$stmt_member = $pdo->query($sql_member);
$members = $stmt_member->fetch();


// 獲取活動 ID
$activity_id = $_GET['id'] ?? null;

$activity_id = empty($_GET['id']) ? 0 : intval($_GET['id']);

# 套入資料
$sql = sprintf("
SELECT registered.id as registered_id, members.name, activity_id, activity_name, num, notes, need_num, activity_time, activity_list.introduction as introduction, member_id
FROM `registered`
JOIN members on registered.member_id = members.id
JOIN activity_list on registered.activity_id = activity_list.id
WHERE activity_list.id= %d
", $activity_id);

$stmt = $pdo->prepare($sql);
// $stmt->execute([$activity_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// 計算報名人數總和
$sql_sum = sprintf("
SELECT SUM(num) AS total_registered FROM `registered` where activity_id = %d
", $activity_id);

$stmt_sum = $pdo->prepare($sql_sum);
$stmt_sum->execute();

// 獲取結果
$row_sum = $stmt_sum->fetch(PDO::FETCH_ASSOC);

// 取得總和並賦值給變數
$total_registered = $row_sum['total_registered'];


# 篩選 activity_name
$uniqueActivities = [];
foreach ($rows as $r) {
    if (!in_array($r['activity_name'], $uniqueActivities)) {
        $uniqueActivities[] = $r['activity_name'];
    }
};

# 篩選創建者
$founder_sql = sprintf("
SELECT members.name as name FROM `activity_list`
JOIN members on activity_list.founder_id = members.id
JOIN sport_type on activity_list.sport_type_id = sport_type.id
WHERE activity_list.id= %d
", $activity_id);

$founder_stmt = $pdo->prepare($founder_sql);
// $stmt->execute([$activity_id]);
$founder_rows = $founder_stmt->fetchAll(PDO::FETCH_ASSOC);

$founder_rows = $pdo->query($founder_sql)->fetchAll(PDO::FETCH_ASSOC);

# 篩選 founder_name
$founder_name=[];
foreach ($founder_rows as $fr) {
    if (!in_array($fr['name'], $founder_name)) {
        $founder_name[] = $fr['name'];
        $founder_name = join(" ", $founder_name);
    }
};





# 修改會員

# 取得指定的 PK
$member_id = empty($_GET['member_id']) ? 0 : intval($_GET['member_id']);

if ($member_id) {
    $member_sql = sprintf("SELECT * FROM `registered` WHERE member_id ={$member_id} ");
    $pdo->query($sql);

    $member_stmt = $pdo->prepare($member_sql);
    $member_stmt->execute();
}

?>

<!-- HTML開始 -->
<?php include __DIR__. '/../parts/html-head.php' ?>
<?php include __DIR__. '/../parts/html-navbar.php' ?>

<?php foreach ($uniqueActivities as $activity_name): ?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">管理「<?= htmlspecialchars($activity_name) ?>」活動報名成員</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index_.php" class="text-decoration-none text-secondary">首頁</a></li>
                <li class="breadcrumb-item"><a href="r_tables.php" class="text-decoration-none text-secondary">活動成員管理</a></li>
                <li class="breadcrumb-item active fw-bold">管理「<?= htmlspecialchars($activity_name) ?>」活動報名成員</li>

            </ol>
            <div class="card mb-4">
                <div class="container">
                        <div class="col">
                            <form>
                                <div class="row mt-3">
                                    <div class="col mb-3">
                                        <label for="activity-time" class="form-label">報名人數 / 需求人數</label>
                                        <!-- 自動套入時間 -->
                                        <input type="text" class="col form-control" id="registered_number" name="registered_number" value="<?= htmlspecialchars($total_registered) ?> / <?= $r['need_num'] ?>" readonly>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="founder" class="form-label">揪團召集人</label>
                                        <input type="text" class="col form-control" id="founder" name="founder" value="<?= htmlspecialchars($founder_name) ?>"  readonly>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="activity-time" class="form-label">活動時間</label>
                                        <!-- 自動套入時間 -->
                                        <input type="datetime-local" class="col form-control" id="activity-time" name="activity-time" value="<?= $r['activity_time'] ?>" readonly>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </form>
                        </div>
                </div>
            </div>

            <!-- 報名人數詳情 -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-user-pen"></i>
                        &nbsp報名成員資訊
                    </div>
                    <!-- 設定新增人員按鈕(以Modal 形式出現) -->
                    <div>
                        <button type="button" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            <i class="fa-solid fa-user-plus"></i>&nbsp新增人員
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>報名者</th>
                                <th>報名人數</th>
                                <th>備註欄位</th>
                                <th>編輯</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>報名者</th>
                                <th>報名人數</th>
                                <th>備註欄位</th>
                                <th>編輯</th>
                                <th>刪除</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($rows as $r): ?>
                                <tr>
                                    <td><?= $r['registered_id'] ?></td>
                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['num'] ?></td>
                                    <td><?= $r['notes'] ?></td>

                                    <!-- 編輯按鈕 -->>
                                    <td>
                                        <button type="button" class="btn text-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-membername="<?= $r['name'] ?>"
                                            data-num="<?= $r['num'] ?>"
                                            data-notes="<?= htmlspecialchars($r['notes']) ?>"
                                            data-registeredid="<?= $r['registered_id'] ?>"
                                            data-memberid="<?= $r['member_id'] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>

                                    <!-- 刪除按鈕 -->
                                    <td>
                                        <a href="r_del_member.php?id=<?= ($r['registered_id']) ?>">
                                            <button type="button" class="btn text-primary" data-id="1"><i class="fa-solid fa-trash-can"></i></button>
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





<?php include __DIR__. '/../parts/html-footer.php' ?>

<!-- Modal_add (新增人員在該報名清單, 只限會員成員) -->
<!-- Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">新增報名人數</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_Form">
                    <div class="form-group">
                        <label for="add_memberName">會員名稱</label>
                        <input type="text" class="form-control" id="add_memberName" name="add_memberName">
                    </div>
                    <div class="form-group">
                        <label for="add_activityName">活動名稱</label>
                        <input type="text" class="form-control" id="add_activityName" name="add_activityName" value="<?= htmlspecialchars($activity_name) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="add_num">人數</label>
                        <input type="number" class="form-control" id="add_num" name="add_num">
                    </div>
                    <div class="form-group">
                        <label for="add_notes">備註</label>
                        <textarea class="form-control" id="add_notes" name="add_notes"></textarea>
                    </div>
                    <input type="hidden" class="form-control" id="add_memberId" name="add_memberId">
                    <input type="hidden" id="add_activityId" name="add_activityId" value="<?= htmlspecialchars($activity_id) ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                <!-- 提交按鈕 -->
                <button type="submit" class="btn btn-primary" id="saveaddChanges">新增</button>
            </div>
        </div>
    </div>
</div><!-- end Modal_add (新增人員在該報名清單, 只限會員成員) -->

<!-- Modal_edit (修改活動報名人員內容) -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">編輯報名資料</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="edit_memberName">會員名稱</label>
                        <input type="text" class="form-control" id="edit_memberName" name="edit_memberName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_activityName">活動名稱</label>
                        <input type="text" class="form-control" id="edit_activityName" name="edit_activityName" value="<?= htmlspecialchars($activity_name) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_num">人數</label>
                        <input type="number" class="form-control" id="edit_num" name="edit_num">
                    </div>
                    <div class="form-group">
                        <label for="edit_notes">備註</label>
                        <textarea class="form-control" id="edit_notes" name="edit_notes"></textarea>
                    </div>
                    <input type="hidden" id="edit_registeredId" name="edit_registeredId">
                    <input type="hidden" id="edit_memberId" name="edit_memberId">
                    <input type="hidden" id="edit_activityId" name="edit_activityId" value="<?= htmlspecialchars($activity_id) ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消修改</button>
                <button type="submit" class="btn btn-primary" id="saveChanges">儲存變更</button>
            </div>
        </div>
    </div>
</div><!-- end Modal_edit (修改活動報名人員內容) -->


<?php include __DIR__. '/../parts/html-scripts.php' ?>


<!-- Modale script 語法 -->
<script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'
        
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        
          // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
            
                form.classList.add('was-validated')
            }, false)
            })
        })()
</script> <!-- end Modal script 語法 -->


<!-- 自動查找會員 ID + 新增報名人員 -->
<script>
    // 當輸入姓名時自動查詢會員 ID 
    //  用在新增人員的Modal 表單
    document.getElementById("add_memberName").addEventListener("input", function() {
        var memberName = this.value.trim();

        if (memberName.length > 0) {
            // 發送請求到後端 API 查詢會員 ID
            fetch('r_get_addMember_id.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: memberName
                    }) // 發送姓名
                })
                .then(response => response.json()) // 假設後端回傳 JSON 格式
                .then(data => {
                    if (data.success) {
                        // 查詢成功，顯示會員 ID
                        document.getElementById("add_memberId").value = data.member_id;
                    } else {
                        // 查無此會員，清空會員 ID 輸入框
                        document.getElementById("add_memberId").value = '';
                        alert("找不到該會員");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            // 如果姓名框為空，清空會員 ID 輸入框
            document.getElementById("add_memberId").value = '';
        }
    }); // End 自動找會員ID (用於新增報名人員)
    // end 自動查詢會員 ID



    // 新增資料到 registered 資料庫
    const myModal = new bootstrap.Modal('#addMemberModal'); // 初始化 Modal
    const sendData = (e) => {
        e.preventDefault(); // 防止表單以傳統方式提交

        // 禁用提交按鈕，防止重複提交
        const submitButton = document.getElementById('saveaddChanges');
        submitButton.disabled = true; // 禁用提交按鈕

        // 確保必要的欄位資料已填寫
        const memberName = document.getElementById('add_memberName').value.trim();
        const activityId = document.getElementById('add_activityId').value.trim();
        const num = document.getElementById('add_num').value.trim();
        const notes = document.getElementById('add_notes').value.trim();

        // 確認資料是否填寫完全
        if (!memberName || !activityId || !num) {
            alert("請確保所有必要欄位都已填寫！");
            submitButton.disabled = false; // 啟用提交按鈕
            return; // 若有欄位未填寫，停止提交
        }

        // 使用 FormData 將表單資料到api
        const fd = new FormData(document.getElementById('add_Form'));

        fetch('r_add-registered-api.php', { // 檔名改為 r_add-registered-api.php
                method: 'POST', // 使用 POST 方法
                body: fd // 送出表單資料
            })
            .then(response => response.json()) // 解析 JSON 格式的回應
            .then(obj => {
                console.log(obj); // 顯示回應內容

                // 根據回應結果進行相應的處理
                if (obj.success) {
                    alert("資料已成功新增！");
                    myModal.hide(); // 關閉 Modal
                    location.reload(); //重新整理頁面, 建議再修改
                } else {
                    alert("資料新增失敗: " + obj.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("發生錯誤，請稍後再試。");
            })
            .finally(() => {
                // 在請求結束後重新啟用提交按鈕
                submitButton.disabled = false;
            });
    }
    // end 新增資料到 registered

    // 綁定表單提交事件
    document.getElementById('add_Form').addEventListener('submit', sendData); // 使用表單的 ID

    // 確保按鈕正確觸發提交
    document.getElementById('saveaddChanges').addEventListener('click', function() {
        document.getElementById('add_Form').requestSubmit(); // 手動觸發表單提交
    });
</script><!-- end 自動查找會員 ID + 新增報名人員 -->



<!-- edit Modal (修改各別報名人數) -->
<script>
    // 當 Modal 被觸發時，填充表單資料
    document.getElementById('editModal').addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // 觸發 Modal 的按鈕

        // 從按鈕的 data-* 屬性中提取資料
        const editMemberName = button.getAttribute('data-membername');
        const editNum = button.getAttribute('data-num');
        const editNotes = button.getAttribute('data-notes');
        const editRegisteredId = button.getAttribute('data-registeredid');
        const editMemberId = button.getAttribute('data-memberid');
        // const editActivityId = button.getAttribute('data-activityid'); 

        // 檢查並填充 Modal 中的欄位
        const memberNameInput = document.getElementById('edit_memberName');
        if (memberNameInput) {
            memberNameInput.value = editMemberName;
        } else {
            console.error('edit_memberName element not found!');
        }

        const numInput = document.getElementById('edit_num');
        if (numInput) {
            numInput.value = editNum;
        } else {
            console.error('edit_num element not found!');
        }

        const notesInput = document.getElementById('edit_notes');
        if (notesInput) {
            notesInput.value = editNotes;
        } else {
            console.error('edit_notes element not found!');
        }

        const registeredIdInput = document.getElementById('edit_registeredId');
        if (registeredIdInput) {
            registeredIdInput.value = editRegisteredId;
        } else {
            console.error('edit_registeredId element not found!');
        }

        const memberIdInput = document.getElementById('edit_memberId');
        if (memberIdInput) {
            memberIdInput.value = editMemberId;
        } else {
            console.error('edit_memberId element not found!');
        }

        // const activityIdInput = document.getElementById('edit_activityId');
        // if (activityIdInput) {
        //     activityIdInput.value = editActivityId;
        // } else {
        //     console.error('edit_activityId element not found!');
        // }
    });


    // 當輸入姓名時自動查詢會員 ID 
    // 用在編輯人員的Modal 表單
    document.getElementById("edit_memberName").addEventListener("input", function() {
        var editMemberName = this.value.trim(); // 變更變數名稱為 editMemberName

        if (editMemberName.length > 0) {
            // 發送請求到後端 API 查詢會員 ID
            fetch('r_get_editMember_id.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: editMemberName // 發送姓名
                    })
                })
                .then(response => response.json()) // 假設後端回傳 JSON 格式
                .then(data => {
                    if (data.success) {
                        // 查詢成功，顯示會員 ID
                        document.getElementById("edit_memberId").value = data.member_id; // 修改為 edit_memberId
                    } else {
                        // 查無此會員，清空會員 ID 輸入框
                        document.getElementById("edit_memberId").value = '';
                        alert("找不到該會員");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            // 如果姓名框為空，清空會員 ID 輸入框
            document.getElementById("edit_memberId").value = ''; // 修改為 edit_memberId
        }
    });



    // 儲存變更按鈕的處理邏輯
    document.getElementById('saveChanges').addEventListener('click', function() {
        const registeredId = document.getElementById('edit_registeredId').value;
        const memberId = document.getElementById('edit_memberId').value;
        const activityId = document.getElementById('edit_activityId').value;
        const num = document.getElementById('edit_num').value;
        const notes = document.getElementById('edit_notes').value;

        // 確保人數和備註有值
        if (!num || !notes) {
            alert('請填寫人數和備註');
            return;
        }

        // 用戶資料準備提交
        const formData = new FormData();
        formData.append('registered_id', registeredId);
        formData.append('member_id', memberId);
        formData.append('activity_id', activityId);
        formData.append('num', num);
        formData.append('notes', notes);

        // 使用 Fetch API 送出資料
        fetch('r_edit-registered-api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('資料已成功更新');
                    // 關閉 Modal 
                    const editModal = document.getElementById('#editModal');
                    const editModalOff = new bootstrap.Modal('#editModal'); // 初始化 Modal
                    editModalOff.hide(); // 關閉 Modal
                    location.reload(); //重新整理頁面, 建議再修改
                } else {
                    alert('資料更新失敗: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('發生錯誤，請稍後再試');
            });
    });
    
</script><!-- end edit Modal (修改各別報名人數) -->


<?php include __DIR__. '/../parts/html-tail.php' ?>
