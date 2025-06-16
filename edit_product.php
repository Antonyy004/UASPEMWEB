<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produk WHERE id = $id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];
    $gambar_produk = $product['gambar_produk']; // Pertahankan gambar lama jika tidak ada gambar baru

    if ($_FILES['gambar_produk']['name'] != '') {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["gambar_produk"]["name"]);
        move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_file);
        $gambar_produk = $_FILES["gambar_produk"]["name"];
    }

    $sql = "UPDATE produk SET 
            nama_produk = '$nama_produk', 
            deskripsi_produk = '$deskripsi_produk', 
            harga_produk = '$harga_produk', 
            stok_produk = '$stok_produk', 
            gambar_produk = '$gambar_produk' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: addproduct.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Produk</h1>
        <form action="edit_product.php?id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $product['nama_produk'] ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="4" required><?= $product['deskripsi_produk'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="harga_produk">Harga Produk</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="<?= $product['harga_produk'] ?>" required>
            </div>
            <div class="form-group">
                <label for="stok_produk">Stok Produk</label>
                <input type="number" class="form-control" id="stok_produk" name="stok_produk" value="<?= $product['stok_produk'] ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar_produk">Gambar Produk</label>
                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk">
                <img src="images/<?= $product['gambar_produk'] ?>" alt="<?= $product['nama_produk'] ?>" style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <button type="submit" class="btn btn-success">Update Produk</button>
        </form>
    </div>
</body>
</html>
