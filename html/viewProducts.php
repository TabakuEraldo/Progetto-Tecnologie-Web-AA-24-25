<h1>sistema il fatto che 3 vanno su una riga e poi va mobile first</h1>
<?php foreach($pageParams["randProducts"] as $prod): ?>
    <div class="card" style="width: 18rem;">
    <img src=<?php echo "../img/".$prod["immagine"]?> class="card-img-top" alt="Immagine del prodotto">
    <div class="card-body">
        <h5 class="card-title"><?php echo $prod["nome"]?></h5>
        <p class="card-text"><?php echo $prod["descrizione"]?></p>
        <p class="card-text"><?php echo $prod["prezzo"]?></p>
        <p class="card-text"><?php echo $prod["disponibilita"]?></p>
    </div>
</div>
<?php endforeach; ?>
