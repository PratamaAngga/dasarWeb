<?php
$students = [
    ["name" => "Alice", "grade" => 85],
    ["name" => "Bob", "grade" => 92],
    ["name" => "Charlie", "grade" => 78],
    ["name" => "David", "grade" => 64],
    ["name" => "Eva", "grade" => 90]
];

$totalScore = 0;
$numberOfStudents = 0;
foreach ($students as $student) {
    $totalScore += $student["grade"];
    $numberOfStudents++;
}

$averageGrade = $totalScore / $numberOfStudents;

echo "Rata-rata nilai kelas adalah: " . number_format($averageGrade, 2) . "<br><br>";

echo "Siswa dengan nilai di atas rata-rata:<br>";
foreach ($students as $student) {
    if ($student["grade"] > $averageGrade) {
        echo "- " . $student["name"] . " (Nilai: " . $student["grade"] . ")<br>";
    }
}
?>