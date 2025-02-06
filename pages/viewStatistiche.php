<?php
$startDate = $_GET['start_date'] ?? date('Y-m-01');
$endDate   = $_GET['end_date']   ?? date('Y-m-d');

$userId = $_SESSION['user_id'];

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

$vendite = [];
$prodottiVenduti = 0;
$ricaviTotali = 0;
$prodottiVendutiCount = [];

while ($row = $result->fetch_assoc()) {
    $vendite[] = $row;
    $prodottiVenduti += $row['quantita'];
    $ricaviTotali += $row['ricavo'];
    if (!isset($prodottiVendutiCount[$row['prodotto']])) {
        $prodottiVendutiCount[$row['prodotto']] = 0;
    }
    $prodottiVendutiCount[$row['prodotto']] += $row['quantita'];
}

$prodottoPiuVenduto = array_keys($prodottiVendutiCount, max($prodottiVendutiCount))[0];
$quantitaPiuVenduta = $prodottiVendutiCount[$prodottoPiuVenduto];

$aggregated = [];
foreach ($vendite as $sale) {
    $prod = $sale['prodotto'];
    if (!isset($aggregated[$prod])) {
        $aggregated[$prod] = 0;
    }
    $aggregated[$prod] += $sale['ricavo'];
}
$aggLabels = array_keys($aggregated);
$aggRevenues = array_values($aggregated);
?>

<div class="container mt-4">
    <h4 class="text-center">Statistiche Vendite</h4>
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
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h4>Prodotto Più Venduto</h4>
                    <p class="fs-3"><?= htmlspecialchars($prodottoPiuVenduto) ?></p>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="mt-4">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Data Inizio:</label>
                <input type="date" id="start_date" class="form-control" name="start_date" value="<?= $startDate ?>">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Data Fine:</label>
                <input type="date" id="end_date" class="form-control" name="end_date" value="<?= $endDate ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtra</button>
            </div>
        </div>
    </form>

    <canvas id="aggChart" class="mt-4"></canvas>

</div>

<script>
const aggLabels = <?= json_encode($aggLabels) ?>;
const aggRevenues = <?= json_encode($aggRevenues) ?>;
const ctxBar = document.getElementById('aggChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: aggLabels,
        datasets: [{
            label: 'Ricavo per Prodotto (€)',
            data: aggRevenues,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Ricavo (€)' }
            },
            x: {
                title: { display: true, text: 'Prodotto' }
            }
        }
    }
});
</script>


