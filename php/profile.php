<?php
require_once 'start.php';

// Controlla se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

//potremmo cambiare e usare sempre la l array pageParams dove mettiamo dentro tutti i dati
$userName = $_SESSION['user_name'] ?? 'Utente';
$userEmail = $_SESSION['email'] ?? 'Email non disponibile';
$userRole = $_SESSION['user_role'] ?? null;

$pageParams["nome"] = "../pages/viewProfile.php";
require '../pages/base.php';
?>
