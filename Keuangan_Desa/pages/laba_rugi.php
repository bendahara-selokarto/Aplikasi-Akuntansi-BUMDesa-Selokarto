<?php
require_once __DIR__ . '/../cek_login.php';
require_once __DIR__ . '/../koneksi.php';

function totalPendapatan($koneksi) {
    $q = mysqli_query($koneksi, "
        SELECT SUM(d.kredit - d.debit) AS total
        FROM jurnal_detail d
        JOIN coa c ON c.id = d.coa_id
        WHERE c.jenis = 'pendapatan'
    ");
    $r = mysqli_fetch_assoc($q);
    return $r['total'] ?? 0;
}

function totalBeban($koneksi) {
    $q = mysqli_query($koneksi, "
        SELECT SUM(d.debit - d.kredit) AS total
        FROM jurnal_detail d
        JOIN coa c ON c.id = d.coa_id
        WHERE c.jenis = 'beban'
    ");
    $r = mysqli_fetch_assoc($q);
    return $r['total'] ?? 0;
}

$pendapatan = totalPendapatan($koneksi);
$beban = totalBeban($koneksi);
$laba = $pendapatan - $beban;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Laba Rugi - Desa Selokarto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .text-right {
            text-align: right;
        }
    </style>
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-success mb-4">
    <div class="container">
        <span class="navbar-brand">Laporan Laba Rugi – Desa Selokarto</span>
    </div>
</nav>

<div class="container">

<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead class="table-secondary">
                <tr>
                    <th>Keterangan</th>
                    <th class="text-right">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Pendapatan</td>
                    <td class="text-right"><?= number_format($pendapatan,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>Total Beban</td>
                    <td class="text-right"><?= number_format($beban,0,',','.') ?></td>
                </tr>
                <tr class="table-success fw-bold">
                    <td>Laba / Rugi</td>
                    <td class="text-right"><?= number_format($laba,0,',','.') ?></td>
                </tr>
            </tbody>
        </table>
        </div>

    </div>
</div>

</div>
</body>
</html>
