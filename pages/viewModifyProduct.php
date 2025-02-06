<?php if(empty($pageParams["modificaProd"])):?>
    <p class="text-muted text-center w-100">Nessun prodotto selezionato</p>
    <a href="../php/manageProducts.php" class="btn btn-secondary btn-sm">Indietro</a>
<?php else: $prod= $pageParams["modificaProd"];?>
<?php if (isset($_SESSION["confermaModifica"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-primary border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION["confermaModifica"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($_SESSION["confermaModifica"]);?>
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
    <div class="mt-3 mb-5">
        <h4>Modifica prodotto</h4>
        <form action="../php/executeModificaProdotto.php" method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label fw-semibold fs-6 text-dark">Nome</label>
                <input type="hidden" name="id" value="<?php echo $prod["id"]; ?>">
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $prod["nome"];?>" required>
            </div>
            <div class="col-md-6">
                <label for="prezzo" class="form-label fw-semibold fs-6 text-dark">Prezzo (€)</label>
                <input type="number" step="0.01" class="form-control" id="prezzo" name="prezzo" value="<?php echo $prod["prezzo"];?>" required>
            </div>
            <div class="col-md-6">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria">
                    <option value="Elettronica" <?php if ($prod["categoria"] == "Elettronica") echo "selected"; ?>>Elettronica</option>
                    <option value="Didattica" <?php if ($prod["categoria"] == "Didattica") echo "selected"; ?>>Didattica</option>
                    <option value="Usato" <?php if ($prod["categoria"] == "Usato") echo "selected"; ?>>Usato</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="disponibilita" class="form-label fw-semibold fs-6 text-dark">Quantità</label>
                <input type="number" class="form-control" id="disponibilita" name="disponibilita" value="<?php echo $prod["disponibilita"];?>" required>
            </div>
            <div class="col-12">
                <label for="descrizione" class="form-label fw-semibold fs-6 text-dark">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" required><?php echo $prod["descrizione"];?> </textarea>
            </div>
            <div class="col-12">
                <label for="immagine" class="form-label fw-semibold fs-6 text-dark">Immagine (non è ncessario se non vuoi cambiare immagine)</label>
                <input type="hidden" name="immagine_attuale" value="<?php echo $prod["immagine"]; ?>">
                <input type="file" class="form-control" id="immagine" name="immagine" accept="image/*">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modifica Prodotto</button>
            </div>
        </form>
    </div>
<?php endif;?>

<script src="../js/modifyProduct.js"></script>

