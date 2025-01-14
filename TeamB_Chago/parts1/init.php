<?php

# if 沒有啟動 就啟動
if(!isset($_SEESION)) {
    session_start();
};

require __DIR__ . '/db-connect.php';