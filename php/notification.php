<?php
require_once 'start.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$pageParams["notifiche"] = $db->getNotification($_SESSION['user_id'], $_SESSION['user_role']);
$pageParams["nome"] = "../pages/viewNotification.php";
require "../pages/base.php";
?>