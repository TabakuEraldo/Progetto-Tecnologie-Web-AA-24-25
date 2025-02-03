<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../DB/database.php';
$db = new DataBase("localhost", "root", "", "ECommerceDB");
$conn = $db->getConnection();

$cartItemId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($cartItemId > 0) {
    $stmt = $conn->prepare("DELETE FROM ProdottiInCarrello WHERE id = ?");
    $stmt->bind_param("i", $cartItemId);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
header("Location: cart.php");
exit();
?>
