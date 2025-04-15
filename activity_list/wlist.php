<?php
session_start();
if (isset($_SESSION['admin'])) {
  include __DIR__ . '/wlist-admin.php';
} else {
  include __DIR__ . '/wlist-no-admin.php';
}