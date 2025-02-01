<?php
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Recupera i dati dell'utente dalla sessione
$userName = $_SESSION['user_name'] ?? 'Utente';
$userEmail = $_SESSION['email'] ?? 'Email non disponibile';
$userRole = $_SESSION['user_role'] ?? null;

?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profilo - StudentMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar navbar-custom navbar-expand-lg">
        <div class="container-fluid">
          <!-- navbar -->
          <a class="navbar-brand" href="index.html">StudentMarket</a>

          <!-- sidebar -->
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-black border-bottom">
              <h5 style="color:white">StudentMarket</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
              <form class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Cerca</button>
              </form>
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                <li class="nav-item">
                  <a class="nav-link" href="profile.php">Profilo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="shop.html">Compra</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sell.html">Vendi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="cart.html">Carrello</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html">Accedi</a>
                  </li>
              </ul>       
            </div>
          </div>
        </div>
      </nav><!-- Contenuto principale -->
<div class="container mt-5">
    <h1 class="mb-4">Benvenuto, <?php echo htmlspecialchars($userName); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($userEmail); ?></p>
    <p>Ruolo: <?php echo htmlspecialchars($userRole == 'buyer' ? 'Compratore' : 'Venditore'); ?></p>
    
    <hr>

    <!-- Sezione funzionalità specifiche in base al ruolo -->
    <?php if ($userRole == 'buyer'): ?>
        <h2>Area Compratore</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Acquista Prodotti</h5>
                        <p class="card-text">Sfoglia e acquista i prodotti messi in vendita dai tuoi colleghi.</p>
                        <a href="shop.html" class="btn btn-primary">Vai allo Shop</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Carrello</h5>
                        <p class="card-text">Visualizza e gestisci gli articoli presenti nel tuo carrello.</p>
                        <a href="cart.html" class="btn btn-primary">Vai al Carrello</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Storico Acquisti</h5>
                        <p class="card-text">Controlla i tuoi ordini e acquisti passati.</p>
                        <a href="purchase_history.php" class="btn btn-primary">Visualizza Storico</a>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($userRole == 'seller'): ?>
        <h2>Area Venditore</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Gestisci Prodotti</h5>
                        <p class="card-text">Visualizza, modifica o rimuovi i prodotti che hai messo in vendita.</p>
                        <a href="manage_products.php" class="btn btn-primary">Gestisci Prodotti</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Aggiungi Prodotto</h5>
                        <p class="card-text">Inserisci nuovi prodotti da vendere sul sito.</p>
                        <a href="add_product.php" class="btn btn-primary">Aggiungi Prodotto</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Storico Vendite</h5>
                        <p class="card-text">Consulta lo storico delle tue vendite e le relative transazioni.</p>
                        <a href="sales_history.php" class="btn btn-primary">Visualizza Storico</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Funzionalità comuni -->
    <div class="mt-4">
        <h2>Il Tuo Profilo</h2>
        <p>Qui puoi aggiornare i tuoi dati personali e gestire le impostazioni del tuo account.</p>
        <a href="edit_profile.php" class="btn btn-secondary">Modifica Profilo</a>
        <a href="../php/logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
