<?php
// Koneksi ke database
$conn = new mysqli("db.be-mons1.bengt.wasmernet.com", "fb9121307be1800039fdb16809e8", "0684fb91-2130-7d19-8000-ff6aacfda562", "db_uas");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $feedback = $_POST["feedback"];

    // Insert feedback ke database
    $sql = "INSERT INTO feedbacks (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman yang sama setelah sukses agar form tidak ter-submit lagi saat refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Ambil data feedback
$result = $conn->query("SELECT * FROM feedbacks");

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <style>

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1f1f3a;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #003366;
        }

        .success {
            color: green;
            text-align: center;
            font-size: 16px;
        }

        .error {
            color: red;
            text-align: center;
            font-size: 16px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .feedback-item {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
            margin-bottom: 20px;
        }

        .feedback-item h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .feedback-item p {
            margin: 10px 0;
            color: #555;
        }

        .admin-reply {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .admin-reply h4 {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .admin-reply p {
            color: #555;
        }
    </style>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback - Thrift Shop</title>
    <link rel="stylesheet" href="stylefeedback.css" />
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
        </ul>

        <a href="index.php" class="navbar-logo"
          ><img src="aset-gambar/DRIPTIQUE.svg" alt=""
        /></a>

        <ul class="navbar-nav">
        </ul>
        <span class="material-symbols-outlined menu-icon" onclick="toggleMenu()"
          >menu</span
        >
      </div>
    </nav>

    <div class="container">
        <h2>Feedback Form</h2>
        <form method="POST" action="feedback_form.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="container">
    <h2>Admin Replies</h2>

    <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="feedback-item">
        <h3>Feedback from: <?php echo $row['name']; ?> (<?php echo $row['email']; ?>)</h3>
        <p><?php echo nl2br($row['feedback']); ?></p>

        <div class="admin-reply">
          <h4>Admin Reply:</h4>
          <?php
          $feedback_id = $row['id'];
          $conn = new mysqli("db.be-mons1.bengt.wasmernet.com", "fb9121307be1800039fdb16809e8", "0684fb91-2130-7d19-8000-ff6aacfda562", "db_uas");
          $reply_result = $conn->query("SELECT * FROM admin_replies WHERE feedback_id = $feedback_id");

          if ($reply_result->num_rows > 0) {
              $reply = $reply_result->fetch_assoc();
              ?>
              <p><?php echo nl2br($reply['reply']); ?></p>
          <?php
          } else {
              echo "<p>No reply yet.</p>";
          }
          ?>
        </div>
      </div>
    <?php } ?>
  </div>

    <script src="js/script.js"></script>
    <script>
      function toggleMenu() {
        document.querySelectorAll(".navbar-nav").forEach((nav) => {
          nav.classList.toggle("show");
        });
      }
    </script>
  </body>
</html>
