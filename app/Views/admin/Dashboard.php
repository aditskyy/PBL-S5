<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h2 class="mb-4">Dashboard Admin</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <p class="text-secondary mb-1">Total Jenis Layanan</p>
            <h3><?= $countJenis ?></h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <p class="text-secondary mb-1">Total Loket</p>
            <h3><?= $countLoket ?></h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <p class="text-secondary mb-1">Total Operator</p>
            <h3><?= $countOperator ?></h3>
        </div>
    </div>
</div>

<!-- =============================== -->
<!--      GRAFIK-GRAFIK DASHBOARD    -->
<!-- =============================== -->

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h5 class="mb-3">Total Antrian 7 Hari Terakhir</h5>
            <canvas id="chart7Hari"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h5 class="mb-3">Total Antrian per Loket (Hari Ini)</h5>
            <canvas id="chartPerLoket"></canvas>
        </div>
    </div>
</div>


<!-- =============================== -->
<!--       STATUS LOKET SEBELUMNYA   -->
<!-- =============================== -->

<div class="card shadow-sm">
    <div class="card-header"><b>Status Loket & Antrian Hari Ini</b></div>

    <ul class="list-group list-group-flush">

        <?php foreach ($loketList as $l): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">

            <div>
                <b>Loket <?= $l['nama_loket'] ?></b><br>
                <small>Total Antrian: <b><?= $l['total_antrian'] ?></b></small><br>
                <small>Nomor Terakhir: <b><?= $l['last_nomor'] ?></b></small>
            </div>

            <?php if (($l['status'] ?? 'tutup') === 'buka'): ?>
                <span class="badge bg-success" style="font-size: 20px;">●</span>
            <?php else: ?>
                <span class="badge bg-danger" style="font-size: 20px;">●</span>
            <?php endif; ?>

        </li>
        <?php endforeach; ?>

    </ul>
</div>


<!-- =============================== -->
<!--           CHART.JS              -->
<!-- =============================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // ================================
    // DATA DARI CONTROLLER
    // ================================
    let chartDates   = <?= $chartDates ?>;
    let chartTotals  = <?= $chartTotals ?>;

    let loketNames   = <?= $loketNames ?>;
    let loketTotals  = <?= $loketTotals ?>;


    // ================================
    // GRAFIK 7 HARI TERAKHIR
    // ================================
    new Chart(document.getElementById('chart7Hari'), {
        type: 'line',
        data: {
            labels: chartDates,
            datasets: [{
                label: 'Total Antrian',
                data: chartTotals,
                borderWidth: 2,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.3)',
                tension: 0.3
            }]
        }
    });

    // ================================
    // GRAFIK PER LOKET HARI INI
    // ================================
    new Chart(document.getElementById('chartPerLoket'), {
        type: 'bar',
        data: {
            labels: loketNames,
            datasets: [{
                label: 'Jumlah Antrian',
                data: loketTotals,
                borderWidth: 2,
                backgroundColor: 'rgba(40, 167, 69, 0.5)',
                borderColor: '#28a745'
            }]
        }
    });

</script>

<?= $this->endSection() ?>
