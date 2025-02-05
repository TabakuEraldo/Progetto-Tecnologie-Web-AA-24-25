<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Registrati al sito</h2>
        <form action="../php/executeRegistration.php" method="POST">
            <!-- Nome -->
            <div class="mb-3">
                <label for="fullName" class="form-label">Nome</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>

            <!-- Cognome -->
            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="cognome" name="cognome" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Password con pulsante mostra/nascondi -->
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        👁️
                    </button>
                </div>
            </div>

            <!-- Conferma Password -->
            <div class="mb-3 position-relative">
                <label for="confirmPassword" class="form-label">Conferma Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                        👁️
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="profileImage" class="form-label">Immagine del Profilo</label>
                <input type="file" class="form-control" id="profileImage" name="profileImage" accept="image/*">
            </div>

            <!-- Pulsante di registrazione -->
            <button type="submit" class="btn btn-primary w-100">Registrati</button>
        </form>

        <!-- Link per il login -->
        <p class="mt-3 text-center">Hai già un account? <a href="login.php">Accedi qui</a></p>
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

    document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
        const passwordField = document.getElementById("confirmPassword");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.textContent = "🙈";
        } else {
            passwordField.type = "password";
            this.textContent = "👁️";
        }
    });
</script>
