<?php
require_once __DIR__ . '/../cek_login.php';
require_once __DIR__ . '/../koneksi.php';

/* TOTAL SALDO PER JENIS AKUN */
function totalSaldo($jenis, $koneksi) {
    $q = mysqli_query($koneksi, "
        SELECT SUM(
            CASE 
                WHEN '$jenis' IN ('aset','beban') 
                THEN d.debit - d.kredit
                ELSE d.kredit - d.debit
            END
        ) AS total
        FROM jurnal_detail d
        JOIN coa c ON c.id = d.coa_id
        WHERE c.jenis = '$jenis'
    ");
    $r = mysqli_fetch_assoc($q);
    return $r['total'] ?? 0;
}

/* LABA / RUGI */
$pendapatan = totalSaldo('pendapatan', $koneksi);
$beban = totalSaldo('beban', $koneksi);
$laba = $pendapatan - $beban;

/* TOTAL */
$aset = totalSaldo('aset', $koneksi);
$kewajiban = totalSaldo('kewajiban', $koneksi);
$modal = totalSaldo('modal', $koneksi) + $laba;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Neraca - Desa Selokarto</title>
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
        <span class="navbar-brand">Neraca – Desa Selokarto</span>
    </div>
</nav>

<div class="container">

<div class="row">

<!-- ASET -->
<div class="col-md-6">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="mb-3">Aset</h6>
            <table class="table table-bordered table-sm">
                <tbody>
                <?php
                $aset_detail = mysqli_query($koneksi, "
                    SELECT c.nama,
                           SUM(d.debit - d.kredit) AS saldo
                    FROM jurnal_detail d
                    JOIN coa c ON c.id = d.coa_id
                    WHERE c.jenis = 'aset'
                    GROUP BY c.id
                ");
                while ($a = mysqli_fetch_assoc($aset_detail)) {
                ?>
                    <tr>
                        <td><?= $a['nama'] ?></td>
                        <td class="text-right"><?= number_format($a['saldo'],0,',','.') ?></td>
                    </tr>
                <?php } ?>
                    <tr class="table-secondary fw-bold">
                        <td>Total Aset</td>
                        <td class="text-right"><?= number_format($aset,0,',','.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- KEWAJIBAN & MODAL -->
<div class="col-md-6">

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="mb-3">Kewajiban</h6>
            <table class="table table-bordered table-sm">
                <tbody>
                <?php
                $kewajiban_detail = mysqli_query($koneksi, "
                    SELECT c.nama,
                           SUM(d.kredit - d.debit) AS saldo
                    FROM jurnal_detail d
                    JOIN coa c ON c.id = d.coa_id
                    WHERE c.jenis = 'kewajiban'
                    GROUP BY c.id
                ");
                while ($k = mysqli_fetch_assoc($kewajiban_detail)) {
                ?>
                    <tr>
                        <td><?= $k['nama'] ?></td>
                        <td class="text-right"><?= number_format($k['saldo'],0,',','.') ?></td>
                    </tr>
                <?php } ?>
                    <tr class="table-secondary fw-bold">
                        <td>Total Kewajiban</td>
                        <td class="text-right"><?= number_format($kewajiban,0,',','.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h6 class="mb-3">Modal</h6>
            <table class="table table-bordered table-sm">
                <tbody>
                <?php
                $modal_detail = mysqli_query($koneksi, "
                    SELECT c.nama,
                           SUM(d.kredit - d.debit) AS saldo
                    FROM jurnal_detail d
                    JOIN coa c ON c.id = d.coa_id
                    WHERE c.jenis = 'modal'
                    GROUP BY c.id
                ");
                while ($m = mysqli_fetch_assoc($modal_detail)) {
                ?>
                    <tr>
                        <td><?= $m['nama'] ?></td>
                        <td class="text-right"><?= number_format($m['saldo'],0,',','.') ?></td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td>Laba / Rugi Berjalan</td>
                        <td class="text-right"><?= number_format($laba,0,',','.') ?></td>
                    </tr>
                    <tr class="table-success fw-bold">
                        <td>Total Modal</td>
                        <td class="text-right"><?= number_format($modal,0,',','.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

</div>

</div>
</body>
</html>
