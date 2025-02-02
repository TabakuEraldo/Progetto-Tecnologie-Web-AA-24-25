<?php
session_start();
require_once('../DB/database.php');

// Verifica che l'utente sia loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Crea un'istanza della classe DataBase
$db = new DataBase("localhost", "root", "", "ECommerceDB");

// Ottieni la connessione interna tramite il metodo getConnection()
$conn = $db->getConnection();

// Recupera i dati inviati dal form
$productId = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);
$userId = $_SESSION['user_id'];

// Controlla che la quantità sia almeno 1
if ($quantity < 1) {
    die("Quantità non valida.");
}

// Verifica la disponibilità del prodotto
$stmt = $conn->prepare("SELECT disponibilita FROM Prodotti WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Prodotto non trovato.");
}
$product = $result->fetch_assoc();
$stmt->close();

if ($quantity > $product['disponibilita']) {
    die("La quantità richiesta supera la disponibilità.");
}

// Gestisci il carrello: verifica se l'utente ha già un carrello
$stmt = $conn->prepare("SELECT id FROM Carrelli WHERE id_Utente = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    $stmt->close();
    // Crea un nuovo carrello per l'utente
    $stmt = $conn->prepare("INSERT INTO Carrelli (id_Utente) VALUES (?)");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $carrelloId = $stmt->insert_id;
    $stmt->close();
} else {
    $stmt->bind_result($carrelloId);
    $stmt->fetch();
    $stmt->close();
}

// Controlla se il prodotto è già presente nel carrello
$stmt = $conn->prepare("SELECT id, quantita FROM ProdottiInCarrello WHERE id_Carrello = ? AND id_Prodotto = ?");
$stmt->bind_param("ii", $carrelloId, $productId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($cartItemId, $existingQuantity);
    $stmt->fetch();
    $stmt->close();
    $newQuantity = $existingQuantity + $quantity;
    if ($newQuantity > $product['disponibilita']) {
        die("La quantità totale nel carrello supera la disponibilità.");
    }
    $stmt = $conn->prepare("UPDATE ProdottiInCarrello SET quantita = ? WHERE id = ?");
    $stmt->bind_param("ii", $newQuantity, $cartItemId);
    $stmt->execute();
    $stmt->close();
} else {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO ProdottiInCarrello (id_Carrello, id_Prodotto, quantita) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $carrelloId, $productId, $quantity);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../pages/viewProducts.php?success=1");
exit();
?>

