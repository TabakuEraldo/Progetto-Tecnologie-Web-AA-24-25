<?php
require_once '../DB/database.php';

$db = new DataBase("localhost", "root", "", "ecommercedb");
$conn = $db->getConnection();

// Recupera gli ultimi 6 prodotti aggiunti
$sql = "SELECT id, nome, immagine, prezzo, descrizione FROM Prodotti ORDER BY ID DESC LIMIT 3";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

// Restituisce i dati in formato JSON
header('Content-Type: application/json');
echo json_encode($products);
?>
