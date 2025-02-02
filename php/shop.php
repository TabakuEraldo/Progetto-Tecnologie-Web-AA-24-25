<?php
require_once '../DB/database.php'; // Assicurati che il percorso sia corretto

// Connessione al database
$servername = "localhost"; // Cambia se necessario
$username = "root"; // Cambia se necessario
$password = ""; // Cambia se necessario
$dbname = "ECommerceDB"; // Assicurati che sia il nome corretto del database

$db = new DataBase($servername, $username, $password, $dbname);

// Recupera 9 prodotti random
$pageParams["nome"] = "../pages/viewProducts.php";
$pageParams["randProducts"] = $db->getRandomProduct(9);


require '../pages/base.php';
?>
