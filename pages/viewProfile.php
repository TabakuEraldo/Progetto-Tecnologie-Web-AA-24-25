<div class="container mt-5">
    <h1 class="mb-4">Benvenuto, <?php echo htmlspecialchars($userName); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($userEmail); ?></p>
    <p>Ruolo: <?php echo htmlspecialchars($userRole == 'buyer' ? 'Compratore' : 'Venditore'); ?></p>
    <hr>

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

    <div class="mt-4">
        <h2>Il Tuo Profilo</h2>
        <p>Qui puoi aggiornare i tuoi dati personali e gestire le impostazioni del tuo account.</p>
        <a href="edit_profile.php" class="btn btn-secondary">Modifica Profilo</a>
        <a href="../php/logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>
