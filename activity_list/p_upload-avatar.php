<?php

$fieldName = 'image';

$output = [
  'success' => false,
  'file' => '', # 上傳之後的檔名
];

$dir = __DIR__ . '/../p_uploads/'; # 存放圖檔的資料夾

# 篩選檔案類型, 決定副檔名
$exts = [
  'image/jpeg' => '.jpg',
  'image/png' => '.png',
  'image/webp' => '.webp',
];

if (
  !empty($_FILES)
  and
  !empty($_FILES[$fieldName])
  and
  $_FILES[$fieldName]['error'] == 0
) {
  if (! empty($exts[$_FILES[$fieldName]['type']])) {
    # 有進到這邊, 檔案類型是我要的
    $ext = $exts[$_FILES[$fieldName]['type']]; # 副檔名
    $f = md5($_FILES[$fieldName]['name'] . uniqid()); # 隨機的主檔名
    if (move_uploaded_file(
      $_FILES[$fieldName]['tmp_name'], # 已上傳暫時的檔名
      $dir . $f . $ext
    )) {
      $output['success'] = true;
      $output['file'] = $f . $ext;
    }
  }
}

header('content-Type: application/json');
echo json_encode($output);
