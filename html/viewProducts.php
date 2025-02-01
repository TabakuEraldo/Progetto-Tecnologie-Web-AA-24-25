<h1>STOCAZZO</h1>
<?php foreach($pageParams["randProducts"] as $prod): ?>
        <article>
            <header>
                <div>
                    <p><?php echo $prod["immagine"]; ?></p>
                </div>
                <h2><?php echo $prod["nome"]; ?></h2>
                <p><?php echo $prod["prezzo"]; ?> - <?php echo $prod["disponibilita"]; ?></p>
            </header>
        </article>
<?php endforeach; ?>