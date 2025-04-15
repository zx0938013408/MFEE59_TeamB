<?php
session_start();
if (isset($_SESSION['admin'])) {
  include __DIR__ . '/p_list-admin.php';
} else {
  include __DIR__ . '/p_list-no-admin.php';
}
