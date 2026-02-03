<?php
require_once __DIR__ . '/../cek_login.php';
require_once __DIR__ . '/../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buku Besar - Desa Selokarto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table {
            table-layout: fixed;
        }
        th, td {
            vertical-align: middle;
        }
        .text-right {
            text-align: right;
        }
        .akun-title {
            margin-top: 40px;
            margin-bottom: 10px;
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success mb-4">
    <div class="container">
        <span class="navbar-brand">Buku Besar – Desa Selokarto</span>
    </div>
</nav>

<div class="container">

<?php
$coa = mysqli_query($koneksi, "SELECT * FROM coa ORDER BY kode");

while ($c = mysqli_fetch_assoc($coa)) {

    $detail = mysqli_query($koneksi, "
        SELECT j.tanggal, j.keterangan, d.debit, d.kredit
        FROM jurnal_detail d
        JOIN jurnal j ON j.id = d.jurnal_id
        WHERE d.coa_id = '{$c['id']}'
        ORDER BY j.tanggal
    ");

    if (mysqli_num_rows($detail) == 0) continue;

    $total_debit = 0;
    $total_kredit = 0;
?>

<div class="akun-title">
    <?= $c['kode'] ?> - <?= $c['nama'] ?>
</div>

<div class="table-responsive">
<table class="table table-bordered table-sm bg-white shadow-sm">
    <thead class="table-secondary">
        <tr>
            <th style="width:15%">Tanggal</th>
            <th style="width:45%">Keterangan</th>
            <th style="width:20%" class="text-right">Debit</th>
            <th style="width:20%" class="text-right">Kredit</th>
        </tr>
    </thead>
    <tbody>

<?php while ($d = mysqli_fetch_assoc($detail)) {
    $total_debit += $d['debit'];
    $total_kredit += $d['kredit'];
?>
        <tr>
            <td><?= $d['tanggal'] ?></td>
            <td><?= $d['keterangan'] ?></td>
            <td class="text-right"><?= number_format($d['debit'],0,',','.') ?></td>
            <td class="text-right"><?= number_format($d['kredit'],0,',','.') ?></td>
        </tr>
<?php } ?>

        <tr class="table-light fw-bold">
            <td colspan="2">Total</td>
            <td class="text-right"><?= number_format($total_debit,0,',','.') ?></td>
            <td class="text-right"><?= number_format($total_kredit,0,',','.') ?></td>
        </tr>

    </tbody>
</table>
</div>

<?php } ?>

</div>

</body>
</html>
