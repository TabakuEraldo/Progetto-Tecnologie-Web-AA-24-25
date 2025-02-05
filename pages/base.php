<!DOCTYPE html>
<html lang="it" data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudentMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/formStyle.css"/>
    </style>
  </head>
  <body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-custom navbar-expand-lg">
        <div class="container-fluid">
          <!-- navbar -->
          <a class="navbar-brand" href="index.php">StudentMarket</a>

          <!-- sidebar -->
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-black border-bottom">
              <h5 style="color:white">StudentMarket</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
              <form class="d-flex mt-3" role="search" action="../php/shop.php" method="GET">
                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search" id="search">
                <button class="btn btn-outline-light" type="submit" data-bs-dismiss="offcanvas">Cerca</button>
              </form>
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                <li class="nav-item">
                  <a class="nav-link" href="profile.php">Profilo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="shop.php">Esplora</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="cart.php">Carrello</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="notifications.php">Notifiche</a>
                </li>
                  <button class="btn btn-outline-light ms-3" id="themeToggle">
  <i class="bi bi-moon"></i>
</button>

              </ul>       
            </div>
          </div>
        </div>
      </nav>
      <main class="flex-grow-1 container mt-4">
    <?php
    if(isset($pageParams["nome"])){
        require($pageParams["nome"]);
    }
    ?>
    </main>
        <!-- Footer -->
        <footer class="bg-dark text-white-50 mt-auto py-4">
      <div class="container">
        <div class="row">
          
          <!-- Navigazione -->
          <div class="col-md-3 col-sm-6 mb-3">
            <h5 class="text-white">StudentMarket</h5>
            <ul class="list-unstyled">
              <li><a href="shop.php" class="text-white-50">Compra</a></li>
              <li><a href="sell.php" class="text-white-50">Vendi</a></li>
              <li><a href="profile.php" class="text-white-50">Profilo</a></li>
              <li><a href="cart.php" class="text-white-50">Carrello</a></li>
            </ul>
          </div>

          <!-- Supporto clienti -->
          <div class="col-md-3 col-sm-6 mb-3">
            <h5 class="text-white">Supporto</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white-50">FAQ</a></li>
              <li><a href="#" class="text-white-50">Contatti</a></li>
              <li><a href="#" class="text-white-50">Spedizioni</a></li>
            </ul>
          </div>

          <div class="col-md-3 col-sm-6 mb-3">
            <h5 class="text-white">Seguici</h5>
            <ul class="list-unstyled d-flex gap-3">
              <li><a href="#" class="text-white-50"><i class="bi bi-facebook"></i></a></li>
              <li><a href="#" class="text-white-50"><i class="bi bi-instagram"></i></a></li>
              <li><a href="#" class="text-white-50"><i class="bi bi-twitter"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="text-center mt-4">
          <small>&copy; 2024 StudentMarket. Tutti i diritti riservati.</small>
        </div>
      </div>
    </footer>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const themeToggle = document.getElementById("themeToggle");
      const htmlElement = document.documentElement;
      const storedTheme = localStorage.getItem("theme") || "light";

      htmlElement.setAttribute("data-bs-theme", storedTheme);
      updateIcon(storedTheme);

      themeToggle.addEventListener("click", function () {
          let currentTheme = htmlElement.getAttribute("data-bs-theme");
          let newTheme = currentTheme === "light" ? "dark" : "light";

          htmlElement.setAttribute("data-bs-theme", newTheme);
          localStorage.setItem("theme", newTheme);
          updateIcon(newTheme);
      });

      function updateIcon(theme) {
          themeToggle.innerHTML = theme === "light" 
              ? '<i class="bi bi-moon"></i>' 
              : '<i class="bi bi-sun"></i>';
      }
  });
</script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  </body>
</html>