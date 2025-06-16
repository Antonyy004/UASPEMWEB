<?php
include 'db.php'; // Pastikan koneksi ke database sudah benar

// Username dan password untuk admin pertama kali
$username = 'admin';
$password = 'admin123'; // Password awal

// Meng-hash password sebelum disimpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // PASSWORD_DEFAULT akan memilih algoritma terbaik secara otomatis

// Query untuk menambah admin ke database
$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password); // Menyisipkan username dan password yang sudah di-hash
$stmt->execute();
echo "Admin berhasil ditambahkan!";
?>
