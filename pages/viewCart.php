<?php
require_once '../DB/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = new DataBase("localhost", "root", "", "ecommercedb"); 
$userId = $_SESSION['user_id'];

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

<div class="container mt-5 mb-5">
    <h4 class="mb-4">Il tuo carrello</h4>

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
                                <button class="btn btn-outline-primary btn-decrease" data-id="<?php echo $item['cart_item_id']; ?>">-</button>
                                <label for="quantity-<?php echo $item['cart_item_id']; ?>" class="visually-hidden">Quantità</label>
                                <input type="number" class="form-control text-center" id="quantity-<?php echo $item['cart_item_id']; ?>"
                                    value="<?php echo $item['quantita']; ?>"
                                    data-available-qty="<?php echo $item['disponibilita']; ?>" min="1" 
                                    max="<?php echo $item['disponibilita']; ?>" readonly>
                                <button class="btn btn-outline-primary btn-increase" data-id="<?php echo $item['cart_item_id']; ?>">+</button>
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

<script src="../js/viewCart.js"></script>
