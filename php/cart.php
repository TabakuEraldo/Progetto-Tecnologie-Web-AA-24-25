<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../DB/database.php';
$db = new DataBase("localhost", "root", "", "ECommerceDB");
$conn = $db->getConnection();

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id FROM Carrelli WHERE id_Utente = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    $cartId = null;
} else {
    $stmt->bind_result($cartId);
    $stmt->fetch();
}
$stmt->close();

$cartItems = [];
if ($cartId !== null) {
    $sql = "SELECT pic.id AS cart_item_id, p.id AS product_id, p.nome, p.immagine, p.prezzo, p.descrizione, p.disponibilita, pic.quantita
            FROM ProdottiInCarrello pic
            INNER JOIN Prodotti p ON pic.id_Prodotto = p.id
            WHERE pic.id_Carrello = ?
            AND p.disponibilita > 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cartId);
    $stmt->execute();
    $result = $stmt->get_result();
    $cartItems = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

}
$pageParams["nome"] = "../pages/viewCart.php";
require '../pages/base.php';

?>
