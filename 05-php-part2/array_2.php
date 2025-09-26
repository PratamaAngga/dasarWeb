<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array 2 PHP part 2</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        table, th, td {
            border: 1px solid #333;
        }
        td {
            padding: 8px 12px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        td:first-child {
            font-weight: bold;
            width: 30%;
            background-color: #e0f7fa;
        }
    </style>
</head>
<body>
    <?php
        $Dosen = [
        'nama' => 'Elok Nur Hamdana',
        'domisili' => 'Malang',
        'jenis_kelamin' => 'Perempuan'
    ];

    echo "<table>";
    foreach ($Dosen as $kunci => $nilai) {
        echo "<tr>";
        echo "<td>" . ucwords(str_replace('_', ' ', $kunci)) . "</td>";
        echo "<td>{$nilai}</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>