<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
  </head>
  <body>
    <nav class="navbar">
      <div class="navbar-container">
        <ul class="navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="product_list.php">Produk</a></li>

          <!-- Admin menu -->
        </ul>

        <a href="#" class="navbar-logo">
          <img src="aset-gambar/DRIPTIQUE.svg" alt="" />
        </a>

        <ul class="navbar-nav">
          <li><a href="about.html">About Us</a></li>
          <li><a href="feedback_form.php">Feedback</a></li>
          <li><a href="#" id="auth-link">Login</a></li>
        </ul>

        <span class="material-symbols-outlined menu-icon" onclick="toggleMenu()"
          >menu</span
        >
      </div>
    </nav>

    <section class="hero">
      <div class="hero-text">
        <h1>STAY DRIPPED, NEVER BROKE.</h1>
        <p>
          Welcome to Driptique—your go-to for curated secondhand gems. Classy,
          conscious, and always on point. Dress smart, shop smarter.
        </p>
      </div>

      <div class="hero-content">
        <img src="aset-gambar/Frame 55.png" alt="" />
        <hr />
        <div class="hero-content-text">
          <p>
            Every fit we drop is more than just a look — it's a fusion of
            fashion history. In one photo, you'll see the legends: the
            structured denim of Levi’s, the sportswear legacy of Nike, the
            preppy elegance of Ralph Lauren, and the edgy vibe of Adidas. We mix
            decades, trends, and energies into a visual that speaks to your
            unique identity. This is thrifting — elevated. Find your next
            statement fit — exclusively on Driptique. The drip’s waiting. Are
            you ready?
          </p>
          <a href="product_list.php" class="hero-content-text-button">
            See Our Produk
            <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </section>

    <footer>
      <div class="footer-container">
        <div class="footer-icons">
          <a href=""><i class="fa-brands fa-facebook"></i></a>
          <a href=""><i class="fa-brands fa-instagram"></i></a>
          <a href=""><i class="fa-brands fa-youtube"></i></a>
        </div>
        <div class="footer-nav">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="produk.html">Produk</a></li>
          </ul>
        </div>
      </div>
    </footer>

    <script>
      // Fungsi untuk toggle menu pada tampilan mobile
      function toggleMenu() {
        document.querySelectorAll(".navbar-nav").forEach((nav) => {
          nav.classList.toggle("show");
        });
      }

      // Cek jika pengguna sudah login dan role mereka
      window.onload = function () {
        const isLoggedIn = localStorage.getItem("isLoggedIn");
        const role = localStorage.getItem("role");
        const authLink = document.getElementById("auth-link");

        if (isLoggedIn === "true") {
          authLink.textContent = "Logout";
          authLink.href = "#";
          authLink.onclick = function () {
            localStorage.removeItem("isLoggedIn");
            localStorage.removeItem("role");
            location.reload(); // Refresh halaman saat logout
          };

          // Menampilkan menu admin jika role adalah admin
          if (role === "admin") {
            document.getElementById("adminMenu").style.display = "block"; // Tampilkan menu admin
          }

          // Menampilkan menu untuk customer jika role adalah customer
          if (role === "customer") {
            document.getElementById("customerMenu").style.display = "block"; // Tampilkan menu customer
          }
        } else {
          authLink.textContent = "Login";
          authLink.href = "login.html";
        }
      };
    </script>
  </body>
</html>
