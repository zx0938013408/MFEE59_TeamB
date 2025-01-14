<?php

require __DIR__ .'/config.php';

$dsn = sprintf("mysql:host=%s;dbname=%s;port=%s;chartset=utf8mb4",
    DB_HOST,
    DB_NAME,
    DB_PORT
);

$pdo_options = [
    # 出錯時的報告
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    # 預設輸出格式
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];


#建立連線物件
$pdo = new PDO($dsn, DB_USER, DB_PASS);