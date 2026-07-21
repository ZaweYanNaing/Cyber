<?php
require_once 'database.php';
require_once 'header.php';
$q1="SELECT COUNT(*) AS total FROM cyber_laws";
$result1 = $conn->query($q1);
$row1 = $result1->fetch_assoc();
$total_laws = $row1['total'];

echo '<h1 class="text-2xl font-bold mb-4">Total Laws: ' . $total_laws . '</h1> ';

$q2="SELECT COUNT(*) AS total FROM crimes";
$result2 = $conn->query($q2);
$row2 = $result2->fetch_assoc();
$total_crimes = $row2['total'];

echo '<h1 class="text-2xl font-bold mb-4">Total Crimes: ' . $total_crimes . '</h1> ';

$q3="SELECT COUNT(*) AS total FROM media";
$result3 = $conn->query($q3);
$row3 = $result3->fetch_assoc();
$total_media = $row3['total'];
echo '<h1 class="text-2xl font-bold mb-4">Total Media: ' . $total_media . '</h1> ';
?>