<?php
// getProducts.php
require '../DB/database.php'; // Assicurati di avere la connessione al database

// Query per selezionare 9 prodotti casuali
$sql = "SELECT id, nome, immagine, prezzo, descrizione, disponibilita FROM Prodotti ORDER BY RAND() LIMIT 9";
$result = $conn->query($sql);

$products = [];  // Inizializza l'array

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

// Includi la vista, che utilizzerà la variabile $products
include '../pages/viewProducts.php';
?>