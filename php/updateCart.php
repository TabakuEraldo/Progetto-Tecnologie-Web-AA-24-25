<?php
session_start();
require_once '../DB/database.php';

if (!isset($_SESSION['user_id'])) {
    echo "error";
    exit();
}

$db = new DataBase("localhost", "root", "", "ecommercedb");
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cart_item_id'], $_POST['quantity'])) {
    $cartItemId = intval($_POST['cart_item_id']);
    $quantity = intval($_POST['quantity']);

    // Verifica che la quantità sia maggiore di 0
    if ($quantity > 0) {
        // Ottieni la disponibilità del prodotto
        $stmt = $conn->prepare("SELECT p.disponibilita FROM ProdottiInCarrello pic 
                                INNER JOIN Prodotti p ON pic.id_Prodotto = p.id 
                                WHERE pic.id = ?");
        $stmt->bind_param("i", $cartItemId);
        $stmt->execute();
        $stmt->bind_result($availableQty);
        $stmt->fetch();
        $stmt->close();

        // Verifica se la quantità richiesta è disponibile
        if ($quantity <= $availableQty) {
            // Aggiorna la quantità nel carrello
            $stmt = $conn->prepare("UPDATE ProdottiInCarrello SET quantita = ? WHERE id = ?");
            $stmt->bind_param("ii", $quantity, $cartItemId);
            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "error";
            }
            $stmt->close();
        } else {
            // Se la quantità richiesta supera la disponibilità
            echo "La quantità richiesta supera la disponibilità.";
        }
    } else {
        echo "La quantità deve essere maggiore di 0.";
    }
}

$conn->close();
?>
