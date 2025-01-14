<?php
require __DIR__ . '/parts1/init.php';
$title = "新增活動";
$pageName = "activity-add";


// 從資料庫中選取資料
// 運動類型
$sql_sport = "SELECT id, sport_name FROM sport_type";
$result = $pdo->query($sql_sport);

// 行政區域
$sql_area = "SELECT area_id, name FROM areas WHERE city_id = 14";
$result_area = $pdo->query($sql_area);




?>
<!-- HTML開始 -->
<?php include __DIR__ . '/parts1/html-header.php' ?>
<?php include __DIR__ . '/parts1/html-navbar.php' ?>

<div class="container">
    <h1>Add</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增活動</h5>
                    <form onsubmit="sendData(event)">

                        <div class="mb-3">
                            <label for="activity_name" class="form-label">活動名稱</label>
                            <input type="text" class="form-control" id="activity_name" name="activity_name">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="photo_url" class="form-label">請上傳活動照片</label>
                            <input class="form-control" type="file" id="photo_url" name="photo_url">
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
                        <!-- <div class="mb-3">
                            <label for="area_id" class="form-label">活動行政區域</label>
                            <input type="int" class="form-control" id="area_id" name="area_id">
                            <div class="form-text"></div>
                        </div> -->
                        <div class="mb-3">
                            <label for="court_id" class="form-label">球場位置</label>
                            <input type="int" class="form-control" id="court_id" name="court_id">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="activity_time" class="form-label">活動時間</label>
                            <input type="datetime-local" class="form-control" id="activity_time" name="activity_time">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">報名截止日</label>
                            <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="payment" class="form-label">費用</label>
                            <input type="int" class="form-control" id="payment" name="payment">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="need_num" class="form-label">需求人數</label>
                            <input type="int" class="form-control" id="need_num" name="need_num">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="introduction" class="form-label">活動詳情</label>
                            <textarea class="form-control" id="introduction" name="introduction"></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="founder_name" class="form-label">創建人</label>
                            <input type="text" class="form-control" id="founder_name" name="founder_name">
                            <div class="form-text"></div>
                        </div>



                        <button type="submit" class="btn btn-primary">送出</button>
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
                <h5 class="modal-title" id="exampleModalLabel">新增結果</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    活動新增成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <a href="list.php" class="btn btn-primary">回到列表頁</ㄇ>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/html-script.php' ?>
<script>
    const myModal = new bootstrap.Modal('#exampleModal');


    const sendData = e => {
        e.preventDefault(); //不要讓表單以傳統方式送出


        // TODO: 資料欄位檢查
        const fd = new FormData(document.forms[0]);

        fetch(`add-api.php`, {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);

            }).catch(console.warn);
    }
</script>
<?php include __DIR__ . '/parts/html-tail.php' ?>