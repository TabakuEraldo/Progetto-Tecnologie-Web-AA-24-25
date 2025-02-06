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

if (isset($_POST['cambiaRuolo'])) {
    $newRole = ($userRole == 'buyer') ? 'seller' : 'buyer';
    $_SESSION['user_role'] = $newRole;
    header("Location: profile.php");
    exit();
}
?>

<?php if (isset($_SESSION["confermaModificaProf"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-primary border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION["confermaModificaProf"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($_SESSION["confermaModificaProf"]);?>
<?php if (isset($_SESSION["confermaModificaPass"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-primary border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION["confermaModificaPass"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($_SESSION["confermaModificaPass"]);?>
<?php if (isset($_SESSION["errore"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION["errore"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($_SESSION["errore"]);?>

<div class="container mt-5">
    <div class="card text-center mb-4">
        <div class="card-body">
            <img src="../img/<?php echo htmlspecialchars($profileImage); ?>" alt="Foto Profilo" class="profile-img mb-3">
            <h4><?php echo htmlspecialchars($userName); ?></h4>
            <p class="text-muted"><?php echo htmlspecialchars($userEmail); ?></p>
            <p><strong>Account:</strong> <?php echo htmlspecialchars($userRole == 'buyer' ? 'Compratore' : 'Venditore'); ?></p>
            <form method="POST" class="cambia-ruolo-form mb-3">
                <button type="submit" name="cambiaRuolo" class="btn btn-warning btn-sm">
                <strong>passa a:</strong> <?php echo htmlspecialchars($userRole == 'buyer' ? 'Venditore' : 'Compratore'); ?>
                </button>
            </form>
            <a href="../php/modificaProfilo.php" class="btn btn-secondary btn-sm">Modifica Profilo</a>
            <a href="../php/notifications.php" class="btn btn-danger btn-sm">Notifiche</a>
            <a href="../php/logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="text-center mb-3">Dashboard</h4>
            <div class="row">
                <?php if ($userRole == 'buyer'): ?>
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
                    <div class="col-md-4">
                        <div class="card mb-3 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Statistiche</h5>
                                <p class="card-text">Consulta le statistiche relative alle vendite dei tuoi prodotti</p>
                                <a href="../php/Statistiche.php" class="btn btn-primary btn-sm">Visualizza Statistiche</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
