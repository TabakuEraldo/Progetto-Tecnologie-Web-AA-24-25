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
<div class="d-flex justify-content-center align-items-center"> 
    <div class="mt-3 w-50 mb-5">
        <h4 class="text-center">Modifica password</h4>
        <form action="../php/executeModificaPassword.php" method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-12">
                <label for="passwordAttuale" class="form-label fw-semibold fs-6 text-dark">Password corrente</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="passwordAttuale" name="passwordAttuale" required>
                    <button type="button" class="btn btn-outline-secondary togglePassword">
                        👁️
                    </button>
                </div>
            </div>
            <div class="col-12">
                <label for="passwordNuova" class="form-label fw-semibold fs-6 text-dark">Nuova Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="passwordNuova" name="passwordNuova" required>
                    <button type="button" class="btn btn-outline-secondary togglePassword">
                        👁️
                    </button>
                </div>
            </div>
            <div class="col-12">
                <label for="confermaNuova" class="form-label fw-semibold fs-6 text-dark">Conferma Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confermaNuova" name="confermaNuova" required>
                    <button type="button" class="btn btn-outline-secondary togglePassword">
                        👁️
                    </button>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Conferma Modifica</button>
            </div>
        </form>
    </div>
</div>

<script src="../js/modificaPassword.js"></script>
