<?php if (isset($_SESSION["confermaAddProdotto"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-primary border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION["confermaAddProdotto"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($_SESSION["confermaAddProdotto"]);?>
<?php if (isset($_SESSION["confermaModifica"])): ?>
    <div class="position-fixed top-25 start-50 translate-middle-x p-3 toast-container">
        <div id="errorToast" class="toast align-items-center text-bg-primary border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION["confermaModifica"]) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; unset($_SESSION["confermaModifica"]);?>
<?php $listino = $pageParams["listino"];?>
<div class="container mt-5">
    <h4 class="mb-4">Il tuo listino</h4>
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

