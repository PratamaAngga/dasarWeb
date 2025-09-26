<?php
$grades = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
sort($grades);
$filteredGrades = array_slice($grades, 2, -2);
$totalScore = 0;
foreach ($filteredGrades as $grade) {
    $totalScore += $grade;
}
$numberOfStudents = count($filteredGrades);
$averageScore = $totalScore / $numberOfStudents;
echo "Nilai yang digunakan untuk perhitungan: " . implode(", ", $filteredGrades) . "<br>";
echo "Total nilai: " . $totalScore . "<br>";
echo "Rata-rata nilai: " . $averageScore;
?>