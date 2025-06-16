<?php
include 'db.php';

$sql = "SELECT * FROM produk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styleproduct.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-container">
        <ul class="navbar-nav">
          <li><a href="index.html">Home</a></li>
        </ul>

        <a href="#" class="navbar-logo">
          <img src="aset-gambar/DRIPTIQUE.svg" alt="Logo" />
        </a>

        <ul class="navbar-nav">
          <li><a href="feedback_form.php">Feedback</a></li>
        </ul>

        <span class="material-symbols-outlined menu-icon" onclick="toggleMenu()">menu</span>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-produk">
        <div class="hero-produk-brand">
            <a href=""><img src="aset-gambar/carhartt.png" alt="" /></a>
            <a href=""><img src="aset-gambar/stussy.png" alt="" /></a>
            <a href=""><img src="aset-gambar/tnf.png" alt="" /></a>
            <a href=""><img src="aset-gambar/polo.png" alt="" /></a>
        </div>
    </section>
    <hr class="divider" />
    
    <div class="kontent-title">
        <h1>ALL PRODUCT</h1>
    </div>

    <!-- Produk List -->
    <div class="container mt-5">
        <div class="row">
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/<?= $product['gambar_produk'] ?>" class="card-img-top" alt="<?= $product['nama_produk'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['nama_produk'] ?></h5>
                            <p class="card-text"><?= substr($product['deskripsi_produk'], 0, 100) . '...' ?></p>
                            <p class="card-text"><strong>Harga: Rp<?= number_format($product['harga_produk'], 2) ?></strong></p>
                            <p class="card-text"><strong>Stok: <?= $product['stok_produk'] ?></strong></p>
                            <a href="product_detail.php?id=<?= $product['id'] ?>" class="btn btn-primary btn-block">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      function toggleMenu() {
        document.querySelector(".navbar-nav").classList.toggle("show");
      }
    </script>
</body>
</html>
