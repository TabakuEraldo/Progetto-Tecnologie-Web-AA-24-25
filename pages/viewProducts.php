<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($pageParams["products"] as $prod): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <!-- Immagine del prodotto -->
                    <img src="<?php echo "../img/" . htmlspecialchars($prod["immagine"]); ?>" class="card-img-top" alt="Immagine del prodotto">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($prod["nome"]); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($prod["descrizione"]); ?></p>
                        <p class="card-text"><strong>Prezzo: </strong><?php echo $prod["prezzo"]; ?>$</p>
                    </div>

                    <!-- Footer con selettore quantità e aggiungi al carrello -->
                    <footer class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Selettore quantità -->
                            <div class="btn-group" role="group" aria-label="Selettore quantità">
                                <button type="button" class="btn btn-outline-primary" onclick="decreaseQuantity(<?php echo (int)$prod['id']; ?>)">-</button>
                                <button type="button" class="btn btn-outline-primary" id="quantity-<?php echo (int)$prod['id']; ?>">1</button>
                                <button type="button" class="btn btn-outline-primary" onclick="increaseQuantity(<?php echo (int)$prod['id']; ?>)">+</button>
                            </div>
                        </div>
                    </footer>

                    <div class="mt-2">
                        <button class="btn btn-outline-success w-100" onclick="addToCart(<?php echo (int)$prod['id']; ?>)">Aggiungi al carrello</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    // Funzione per diminuire la quantità
    function decreaseQuantity(prodId) {
        const qtyElem = document.getElementById("quantity-" + prodId);
        let qty = parseInt(qtyElem.textContent);
        if (qty > 1) {
            qtyElem.textContent = qty - 1;
        }
    }

    // Funzione per aumentare la quantità
    function increaseQuantity(prodId) {
        const qtyElem = document.getElementById("quantity-" + prodId);
        let qty = parseInt(qtyElem.textContent);
        qtyElem.textContent = qty + 1;
    }

    // Funzione per aggiungere al carrello
    function addToCart(prodId) {
        const qtyElem = document.getElementById("quantity-" + prodId);
        const qty = parseInt(qtyElem.textContent);
        // Reindirizza alla pagina addToCart.php, passando ID prodotto e quantità tramite query string
        window.location.href = "../php/addToCart.php?id=" + prodId + "&quantity=" + qty;
    }
</script>

