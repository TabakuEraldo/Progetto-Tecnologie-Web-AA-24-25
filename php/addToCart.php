<?php
session_start();
require_once '../DB/database.php';

// Verifica che l'utente sia loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Crea un'istanza della classe DataBase e ottieni la connessione
$db = new DataBase("localhost", "root", "", "ECommerceDB");
$conn = $db->getConnection();

$userId = $_SESSION['user_id'];
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

if ($productId <= 0 || $quantity <= 0) {
    header("Location: ../pages/viewProducts.php?error=invalid_parameters");
    exit();
}

// Verifica la disponibilità del prodotto
$stmt = $conn->prepare("SELECT disponibilita FROM Prodotti WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $stmt->close();
    header("Location: ../pages/viewProducts.php?error=product_not_found");
    exit();
}
$product = $result->fetch_assoc();
$stmt->close();

if ($quantity > $product['disponibilita']) {
    header("Location: ../pages/viewProducts.php?error=exceeds_availability");
    exit();
}

// Verifica se l'utente ha già un carrello
$stmt = $conn->prepare("SELECT id FROM Carrelli WHERE id_Utente = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    $stmt->close();
    // Crea un nuovo carrello per l'utente in caso non ce l'abbia
    $stmt = $conn->prepare("INSERT INTO Carrelli (id_Utente) VALUES (?)");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $cartId = $stmt->insert_id;
    $stmt->close();
} else {
    $stmt->bind_result($cartId);
    $stmt->fetch();
    $stmt->close();
}

// Verifica se il prodotto è già presente nel carrello
$stmt = $conn->prepare("SELECT id, quantita FROM ProdottiInCarrello WHERE id_Carrello = ? AND id_Prodotto = ?");
$stmt->bind_param("ii", $cartId, $productId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($cartItemId, $existingQuantity);
    $stmt->fetch();
    $stmt->close();
    $newQuantity = $existingQuantity + $quantity;
    if ($newQuantity > $product['disponibilita']) {
        header("Location: ../pages/viewProducts.php?error=exceeds_availability");
        exit();
    }
    $stmt = $conn->prepare("UPDATE ProdottiInCarrello SET quantita = ? WHERE id = ?");
    $stmt->bind_param("ii", $newQuantity, $cartItemId);
    $stmt->execute();
    $stmt->close();
} else {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO ProdottiInCarrello (id_Carrello, id_Prodotto, quantita) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $cartId, $productId, $quantity);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: cart.php?success=1");
exit();
?>
