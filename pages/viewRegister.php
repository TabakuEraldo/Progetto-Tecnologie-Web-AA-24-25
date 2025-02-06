<?php if (isset($pageParams["errore"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($pageParams["errore"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($pageParams["errore"]);?>
<div class="container d-flex justify-content-center align-items-center min-vh-100 mb-5">
    <div class="card p-4 shadow-sm w-100 col-md-6 col-lg-4 col-xl-3">
        <h4 class="text-center mb-4">Registrati al sito</h4>
        <form action="../php/executeRegistration.php" method="POST" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-6">
                    <label for="cognome" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="cognome" name="cognome" required>
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-12">
                    <label for="indirizzo" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" id="indirizzo" name="indirizzo" required>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">👁️</button>
                    </div>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="confirmPassword" class="form-label">Conferma Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">👁️</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="profileImage" class="form-label fw-semibold fs-6 text-dark">Immagine (non è obbligatoria)</label>
                    <input type="file" class="form-control" id="profileImage" name="profileImage" accept="image/*">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100">Registrati</button>
                </div>
            </div>
        </form>
        <p class="mt-3 text-center">Hai già un account? <a href="login.php">Accedi qui</a></p>
    </div>
</div>

<script src="../js/register.js"></script>