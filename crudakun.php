<?php
include 'db.php';

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT); // Hash password

$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Admin berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan admin: " . $conn->error;
}
?>
