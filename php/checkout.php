<?php
require_once 'start.php';

session_start();
require_once '../DB/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new DataBase("localhost", "root", "", "ECommerceDB");
$conn = $db->getConnection();
$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id FROM Carrelli WHERE id_Utente = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    error_log("Errore: Nessun carrello trovato per l'utente ID: $userId");
    $stmt->close();
    header("Location: cart.php?error=no_cart");
    exit();
} else {
    $stmt->bind_result($cartId);
    $stmt->fetch();
    $stmt->close();
}

$stmt = $conn->prepare("
    SELECT pic.id_Prodotto, pic.quantita, p.disponibilita, p.nome
    FROM ProdottiInCarrello pic 
    INNER JOIN Prodotti p ON pic.id_Prodotto = p.id 
    WHERE pic.id_Carrello = ?");
$stmt->bind_param("i", $cartId);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if (empty($cartItems)) {
    error_log("Errore: Il carrello è vuoto per l'utente ID: $userId");
    header("Location: cart.php?error=empty_cart");
    exit();
}

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO Acquisti (id_Utente) VALUES (?)");
    $stmt->bind_param("i", $userId);
    if (!$stmt->execute()) {
        throw new Exception("Errore nell'inserimento in Acquisti: " . $stmt->error);
    }
    $acquistoId = $stmt->insert_id;
    $stmt->close();

    foreach ($cartItems as $item) {
        $productId = $item['id_Prodotto'];
        $quantity = $item['quantita'];
        $available = $item['disponibilita'];

        if ($quantity > $available) {
            throw new Exception("Errore: Stock insufficiente per il prodotto ID: $productId");
        }

        $stmt = $conn->prepare("INSERT INTO AcquistoProdotti (id_Acquisto, id_Prodotto, quantita) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $acquistoId, $productId, $quantity);
        if (!$stmt->execute()) {
            throw new Exception("Errore nell'inserimento in AcquistoProdotti: " . $stmt->error);
        }
        $stmt->close();

        $newStock = $available - $quantity;
        $stmt = $conn->prepare("UPDATE Prodotti SET disponibilita = ? WHERE id = ?");
        $stmt->bind_param("ii", $newStock, $productId);
        if (!$stmt->execute()) {
            throw new Exception("Errore nell'aggiornamento della disponibilità del prodotto ID: $productId. " . $stmt->error);
        }
        $stmt->close();
    }

    $stmt = $conn->prepare("DELETE FROM ProdottiInCarrello WHERE id_Carrello = ?");
    $stmt->bind_param("i", $cartId);
    if (!$stmt->execute()) {
        throw new Exception("Errore nella rimozione del carrello: " . $stmt->error);
    }
    $stmt->close();

    $conn->commit();


    $titolo = "Acquisto ".$item["nome"];
    $testo = "Notifica di conferma di avvenuto acquisto di ".$quantity." ".$item["nome"];

    $db->notificaAcquisto($acquistoId, $titolo, $testo, $userId);
    $idVendita = $db->addVendita($db->getVenditoreByIdProdotto($productId), $productId, $quantity);

    $titolo = "Vendita ".$item["nome"];
    $testo = "Notifica di conferma di avvenuta vendita di ".$quantity." ".$item["nome"];
    $db->notificaVendita($idVendita, $titolo, $testo, $db->getVenditoreByIdProdotto($productId));

    if($newStock == 0){
        $titolo = "Esaurito ".$item["nome"];
        $testo = "Il tuo prodotto: ".$item["nome"]." è esaurito";
        $db->notificaFineProdotto($productId, $titolo, $testo, $db->getVenditoreByIdProdotto($productId));
    }

    $conn->close();

    $pageParams["nome"] = "../pages/viewCheckout.php";
    require '../pages/base.php';

} catch (Exception $e) {
    $conn->rollback();
    error_log("Checkout fallito: " . $e->getMessage());
    $conn->close();
    header("Location: cart.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>