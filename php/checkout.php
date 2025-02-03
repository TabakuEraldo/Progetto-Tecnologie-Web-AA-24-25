<?php
require '../DB/database.php';
session_start();

header('Content-Type: application/json');

// Controllo se i dati sono stati inviati correttamente
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Nessun dato ricevuto"]);
    exit;
}

$db = new DataBase('localhost', 'root', '', 'ecommercedb');

// Salviamo ogni prodotto acquistato nel database
foreach ($data as $item) {
    $query = $db->db->prepare("INSERT INTO carrello (utente_id, prodotto_id, quantita) VALUES (?, ?, ?)");
    $query->bind_param("iii", $_SESSION['user_id'], $item['id'], $item['quantity']);
    $query->execute();
}

echo json_encode(["success" => true]);
?>
