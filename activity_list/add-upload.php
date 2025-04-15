<?php
# 僅允許管理者存取此頁面
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';
$title = "新增活動";
$pageName = "add";

// 從資料庫中選取資料

// 運動類型
$sql_sport = "SELECT id, sport_name FROM sport_type";
$result_sport = $pdo->query($sql_sport);

// 行政區域
$sql_area = "SELECT area_id, name FROM areas WHERE city_id = 14";
$result_area = $pdo->query($sql_area);

// 場地 (court_info)
$sql_court = "SELECT id, name FROM court_info";
$result_court = $pdo->query($sql_court);

// 成員 (members)
$sql_member = "SELECT id, name FROM members";
$result_member = $pdo->query($sql_member);

?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>

<style>
  form .mb-3 .form-text {
    display: none;
  }

  form .mb-3.error input.form-control,
  form .mb-3.error select.form-select {
    border: 2px solid red;
  }

  form .mb-3.error .form-text {
    display: block;
    color: red;
  }
</style>

<main>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">新增活動</h5>
          <form onsubmit="sendData(event)">
            <div class="mb-3">
              <label for="activity_name" class="form-label">活動名稱</label>
              <input type="text" class="form-control" id="activity_name" name="activity_name" required>
              <div class="form-text">請輸入活動名稱</div>
            </div>

            <!-- 運動類型 -->
            <div class="mb-3">
              <label for="sport_type_id" class="form-label">運動類型</label>
              <select name="sport_type_id" id="sport_type_id" class="form-select" required>
                <option value="">--請選擇--</option>
                <?php
                while ($row = $result_sport->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['sport_name']) . '</option>';
                }
                ?>
              </select>
              <div class="form-text">請選擇運動類型</div>
            </div>

            <!-- 行政區域 -->
            <div class="mb-3">
              <label for="area_id" class="form-label">行政區域</label>
              <select name="area_id" id="area_id" class="form-select" required>
                <option value="">--請選擇--</option>
                <?php
                while ($row_area = $result_area->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . $row_area['area_id'] . '">' . htmlspecialchars($row_area['name']) . '</option>';
                }
                ?>
              </select>
              <div class="form-text">請選擇行政區域</div>
            </div>

            <!-- 場地 -->
            <div class="mb-3">
              <label for="court_id" class="form-label">場地</label>
              <select name="court_id" id="court_id" class="form-select" required>
                <option value="">--請選擇--</option>
                <?php
                while ($row_court = $result_court->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . $row_court['id'] . '">' . htmlspecialchars($row_court['name']) . '</option>';
                }
                ?>
              </select>
              <div class="form-text">請選擇場地</div>
            </div>

            <!-- 創建者 -->
            <div class="mb-3">
              <label for="founder_id" class="form-label">創建者</label>
              <select name="founder_id" id="founder_id" class="form-select" required>
                <option value="">--請選擇--</option>
                <?php
                while ($row_member = $result_member->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . $row_member['id'] . '">' . htmlspecialchars($row_member['name']) . '</option>';
                }
                ?>
              </select>
              <div class="form-text">請選擇創建者</div>
            </div>

            <div class="mb-3">
              <label for="activity_time" class="form-label">活動時間</label>
              <input type="datetime-local" class="form-control" id="activity_time" name="activity_time" required>
            </div>

            <div class="mb-3">
              <label for="deadline" class="form-label">報名期限</label>
              <input type="datetime-local" class="form-control" id="deadline" name="deadline" required>
            </div>

            <div class="mb-3">
              <label for="payment" class="form-label">費用</label>
              <input type="number" class="form-control" id="payment" name="payment" step="0.01" required>
              <div class="form-text">請輸入費用</div>
            </div>

            <div class="mb-3">
              <label for="need_num" class="form-label">需求人數</label>
              <input type="number" class="form-control" id="need_num" name="need_num" required>
            </div>

            <div class="mb-3">
              <label for="introduction" class="form-label">活動簡介</label>
              <textarea class="form-control" id="introduction" name="introduction" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">新增</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
  const sendData = (e) => {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('add-upload-api.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        if (result.success) {
          alert('新增成功');
          window.location.href = 'list.php';
        } else {
          alert(result.error || '新增失敗');
        }
      })
      .catch((error) => {
        console.error('錯誤:', error);
      });
  };
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>
