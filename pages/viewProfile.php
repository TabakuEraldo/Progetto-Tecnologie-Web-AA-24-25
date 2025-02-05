<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
require_once '../DB/database.php';

$db = new DataBase('localhost', 'root', '', 'ecommercedb'); 

$userId = $_SESSION['user_id'] ?? null;
$userEmail = $_SESSION['user_email'] ?? 'Email non disponibile';
$userRole = $_SESSION['user_role'] ?? null;
$userName = $_SESSION['user_name'] ?? 'Utente';

if ($userId) {
    $result = $db->login($userEmail);
    $userData = $result->fetch_assoc();
    $profileImage = $userData['imgProfilo'] ?? '../img/default.png';  
} else {
    $profileImage = '../img/default.png';
}

?>

<div class="container mt-5">
    <div class="card text-center mb-4">
        <div class="card-body">
            <!-- Visualizzazione dell'immagine del profilo -->
            <img src="../img/<?php echo htmlspecialchars($profileImage); ?>" alt="Foto Profilo" class="profile-img mb-3">
            <h4><?php echo htmlspecialchars($userName); ?></h4>
            <p class="text-muted"><?php echo htmlspecialchars($userEmail); ?></p>
            <p><strong>Account:</strong> <?php echo htmlspecialchars($userRole == 'buyer' ? 'Compratore' : 'Venditore'); ?></p>
            <a href="../php/modificaProfilo.php" class="btn btn-secondary btn-sm">Modifica Profilo</a>
            <a href="../php/logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h2 class="text-center mb-3">Dashboard</h2>
            <div class="row">
                <?php if ($userRole == 'buyer'): ?>
                    <!-- Se l'utente è un compratore -->
                    <div class="col-md-4">
                        <div class="card mb-3 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Acquista Prodotti</h5>
                                <p class="card-text">Sfoglia e acquista i prodotti disponibili.</p>
                                <a href="../php/shop.php" class="btn btn-primary btn-sm">Vai allo Shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Carrello</h5>
                                <p class="card-text">Gestisci gli articoli nel carrello.</p>
                                <a href="../php/cart.php" class="btn btn-primary btn-sm">Vai al Carrello</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Storico Acquisti</h5>
                                <p class="card-text">Consulta i tuoi acquisti passati.</p>
                                <a href="../php/storicoAcquisti.php" class="btn btn-primary btn-sm">Visualizza Storico</a>
                            </div>
                        </div>
                    </div>
                <?php elseif ($userRole == 'seller'): ?>
                    <!-- Se l'utente è un venditore -->
                    <div class="col-md-4">
                        <div class="card mb-3 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Gestisci Prodotti</h5>
                                <p class="card-text">Modifica o rimuovi i tuoi prodotti.</p>
                                <a href="../php/manageProducts.php" class="btn btn-primary btn-sm">Gestisci Prodotti</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Aggiungi Prodotto</h5>
                                <p class="card-text">Vendi nuovi prodotti agli studenti.</p>
                                <a href="../php/addProdotto.php" class="btn btn-primary btn-sm">Aggiungi Prodotto</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Storico Vendite</h5>
                                <p class="card-text">Consulta lo storico delle tue vendite.</p>
                                <a href="../php/storicoVendite.php" class="btn btn-primary btn-sm">Visualizza Storico</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
