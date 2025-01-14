<?php

// 載入配置檔
require __DIR__ . '/parts1/init.php';

try {
    // 設置 DSN (Data Source Name) 字串，指定 MySQL 主機、資料庫名稱及連接埠
    $dsn = sprintf(
        "mysql:host=%s;dbname=%s;port=%s;charset=utf8mb4",
        DB_HOST,
        DB_NAME,
        DB_PORT
    );

    // 配置 PDO 選項
    $pdo_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 開啟錯誤報告，拋出異常
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // 預設抓取模式為關聯陣列
    ];

    // 建立 PDO 物件並連接資料庫
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $pdo_options);

    // 從 sport_type 資料表中選取資料
    $sql_sport = "SELECT id, sport_name FROM sport_type";
    $result = $pdo->query($sql_sport);

    // 開始生成 HTML 表單
    echo '<form action="your_form_handler.php" method="post">';
    echo '<div class="mb-3">';
    echo '<label for="sport" class="form-label">選擇運動類型</label>';
    echo '<select name="sport" id="sport" class="form-select" aria-label="Default select example">';
    echo '<option selected value="">--請選擇--</option>';

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

    echo '</select>';
    echo '</div>'; // Close the div for form group
    echo '<button type="submit" class="btn btn-primary">提交</button>';
    echo '</form>';

} catch (PDOException $e) {
    // 捕捉 PDO 異常並顯示錯誤訊息
    echo "資料庫連接錯誤: " . $e->getMessage();
    exit();
}

?>