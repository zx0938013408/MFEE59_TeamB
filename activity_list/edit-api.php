<?php
require __DIR__ . '/../parts/init.php';
header('content-Type: application/json');

$output = [
  'success' => false, # 有沒有新增成功
  'bodyData' => $_POST, # 除錯的用途
  'code' => 0, # 自訂的編號, 除錯的用途
  'error' => '', # 回應給前端的錯誤訊息
];


$sql = "UPDATE `activity_list` SET 
`activity_name`=?,
`sport_name`=?,
`area_name`=?,
`address`=?,
`activity_time`=?,
`deadline`=?,
`payment`=?,
`need_num`=?,
`introduction`=?,
`name`=?
WHERE `id`=? ";

# ****** TODO : 欄位檢查 ******

# *** 處裡日期

if(empty($_POST['activity_time'])){
  $activity_time = null ;
}else{
  $activity_time = strtotime($_POST['activity_time']); # 轉換成 timestamp
  if($activity_time === false){
    // 如果格式是錯的，無法轉換
    $activity_time = null ;
  }else{
    $activity_time = date("Y-m-d", $activity_time);
  }
}

if(empty($_POST['deadline'])){
  $deadline = null ;
}else{
  $deadline = strtotime($_POST['deadline']); # 轉換成 timestamp
  if($deadline === false){
    // 如果格式是錯的，無法轉換
    $deadline = null ;
  }else{
    $deadline = date("Y-m-d", $deadline);
  }
}

$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['activity_name'],
  $_POST['sport_name'],
  $_POST['area_name'],
  $_POST['address'],
  $activity_time,
  $deadline,
  $_POST['payment'],
  $_POST['need_num'],
  $_POST['introduction'],
  $_POST['name'],
  $_POST['id']
]);

$output['success'] = !! $stmt->rowCount(); # 新增了幾筆, 轉布林值
$output['lastInsertId'] = $pdo->lastInsertId(); # 最新拿到的 PK

echo json_encode($output, JSON_UNESCAPED_UNICODE);
