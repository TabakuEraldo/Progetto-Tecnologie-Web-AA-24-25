<?php
$startDate = $_GET['start_date'] ?? date('Y-m-01');
$endDate   = $_GET['end_date']   ?? date('Y-m-d');

$userId = $_SESSION['user_id'];

// Query per ottenere le vendite nel periodo per il venditore corrente
$query = "
    SELECT p.nome AS prodotto, vp.quantita, vp.data, (p.prezzo * vp.quantita) AS ricavo
    FROM VenditaProdotti vp
    JOIN Vendite v ON vp.id_Vendita = v.id
    JOIN Prodotti p ON vp.id_Prodotto = p.id
    WHERE v.id_Utente = ? AND vp.data BETWEEN ? AND ?
    ORDER BY vp.data ASC";

$stmt = $db->getConnection()->prepare($query);
$stmt->bind_param("iss", $userId, $startDate, $endDate);
$stmt->execute();
$result = $stmt->get_result();

// Inizializza le variabili per il grafico
$vendite = [];
$prodottiVenduti = 0;
$ricaviTotali = 0;

while ($row = $result->fetch_assoc()) {
    $vendite[] = $row;
    $prodottiVenduti += $row['quantita'];
    $ricaviTotali += $row['ricavo'];
}
?>

<div class="container mt-4">
    <h2 class="text-center">Statistiche Vendite</h2>
    <div class="row text-center mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h4>Prodotti Venduti</h4>
                    <p class="fs-3"><?= $prodottiVenduti ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h4>Ricavo Totale</h4>
                    <p class="fs-3">€<?= number_format($ricaviTotali, 2) ?></p>
                </div>
            </div>
        </div>
        <!-- Puoi aggiungere altre card se necessario -->
    </div>

    <!-- Form per selezionare l'intervallo di date -->
    <form method="GET" class="mt-4">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Data Inizio:</label>
                <input type="date" class="form-control" name="start_date" value="<?= $startDate ?>">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Data Fine:</label>
                <input type="date" class="form-control" name="end_date" value="<?= $endDate ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtra</button>
            </div>
        </div>
    </form>

    <!-- Grafico delle vendite -->
    <canvas id="salesChart" class="mt-4"></canvas>

    <!-- Tabella dettagli vendite -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Prodotto</th>
                <th>Quantità</th>
                <th>Data</th>
                <th>Ricavo (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendite as $v): ?>
                <tr>
                    <td><?= htmlspecialchars($v['prodotto']) ?></td>
                    <td><?= $v['quantita'] ?></td>
                    <td><?= $v['data'] ?></td>
                    <td>€<?= number_format($v['ricavo'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pulsante esporta CSV -->
    <a href="?export=true" class="btn btn-warning mt-3">Scarica CSV</a>
</div>

<script>
    // Inizializza il grafico con Chart.js
    const salesData = <?= json_encode($vendite) ?>;
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: salesData.map(v => v.data),
            datasets: [{
                label: 'Ricavo (€)',
                data: salesData.map(v => parseFloat(v.ricavo)),
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Data' } },
                y: { title: { display: true, text: 'Ricavo (€)' } }
            }
        }
    });
</script>
