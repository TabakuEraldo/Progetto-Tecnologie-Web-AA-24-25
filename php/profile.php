<?php
require_once 'start.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

//???????
$userName = $_SESSION['user_name'] ?? 'Utente';
$userEmail = $_SESSION['email'] ?? 'Email non disponibile';
$userRole = $_SESSION['user_role'] ?? null;

$pageParams["nome"] = "../pages/viewProfile.php";
require '../pages/base.php';
?>
