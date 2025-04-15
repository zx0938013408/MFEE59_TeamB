<?php
//require __DIR__ ."/../parts/admin-required.php";
session_start();
if (isset($_SESSION['admin'])) {
  include __DIR__ . '/a-list-admin.php';
} else {
  include __DIR__ . '/login.php';
}
