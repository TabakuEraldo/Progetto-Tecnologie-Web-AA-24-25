<?php
require_once '../DB/database.php';

$db = new DataBase("localhost", "root", "", "ecommercedb");
$conn = $db->getConnection();

$sql = "SELECT id, nome, immagine, prezzo, descrizione FROM Prodotti WHERE disponibilita>0 ORDER BY data DESC LIMIT 3";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($products);
?>
