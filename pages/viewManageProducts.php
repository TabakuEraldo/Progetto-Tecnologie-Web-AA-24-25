<?php $listino = $pageParams["listino"];?>
<div class="container mt-5">
    <h2 class="mb-4">Il tuo listino</h2>
    <?php if (empty($listino)): ?>
        <div class="alert alert-info">Il listino è vuoto.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light table-hover table-bordered">
                    <tr>
                        <th>Immagine</th>
                        <th>Nome</th>
                        <th>Prezzo</th>
                        <th>Categoria</th>
                        <th>Descrizione</th>
                        <th>Quantità</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listino as $item):?>
                        <tr>
                            <td>
                                <img src="../img/<?php echo htmlspecialchars($item['immagine']); ?>" class="img-fluid" style="max-width: 100px; height: auto;" alt="Immagine prodotto">
                            </td>
                            <td><?php echo htmlspecialchars($item['nome']); ?></td>
                            <td><?php echo number_format($item['prezzo'], 2, ',', '.'); ?>€</td>
                            <td><?php echo htmlspecialchars($item['categoria']); ?></td>
                            <td><?php echo htmlspecialchars($item['descrizione']); ?></td>
                            <td><?php echo htmlspecialchars($item['disponibilita']); ?></td>
                            <td><a class="btn btn-primary btn-sm" href="../php/modificaProdotto.php?id=<?php echo $item['id']; ?>">Modifica</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

