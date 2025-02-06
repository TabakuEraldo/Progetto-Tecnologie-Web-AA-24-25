<?php
require_once 'start.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$pageParams["tot_vendite"] = $db->getNumeroTotaleVendite($_SESSION['user_id']);
$pageParams["tot_guadagni"] = $db->getTotaleGuadagni($_SESSION['user_id']);
$pageParams["nome"] = "../pages/viewStatistiche.php";
require '../pages/base.php';
?>