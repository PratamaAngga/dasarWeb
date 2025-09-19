<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "Variabel a: {$a} <br>";
echo "Variabel b: {$b} <br>";
echo "Hasil Penjumlahan a dan b: {$hasilTambah} <br>";
echo "Hasil Pengurangan a dan b: {$hasilKurang} <br>";
echo "Hasil Perkalian a dan b: {$hasilKali} <br>";
echo "Hasil Pembagian a dan b: {$hasilBagi} <br>";
echo "Hasil Sisa Bagi a dan b: {$sisaBagi} <br>";
echo "Hasil Pangkat a dan b: {$pangkat} <br> <br>";

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo "Hasil sama dengan: {$hasilSama} <br>";
echo "Hasil tidak sama dengan: {$hasilTidakSama} <br>";
echo "Hasil lebih kecil dari: {$hasilLebihKecil} <br>";
echo "Hasil lebih besar dari: {$hasilLebihBesar} <br>";
echo "Hasil lebih kecil sama dengan: {$hasilLebihKecilSama} <br>";
echo "Hasil lebih besar sama dengan: {$hasilLebihBesarSama} <br> <br>";

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;
echo "Hasil And: {$hasilAnd} <br>";
echo "Hasil Or: {$hasilOr} <br>";
echo "Hasil Not A: {$hasilNotA} <br>";
echo "Hasil Not B: {$hasilNotB} <br><br>";

$a += $b;
echo 'Hasil penjumlahan gabungan $a: ' . $a . '<br>';
$a = 10;
$a -= $b;
echo 'Hasil pengurangan gabungan $a: ' . $a . '<br>';
$a = 10;
$a *= $b;
echo 'Hasil perkalian gabungan $a: ' . $a . '<br>';
$a = 10;
$a /= $b;
echo 'Hasil pembagian gabungan $a: ' . $a . '<br>';
$a = 10;
$a %= $b;
echo 'Hasil modulus gabungan $a: ' . $a . '<br><br>';
$a = 10;

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;
echo "Hasil identik: {$hasilIdentik} <br>";
echo "Hasil tidak identik: {$hasilTidakIdentik} <br>";
?>