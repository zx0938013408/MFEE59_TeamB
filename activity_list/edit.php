<?php
# 管理者才能看到的頁面
require __DIR__ . '/../parts/admin-required.php';

require __DIR__ . '/../parts/init.php';

# 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

if (empty($id)) {
  header('Location: list.php');
  exit;
}

// 從資料庫中選取資料
# 讀取該筆資料
$sql_list = "SELECT * FROM activity_list WHERE id=$id";

// 運動類型
$sql_sport = "SELECT id, sport_name FROM sport_type";
$result = $pdo->query($sql_sport);

// 行政區域
$sql_area = "SELECT area_id, areas.name FROM areas WHERE city_id = 14";
$result_area = $pdo->query($sql_area);

// 根據 activity_list 表的 court_id 連接到 court_info 表獲取地址
$sql_address = "SELECT court.address 
                FROM court_info AS court
                JOIN activity_list AS activity ON court.id = activity.court_id
                WHERE activity.id = :id";
$stmt_address = $pdo->prepare($sql_address);
$stmt_address->execute(['id' => $id]);
$address = $stmt_address->fetchColumn(); // 獲取地址

// 根據 activity_list 表的 founder_id 連接到 members 表獲取開團者名稱
$sql_founder = "SELECT members.name 
                FROM members 
                JOIN activity_list ON members.id = activity_list.founder_id
                WHERE activity_list.id = :id";
$stmt_founder = $pdo->prepare($sql_founder);
$stmt_founder->execute(['id' => $id]);
$founder_name = $stmt_founder->fetchColumn(); // 獲取名稱

$r = $pdo->query($sql_list)->fetch();
if (empty($r)) {
  # 如果沒有對應的資料, 就跳走
  header('Location: list.php');
  exit;
}

?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts//html-navbar.php' ?>
<style>
  form .mb-3 .form-text {
    display: none;
    /* color: red; */
  }

  form .mb-3.error input.form-control {
    border: 2px solid red;
  }

  form .mb-3.error .form-text {
    display: block;
    color: red;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-6">
      <div class="card">

        <div class="card-body">
          <h5 class="card-title">修改活動內容</h5>
          <form onsubmit="sendData(event)">
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <div class="mb-3">
              <label for="name" class="form-label">編號</label>
              <input type="text" class="form-control" disabled
                value="<?= $r['id'] ?>">
            </div>
            <div class="mb-3">
              <label for="activity_name" class="form-label">活動名稱</label>
              <input type="text" class="form-control" id="activity_name" name="activity_name"
                value="<?= $r['activity_name'] ?>">
              <div class="form-text"></div>
            </div>
                        <!-- 下拉式選單: 拉運動類型 -->
                        <div class="mb-3">
                            <label for="sport_type_id" class="form-label">運動類型</label>
                            <select name="sport_type_id" id="sport_type_id" class="form-select" aria-label="Default select example">
                                <option selected value="">--請選擇--</option>
                                <?php
                                try {
                                    // 檢查查詢是否返回結果
                                    if ($result->rowCount() > 0) {
                                        // 輸出每一行資料
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['sport_name']) . '</option>';
                                        }
                                    } else {
                                        // 若無資料，顯示無可用選項
                                        echo '<option value="">無可用選項</option>';
                                    }
                                ?>
                            </select>
                            <!-- Close the div for form group -->
                        <?php
                                } catch (PDOException $e) {
                                    // 捕捉 PDO 異常並顯示錯誤訊息
                                    echo "資料庫連接錯誤: " . $e->getMessage();
                                    exit();
                                }
                        ?>
                        </div>
                        <!-- 下拉式選單: 拉行政區域 -->
                        <div class="mb-3">
                            <label for="area_id" class="form-label">行政區域</label>
                            <select name="area_id" id="area_id" class="form-select" aria-label="Default select example">
                                <option selected value="">--請選擇--</option>
                                <?php
                                try {
                                    // 檢查查詢是否返回結果
                                    if ($result_area->rowCount() > 0) {
                                        // 輸出每一行資料
                                        while ($row_area = $result_area->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $row_area['area_id'] . '">' . htmlspecialchars($row_area['name']) . '</option>';
                                        }
                                    } else {
                                        // 若無資料，顯示無可用選項
                                        echo '<option value="">無可用選項</option>';
                                    }
                                ?>
                            </select>
                            <!-- Close the div for form group -->
                        <?php
                                } catch (PDOException $e) {
                                    // 捕捉 PDO 異常並顯示錯誤訊息
                                    echo "資料庫連接錯誤: " . $e->getMessage();
                                    exit();
                                }
                        ?>
                        </div>
            <div class="mb-3">
              <label for="address" class="form-label">地點名稱</label>
              <input type="text" class="form-control" id="address" name="address"
              value="<?php echo htmlspecialchars($address); ?>">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="activity_time" class="form-label">活動時間</label>
              <input type="datetime-local" class="form-control" id="activity_time" name="activity_time"
                value="<?= $r['activity_time'] ?>">
            </div>
            <div class="mb-3">
              <label for="deadline" class="form-label">報名期限</label>
              <input type="datetime-local" class="form-control" id="deadline" name="deadline"
                value="<?= $r['deadline'] ?>">
            </div>
            <div class="mb-3">
              <label for="payment" class="form-label">費用</label>
              <input type="text" class="form-control" id="payment" name="payment"
                value="<?= $r['payment'] ?>">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="need_num" class="form-label">需求人數</label>
              <input type="text" class="form-control" id="need_num" name="need_num"
                value="<?= $r['need_num'] ?>">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="introduction" class="form-label">活動簡介</label>
              <textarea class="form-control"
                id="introduction" name="introduction"><?= $r['introduction'] ?></textarea>
            </div>
            <div class="mb-3">
              <label for="founder_id" class="form-label">開團者</label>
              <input type="text" class="form-control" id="founder_id" name="founder_id"
                value="<?php echo htmlspecialchars($founder_name); ?>">
              <div class="form-text"></div>
            </div>
            <button type="submit" class="btn btn-primary">修改</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          資料編輯成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a class="btn btn-primary" href="list.php">回到列表頁</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
  const nameField = document.querySelector('#activity_name');
  const myModal = new bootstrap.Modal('#exampleModal');


  const sendData = e => {
    e.preventDefault(); // 不要讓表單以傳統的方式送出

    nameField.closest('.mb-3').classList.remove('error');
    let isPass = true; // 有沒有通過檢查, 預設值是 true
    // TODO: 資料欄位的檢查

    if (nameField.value.length < 1) {
      isPass = false;
      nameField.nextElementSibling.innerHTML = "請填寫正確的答案";
      nameField.closest('.mb-3').classList.add('error');
    }

    if (isPass) {
      const fd = new FormData(document.forms[0]);

      fetch(`edit-api.php`, {
          method: 'POST',
          body: fd
        }).then(r => r.json())
        .then(obj => {
          console.log(obj);
          if (!obj.success && obj.error) {
            alert(obj.error)
          }
          if (obj.success) {
            myModal.show(); // 呈現 modal
          }else{
            alert('資料沒有修改')
          }

        }).catch(console.warn);
    }


  }
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>