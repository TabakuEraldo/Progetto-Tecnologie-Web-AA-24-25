<div class="container mt-5 py-5"> 
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (!empty($pageParams["products"])): ?>
            <?php foreach($pageParams["products"] as $prod): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo "../img/" . htmlspecialchars($prod["immagine"]); ?>" class="card-img-top" alt="Immagine del prodotto">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($prod["nome"]); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($prod["descrizione"]); ?></p>
                            <p class="card-text"><strong>Prezzo: </strong><?php echo $prod["prezzo"]; ?>$</p>
                        </div>
                        <?php if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] == "buyer"):?>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == "buyer"):?>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-primary" onclick="decreaseQuantity(<?php echo (int)$prod['id']; ?>)">-</button>
                                            <span class="btn btn-outline-primary" id="quantity-<?php echo (int)$prod['id']; ?>">1</span>
                                            <button type="button" class="btn btn-outline-primary" onclick="increaseQuantity(<?php echo (int)$prod['id']; ?>)">+</button>
                                        </div>
                                        <button class="btn btn-outline-success" onclick="addToCart(<?php echo (int)$prod['id']; ?>)">Aggiungi al carrello</button>
                                    <?php else:?>
                                        <a href="../php/login.php" class="btn btn-primary">Vai al login</a>
                                    <?php endif;?>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted text-center w-100">Nessun prodotto trovato.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    let productStock = {
        <?php foreach ($pageParams["products"] as $prod): ?>
            <?php echo (int)$prod['id']; ?>: <?php echo (int)$prod['disponibilita']; ?>,
        <?php endforeach; ?>
    };

    function decreaseQuantity(prodId) {
        const qtyElem = document.getElementById("quantity-" + prodId);
        const increaseBtn = document.getElementById("increase-" + prodId);
        let qty = parseInt(qtyElem.textContent);

        if (qty > 1) {
            qtyElem.textContent = qty - 1;
        }

        if (qty - 1 < productStock[prodId]) {
            increaseBtn.disabled = false;
        }
    }

    function increaseQuantity(prodId) {
        const qtyElem = document.getElementById("quantity-" + prodId);
        const increaseBtn = document.getElementById("increase-" + prodId);
        let qty = parseInt(qtyElem.textContent);

        if (qty < productStock[prodId]) {
            qtyElem.textContent = qty + 1;
        }

        if (qty + 1 >= productStock[prodId]) {
            increaseBtn.disabled = true;
        }
    }

    function addToCart(prodId) {
        const qtyElem = document.getElementById("quantity-" + prodId);
        const qty = parseInt(qtyElem.textContent);

        fetch("../php/addToCart.php?id=" + prodId + "&quantity=" + qty, {
            method: "GET"
        }).then(response => response.text())
        .then(data => {
            alert("Prodotto aggiunto al carrello!");
        }).catch(error => {
            console.error("Errore:", error);
        });
    }
</script>
