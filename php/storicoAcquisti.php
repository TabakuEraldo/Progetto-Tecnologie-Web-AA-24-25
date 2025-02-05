<?php
require_once 'start.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$pageParams["storicoAcquisti"] = $db->getStoricoAcquisti($_SESSION['user_id']);
$pageParams["nome"] = "../pages/viewStoricoAcquisti.php";
require '../pages/base.php';
?>
