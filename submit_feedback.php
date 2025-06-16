<?php

$host = "localhost";
$user = "root";        
$password = "";        
$dbname = "driptique";

$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


$sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "Feedback berhasil dikirim!";
} else {
    echo "Gagal mengirim feedback: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
