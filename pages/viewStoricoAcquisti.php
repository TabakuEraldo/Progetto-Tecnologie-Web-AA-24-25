<?php $storico = $pageParams["storicoAcquisti"];?>
<div class="container mt-5">
    <h2 class="mb-4">I tuoi acquisti</h2>
    <?php if (empty($storico)): ?>
        <div class="alert alert-info">Non è stato effettuato alcun acquisto</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light table-hover table-bordered">
                    <tr>
                        <th>Immagine</th>
                        <th>Nome</th>
                        <th>Prezzo</th>
                        <th>Categoria</th>
                        <th>Quantità</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($storico as $item):?>
                        <tr>
                            <td>
                                <img src="../img/<?php echo htmlspecialchars($item['immagine']); ?>" class="img-fluid" style="max-width: 100px; height: auto;" alt="Immagine prodotto">
                            </td>
                            <td><?php echo htmlspecialchars($item['nome']); ?></td>
                            <td><?php echo number_format($item['prezzo'], 2, ',', '.'); ?>€</td>
                            <td><?php echo htmlspecialchars($item['categoria']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantita']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

