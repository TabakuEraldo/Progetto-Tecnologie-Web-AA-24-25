<?php
require_once '../DB/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new DataBase("localhost", "root", "", "ecommercedb"); 
$userId = $_SESSION['user_id'];

// Recupera l'ID del carrello dell'utente
$conn = $db->getConnection();
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
    $sql = "SELECT pic.id AS cart_item_id, p.id AS product_id, p.nome, p.immagine, p.prezzo, p.descrizione, pic.quantita, p.disponibilita
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
$conn->close();
?>

<div class="container mt-5">
    <h2 class="mb-4">Il tuo carrello</h2>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">Il carrello è vuoto.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light table-hover table-bordered">
                    <tr>
                        <th>Immagine</th>
                        <th>Nome</th>
                        <th>Prezzo</th>
                        <th>Quantità</th>
                        <th>Totale</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grandTotal = 0;
                    foreach($cartItems as $item):
                        $total = $item['prezzo'] * $item['quantita'];
                        $grandTotal += $total;
                    ?>
                    <tr>
                        <td>
                            <img src="../img/<?php echo htmlspecialchars($item['immagine']); ?>" class="img-fluid" style="max-width: 100px; height: auto;" alt="Immagine prodotto">
                        </td>
                        <td><?php echo htmlspecialchars($item['nome']); ?></td>
                        <td><?php echo number_format($item['prezzo'], 2, ',', '.'); ?>€</td>
                        <td>
                            <div class="input-group input-group-sm">
                                <button class="btn btn-outline-primary" onclick="updateQuantity(<?php echo $item['cart_item_id']; ?>, -1)">-</button>
                                <input type="number" class="form-control text-center" id="quantity-<?php echo $item['cart_item_id']; ?>"
                                    value="<?php echo $item['quantita']; ?>"
                                    data-available-qty="<?php echo $item['disponibilita']; ?>" min="1" 
                                    max="<?php echo $item['disponibilita']; ?>" readonly>
                                <button class="btn btn-outline-primary" onclick="updateQuantity(<?php echo $item['cart_item_id']; ?>, 1)">+</button>
                            </div>
                        </td>
                        <td><?php echo number_format($total, 2, ',', '.'); ?>€</td>
                        <td>
                            <a href="removeFromCart.php?id=<?php echo $item['cart_item_id']; ?>" class="btn btn-danger btn-sm">Rimuovi</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Totale</strong></td>
                        <td><?php echo number_format($grandTotal, 2, ',', '.'); ?>€</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <a href="../php/checkout.php" class="btn btn-primary">Procedi al Pagamento</a>
    <?php endif; ?>
</div>

<script>
function updateQuantity(cartItemId, change) {
    let qtyElem = document.getElementById("quantity-" + cartItemId);
    let currentQty = parseInt(qtyElem.value);

    // Recupera la disponibilità massima del prodotto dal database
    let availableQty = parseInt(qtyElem.getAttribute('data-available-qty'));

    // Verifica che la quantità selezionata non superi la disponibilità
    if (currentQty + change >= 1 && currentQty + change <= availableQty) {
        fetch("../php/updateCart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "cart_item_id=" + cartItemId + "&quantity=" + (currentQty + change)
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Stampa la risposta del server nel console log
            if (data === "success") {
                qtyElem.value = currentQty + change;
                location.reload(); // Ricarica la pagina per aggiornare il totale
            } else {
                alert("Errore nell'aggiornamento della quantità. Risposta: " + data);
            }
        })
        .catch(error => {
            console.error("Errore nella richiesta:", error);
            alert("Si è verificato un errore nella richiesta.");
        });
    } else {
        alert("La quantità richiesta supera la disponibilità del prodotto.");
    }
}

</script>
