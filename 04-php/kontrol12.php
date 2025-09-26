<?php
$hargaProduk = 120000;
$persentaseDiskon = 0.20;
$syaratDiskon = 100000;

if ($hargaProduk > $syaratDiskon) {
    $jumlahDiskon = $hargaProduk * $persentaseDiskon;
    $hargaAkhir = $hargaProduk - $jumlahDiskon;
    echo "Selamat! Anda mendapatkan diskon sebesar Rp " . number_format($jumlahDiskon, 0, ',', '.') . ".<br>";
    echo "Harga yang harus dibayar adalah Rp " . number_format($hargaAkhir, 0, ',', '.');
} else {
    echo "Harga produk tidak memenuhi syarat untuk mendapatkan diskon.<br>";
    echo "Harga yang harus dibayar adalah Rp " . number_format($hargaProduk, 0, ',', '.');
}
?>