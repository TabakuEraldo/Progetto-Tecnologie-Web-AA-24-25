<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudentMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"/>
    </style>
  </head>
  <body>
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
                  <a class="nav-link" href="shop.php">Compra</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sell.php">Vendi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="cart.php">Carrello</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Accedi</a>
                  </li>
              </ul>       
            </div>
          </div>
        </div>
      </nav>
      <main>
    <?php
    if(isset($pageParams["nome"])){
        require($pageParams["nome"]);
    }
    ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>