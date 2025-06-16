<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root"; 
$password = ""; 
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
