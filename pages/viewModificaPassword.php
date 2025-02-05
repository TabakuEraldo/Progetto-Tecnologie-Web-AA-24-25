<div class="d-flex justify-content-center align-items-center"> 
    <div class="mt-3 w-50">
        <h2 class="text-center">Modifica password</h2>
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

<script>
    document.querySelectorAll(".togglePassword").forEach(button => {
        button.addEventListener("click", function () {
            const passwordField = this.previousElementSibling;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.textContent = "🙈";
            } else {
                passwordField.type = "password";
                this.textContent = "👁️";
            }
        });
    });
</script>
