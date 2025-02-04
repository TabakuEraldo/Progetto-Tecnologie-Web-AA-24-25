<?php
require_once 'start.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])){
    $pageParams["readNotifica"] = $db->readNotification($_GET['id']);
}

$pageParams["nome"] = "../pages/viewReadNotification.php";
require "../pages/base.php";
?>