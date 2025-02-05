<?php
session_start();
require_once '../DB/database.php';

// Verifica se l'utente è loggato e ha il ruolo di venditore
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$userId = $_SESSION['user_id']; // ID del venditore
$db = new DataBase("localhost", "root", "", "ECommerceDB");
$conn = $db->getConnection();

// Recupero dati dal form
$nome = $_POST['nome'];
$prezzo = $_POST['prezzo'];
$categoria = $_POST['categoria'];
$disponibilita = $_POST['disponibilita'];
$descrizione = $_POST['descrizione'];

// Gestione dell'upload dell'immagine
$targetDir = "../img/";
$immagineNome = basename($_FILES["immagine"]["name"]);
$targetFilePath = $targetDir . $immagineNome;
move_uploaded_file($_FILES["immagine"]["tmp_name"], $targetFilePath);

// Inserimento del prodotto nella tabella Prodotti
$stmt = $conn->prepare("INSERT INTO Prodotti (nome, immagine, categoria, prezzo, descrizione, disponibilita) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $nome, $targetFilePath, $categoria, $prezzo, $descrizione, $disponibilita);
$stmt->execute();
$productId = $stmt->insert_id;
$stmt->close();

// Verifica se il venditore ha già un listino
$stmt = $conn->prepare("SELECT id FROM Listini WHERE id_Utente = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    // Se non ha un listino, crearlo
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO Listini (id_Utente) VALUES (?)");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $listinoId = $stmt->insert_id;
    $stmt->close();
} else {
    // Se il listino esiste, recuperare l'ID
    $stmt->bind_result($listinoId);
    $stmt->fetch();
    $stmt->close();
}

// Associare il prodotto al listino
$stmt = $conn->prepare("INSERT INTO ProdottiInListino (id_Listino, id_Prodotto) VALUES (?, ?)");
$stmt->bind_param("ii", $listinoId, $productId);
$stmt->execute();
$stmt->close();

$conn->close();

// Reindirizzamento con successo
header("Location: ../pages/sellerDashboard.php?success=product_added");
exit();
?>
