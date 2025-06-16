<?php
include 'db.php';

// Mengecek apakah ada parameter 'id' dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus produk berdasarkan ID
    $sql = "DELETE FROM produk WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Setelah produk berhasil dihapus, kembali ke halaman yang sama (add_product.php)
        header("Location: addproduct.php"); // Redirect ke halaman yang sama
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

