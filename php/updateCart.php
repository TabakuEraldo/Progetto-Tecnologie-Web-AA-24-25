<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['user_id'])) {
    echo "error";
    exit();
}

$db = new DataBase("localhost", "root", "", "ecommercedb");
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cart_item_id'], $_POST['quantity'])) {
    $cartItemId = intval($_POST['cart_item_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity > 0) {
        $stmt = $conn->prepare("UPDATE ProdottiInCarrello SET quantita = ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $cartItemId);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
        $stmt->close();
    }
}

$conn->close();
?>
