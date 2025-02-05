<!DOCTYPE html>
<html lang="it" data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudentMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/formStyle.css"/>
    </style>
  </head>
  <body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-custom navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">StudentMarket</a>
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-black border-bottom">
              <h5 style="color:white">StudentMarket</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            <form class="d-flex mt-3" action="../php/shop.php" method="GET">
            <input class="form-control me-2" type="text" placeholder="cerca..." aria-label="Search" name="search" id="search">
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
                <button class="btn btn-outline-light ms-3" id="themeToggle" title="Cambia Tema">
                <i class="bi bi-sun" id="themeIcon"></i>
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
    <footer class="bg-dark text-white py-3 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-3">
                <h5 class="text-white mb-2">StudentMarket</h5>
                <ul class="list-unstyled">
                    <li><a href="../php/shop.php" class="text-white-50">Compra</a></li>
                    <li><a href="../php/profile.php" class="text-white-50">Profilo</a></li>
                    <li><a href="../php/cart.php" class="text-white-50">Carrello</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <h5 class="text-white mb-2">Supporto</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50">FAQ</a></li>
                    <li><a href="#" class="text-white-50">Contatti</a></li>
                    <li><a href="#" class="text-white-50">Spedizioni</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <h5 class="text-white mb-2">Seguici</h5>
                <ul class="list-unstyled d-flex gap-3">
                    <li><a href="#" class="text-white-50"><i class="bi bi-facebook fs-4"></i></a></li>
                    <li><a href="#" class="text-white-50"><i class="bi bi-instagram fs-4"></i></a></li>
                    <li><a href="#" class="text-white-50"><i class="bi bi-twitter fs-4"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-3">
            <small>&copy; 2025 StudentMarket. Tutti i diritti riservati.</small>
        </div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const themeToggle = document.getElementById("themeToggle");
        const themeIcon = document.getElementById("themeIcon");
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
            if (theme === "light") {
                themeIcon.classList.remove("bi-sun");
                themeIcon.classList.add("bi-moon");
                themeToggle.title = "Passa alla modalità notte";
            } else {
                themeIcon.classList.remove("bi-moon");
                themeIcon.classList.add("bi-sun");
                themeToggle.title = "Passa alla modalità chiara";
            }
        }
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>