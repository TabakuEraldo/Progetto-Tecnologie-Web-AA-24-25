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
    <h4>Aggungi prodotto</h4>
        <form action="../php/executeAddProdotto.php" method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label fw-semibold fs-6 text-dark">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6">
                <label for="prezzo" class="form-label fw-semibold fs-6 text-dark">Prezzo (€)</label>
                <input type="number" step="0.01" class="form-control" id="prezzo" name="prezzo" required>
            </div>
            <div class="col-md-6">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria">
                    <option value="Elettronica">Elettronica</option>
                    <option value="Usato">Usato</option>
                    <option value="Didattica">Didattica</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="disponibilita" class="form-label fw-semibold fs-6 text-dark">Quantità</label>
                <input type="number" class="form-control" id="disponibilita" name="disponibilita" required>
            </div>
            <div class="col-12">
                <label for="descrizione" class="form-label fw-semibold fs-6 text-dark">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" required></textarea>
            </div>
            <div class="col-12">
                <label for="immagine" class="form-label fw-semibold fs-6 text-dark">Immagine</label>
                <input type="file" class="form-control" id="immagine" name="immagine" accept="image/*" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Aggiungi Prodotto</button>
            </div>
        </form>
</div>

<script src="../js/viewAddProtto.js"></script>

