<?php

require __DIR__ . '/../parts/init.php';
header('content-Type: application/json');

$output =[
    'success' => false,#有無新增成功
    'bodyData' => $_POST,#除錯用途
    'code' => 0,#自訂編號，除錯
    'error' => '',#回應給前端的錯誤訊息
    'lastInsertId' => 0,#最新拿到PK
];

$sql = "INSERT INTO `members`(`name`, `gender`, `favorite_sport`, `birthday_date`, `address`, `phone`, `email`, `password`, `created_at`, `updated_at`,`photo_url`) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(),?)";

$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
if(! $email){
    $output['code'] =401;
    $output['error'] ='請填寫正確email';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
# *** 處理日期
if (empty($_POST['birthday_date'])) {
    $birthday = null;
  } else {
    $birthday_date = strtotime($_POST['birthday_date']); # 轉換成 timestamp
    if ($birthday_date === false) {
      // 如果格式是錯的, 無法轉換
      $birthday_date = null;
    } else {
      $birthday_date = date("Y-m-d", $birthday_date);
    }
  }

$gender = empty($_POST['gender']) ?null : $_POST['gender'];
if (!in_array($gender, ['男', '女', '其他'])) {
    $output['error'] = '無效的性別選項';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$favorite_sport = empty($_POST['favorite_sport']) ? null : $_POST['favorite_sport'];

if (!in_array($favorite_sport, ['籃球', '羽球', '排球'])) {
    $output['error'] = '無效的球類選項';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
// 處理檔案上傳
$photo_url = null;
if (isset($_FILES['photo_url']) && $_FILES['photo_url']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../uploads/'; // 上傳資料夾
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // 建立資料夾
    }

    $fileName = basename($_FILES['photo_url']['name']);
    $targetFilePath = $uploadDir . time() . '_' . $fileName; // 確保唯一性
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['photo_url']['tmp_name'], $targetFilePath)) {
            $photo_url = 'uploads/' . time() . '_' . $fileName; // 存入相對路徑
        } else {
            $output['error'] = '圖片上傳失敗';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    } else {
        $output['error'] = '不支援的檔案格式';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$stmt = $pdo->prepare($sql);#取得已編譯語法
$stmt->execute([
    $_POST['name'],
    $gender,
    $favorite_sport,
    $birthday_date,
    $_POST['address'],
    $_POST['phone'],
    $_POST['email'],
    $_POST['password'],
    $photo_url
]);


$output['success'] = !! $stmt ->rowCount();
$output['lastInsertId'] = $pdo ->lastInsertId();
$output['rowCount'] = $stmt->rowCount();



echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>