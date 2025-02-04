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
    $pageParams["modificaProd"] = $db->getProdotto($_GET['id']);
}

$pageParams["nome"] = "../pages/viewModifyProduct.php";
require "../pages/base.php";
?>