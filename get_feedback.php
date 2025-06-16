<?php
header('Content-Type: application/json');

$host = "db.be-mons1.bengt.wasmernet.com";
$user = "fb9121307be1800039fdb16809e8"; 
$password = "0684fb91-2130-7d19-8000-ff6aacfda562"; 
$dbname = "driptique";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  echo json_encode([]);
  exit;
}

$sql = "SELECT name, email, message FROM feedback ORDER BY id DESC";
$result = $conn->query($sql);

$feedbacks = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
  }
}

echo json_encode($feedbacks);

$conn->close();
?>
