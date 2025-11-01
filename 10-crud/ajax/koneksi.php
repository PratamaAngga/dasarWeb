<?php
define('HOST', 'localhost');
define('USER', 'postgres');
define('PASS', '12345678');
define('DB1', 'prakwebdb');
define('PORT', '5433');

$db1 = new PDO("pgsql:host=". HOST . ";port=". PORT . ";dbname=". DB1, USER, PASS);
$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>