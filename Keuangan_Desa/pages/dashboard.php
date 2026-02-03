<?php
require_once __DIR__ . '/../cek_login.php';
require_once __DIR__ . '/../koneksi.php';

/* TOTAL */
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

$aset = totalSaldo('aset', $koneksi);
$pendapatan = totalSaldo('pendapatan', $koneksi);
$beban = totalSaldo('beban', $koneksi);
$laba = $pendapatan - $beban;
?>

<h3>Dashboard Keuangan</h3>
<p><b>Desa Selokarto</b></p>

<div class="row">
    <div class="col-md-3">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h6>Total Aset</h6>
                <h4>Rp <?= number_format($aset,0,',','.') ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h6>Pendapatan</h6>
                <h4>Rp <?= number_format($pendapatan,0,',','.') ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-warning mb-3">
            <div class="card-body">
                <h6>Beban</h6>
                <h4>Rp <?= number_format($beban,0,',','.') ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-info mb-3">
            <div class="card-body">
                <h6>Laba / Rugi</h6>
                <h4>Rp <?= number_format($laba,0,',','.') ?></h4>
            </div>
        </div>
    </div>
</div>

<hr>

<h5>Transaksi Terakhir</h5>
<table class="table table-bordered">
<tr>
    <th>Tanggal</th>
    <th>Keterangan</th>
</tr>

<?php
$q = mysqli_query($koneksi, "
    SELECT * FROM jurnal 
    ORDER BY tanggal DESC 
    LIMIT 5
");
while ($r = mysqli_fetch_assoc($q)) {
?>
<tr>
    <td><?= $r['tanggal'] ?></td>
    <td><?= $r['keterangan'] ?></td>
</tr>
<?php } ?>
</table>
