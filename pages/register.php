<div class="container mt-5">
  <h2>Registrati al sito</h2>
  <form action="../php/register.php" method="POST">
    <div class="mb-3">
      <label for="fullName" class="form-label">Nome Completo</label>
      <input type="text" class="form-control" id="fullName" name="fullName" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="form-label">Conferma Password</label>
      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
    </div>

    <button type="submit" class="btn btn-primary">Registrati</button>
  </form>

  <p class="mt-3">Hai già un account? <a href="../php/login.php">Accedi qui</a></p>
</div>