<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h2>Dashboard Admin</h2>
    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>Total Jenis Layanan</h5>
                <h2><?= $countJenis ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>Total Loket</h5>
                <h2><?= $countLoket ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>Total Operator</h5>
                <h2><?= $countOperator ?></h2>
            </div>
        </div>
    </div>

</body>
</html>
