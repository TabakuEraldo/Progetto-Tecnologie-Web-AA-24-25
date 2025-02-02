<h1>le card sono troppo attaccate ai bordi e vanno rese più piccole</h1>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach($pageParams["randProducts"] as $prod): ?>
        <div class="col">
            <div class="card h-100">
                <img src=<?php echo "../img/".$prod["immagine"]?> class="card-img-top" alt="Immagine del prodotto">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $prod["nome"]?></h5>
                    <p class="card-text"><?php echo $prod["descrizione"]?></p>
                    <p class="card-text"><?php echo "<b>Prezzo: </b>".$prod["prezzo"]."$"?></p>
                </div>
                <footer class="card-footer">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <button type="button" class="btn btn-outline-primary">-</button>
                        <button type="button" class="btn btn-outline-primary">1</button>
                        <button type="button" class="btn btn-outline-primary">+</button>
                    </div>
                </footer>
            </div>
        </div>
    <?php endforeach; ?>
</div>

