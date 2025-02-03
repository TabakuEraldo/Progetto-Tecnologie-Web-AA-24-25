<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../DB/database.php';
$db = new DataBase("localhost", "root", "", "ECommerceDB");
$conn = $db->getConnection();

$userId = $_SESSION['user_id'];
// Recupera il carrello dell'utente
$stmt = $conn->prepare("SELECT id FROM Carrelli WHERE id_Utente = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($cartId);
    $stmt->fetch();
    $stmt->close();
    
    // Svuota il carrello: rimuovi tutti i prodotti associati
    $stmt = $conn->prepare("DELETE FROM ProdottiInCarrello WHERE id_Carrello = ?");
    $stmt->bind_param("i", $cartId);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>