<?php
$totalKursi = 45;
$kursiDitempati = 28;
$kursiKosong = $totalKursi - $kursiDitempati;
$persentaseKursiKosong = ($kursiKosong / $totalKursi) * 100;
echo "Total Kursi: " . $totalKursi . "<br>";
echo "Kursi Ditempati: " . $kursiDitempati . "<br>";
echo "Kursi Kosong: " . $kursiKosong . "<br>";
echo "Persentase Kursi Kosong: " . number_format($persentaseKursiKosong, 2) . "%";
?>