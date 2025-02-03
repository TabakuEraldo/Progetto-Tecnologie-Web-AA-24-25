<?php
require_once 'start.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$pageParams["nome"] = "../pages/viewProfile.php";
require '../pages/base.php';
?>
