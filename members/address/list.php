<?php
session_start();
if (isset($_SESSION['admin'])) {
  include __DIR__ . '/list_admin.php';
} else {
  include __DIR__ . '/list_no_admin.php';
}