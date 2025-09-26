<?php
$poin = 650;

if ($poin > 500) {
    $hadiahTambahan = "YES";
} else {
    $hadiahTambahan = "NO";
}

echo "Player's total score is: " . $poin . "<br>";
echo "Do players get additional rewards? " . $hadiahTambahan;
?>