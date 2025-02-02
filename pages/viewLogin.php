<div class="container mt-5">
  <h2>Accedi al tuo account</h2>
  <form action="../php/executeLogin.php" method="POST">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
    </div>
    
    <!-- Scelta del Ruolo (Compratore o Venditore) -->
    <div class="mb-3">
      <label class="form-label">Ruolo</label><br>
      <input type="radio" id="buyer" name="role" value="buyer" checked> <label for="buyer">Compratore</label><br>
      <input type="radio" id="seller" name="role" value="seller"> <label for="seller">Venditore</label>
    </div>
    
    <button type="submit" class="btn btn-primary">Accedi</button>
  </form>

  <!-- Link per la registrazione -->
  <p class="mt-3">Non hai un account? <a href="register.html">Registrati qui</a></p>
</div>
