<?php
require_once("start.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageParams["nome"] = "intro.php";

require '../pages/base.php';
?>