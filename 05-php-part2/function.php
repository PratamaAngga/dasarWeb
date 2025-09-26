<?php
function perkenalan($nama, $salam) {
    echo $salam. ", ";
    echo "Perkenalkan, nama saya ".$nama."<br/>";
    echo "Senang berkenalan dengan Anda<br/>";
}
perkenalan("Pratama Angga Saputra", "Hallo");
echo"<hr>";
$saya = "Angga";
$ucapanSalam = "Selamat pagi";
perkenalan($saya, $ucapanSalam);
?>