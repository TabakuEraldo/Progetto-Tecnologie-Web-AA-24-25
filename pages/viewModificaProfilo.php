<div class="mt-3">
        <h2>Modifica profilo</h2>
        <form action="../php/executeModificaProfilo.php" method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label fw-semibold fs-6 text-dark">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $_SESSION['user_name'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="cognome" class="form-label fw-semibold fs-6 text-dark">Cognome</label>
                <input type="text" class="form-control" id="cognome" name="cognome" value="<?php echo $_SESSION['user_cognome'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold fs-6 text-dark">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user_email'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="indirizzo" class="form-label fw-semibold fs-6 text-dark">Indirizzo</label>
                <input type="indirizzo" class="form-control" id="indirizzo" name="indirizzo" value="<?php echo $_SESSION['user_indirizzo'];?>" required>
            </div>
            <div class="col-12">
                <label for="immagine" class="form-label fw-semibold fs-6 text-dark">Immagine (non è ncessario se non vuoi cambiare immagine)</label>
                <input type="hidden" name="immagine_attuale" value="<?php echo $_SESSION['user_img']; ?>">
                <input type="file" class="form-control" id="immagine" name="immagine" accept="image/*">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Conferma Modifiche</button>
                <a type="submit" href="../php/modificaPassword.php" class="btn btn-secondary">Cambia Password</a>
            </div>
        </form>
    </div>


