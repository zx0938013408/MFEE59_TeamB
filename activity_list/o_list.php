<?php
session_start();
if (isset($_SESSION['admin'])) {
  include __DIR__ . '/o_list-admin.php';
} else {
  include __DIR__ . '/o_list-no-admin.php';
}
