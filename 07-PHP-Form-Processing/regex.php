<?php
$pattern = '/[a-z]/';
$text = 'This is a Sample Text';
if (preg_match($pattern, $text)) {
    echo "Huruf kecil ditemukan!";
} else {
    echo "Tidak ada huruf kecil!";
}

echo "<br><br>";
$pattern1 = '/[0-9]+/';
$text1 = 'There are 123 apples.';
if (preg_match($pattern1, $text1, $matches)) {
    echo "Cocokkan: " . $matches[0];
} else {
    echo "Tidak ada yang cocok!";
}

echo "<br><br>";
$pattern3 = '/apple/';
$replacement = 'banana';
$text3 = 'I like apple pie.';
$new_text = preg_replace($pattern3, $replacement, $text3);
echo $new_text;

echo "<br><br>";
$pattern4 =  '/go{2,4}d/'; // Cocokkan "god", "good", "goood", dll.
$text4 = 'god is good.';
if (preg_match($pattern4, $text4, $matches)) {
    echo "Cocokkan: " . $matches[0];
} else {
    echo "Tidak ada yang cocok!";
}

?>