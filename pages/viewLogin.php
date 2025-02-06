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
<?php if (isset($_SESSION["confermaRegistrazione"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-primary border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION["confermaRegistrazione"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($_SESSION["confermaRegistrazione"]);?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-4">Accedi al tuo account</h4>
        <form action="../php/executeLogin.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        👁️
                    </button>
                </div>
            </div>

            <fieldset class="mb-3 text-center">
                <legend class="visually-hidden">Seleziona il tuo ruolo</legend>
                <div class="d-flex gap-3 justify-content-center">
                    <input type="radio" class="btn-check" id="buyer" name="role" value="buyer" checked>
                    <label class="role-btn" for="buyer">Compratore</label>

                    <input type="radio" class="btn-check" id="seller" name="role" value="seller">
                    <label class="role-btn" for="seller">Venditore</label>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary w-100">Accedi</button>
        </form>

        <p class="mt-3 text-center">Non hai un account? <a href="register.php">Registrati qui</a></p>
    </div>
</div>


<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.textContent = "🙈";
        } else {
            passwordField.type = "password";
            this.textContent = "👁️";
        }
    });
</script>
