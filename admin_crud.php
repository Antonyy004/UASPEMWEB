<?php
session_start();
include 'db.php';

// Arahkan ke halaman login jika belum login

if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Menambahkan akun admin baru
    $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
}

if (isset($_GET['delete'])) {
    $admin_id = $_GET['delete'];

    // Menghapus akun admin
    $sql = "DELETE FROM admins WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
}

if (isset($_GET['edit'])) {
    $admin_id = $_GET['edit'];
    $sql = "SELECT * FROM admins WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $admin_id = $_POST['admin_id'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Memperbarui akun admin
    $sql = "UPDATE admins SET username = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $password, $admin_id);
    $stmt->execute();
    header('Location: admin_crud.php');
}

$sql = "SELECT * FROM admins";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Admin</title>
    <style>
        body {
            background-color: #1f1f3a;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .admin-container {
            background-color: #fff;
            color: #1f1f3a;
            padding: 40px;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .admin-container h2, .admin-container h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .admin-container label {
            font-size: 16px;
        }

        .admin-container input[type="text"], .admin-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #1f1f3a;
            border-radius: 4px;
        }

        .admin-container button {
            width: 100%;
            padding: 10px;
            background-color: #1f1f3a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .admin-container button:hover {
            background-color: #3a3a59;
        }

        .admin-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .admin-container th, .admin-container td {
            padding: 10px;
            text-align: left;
            border: 1px solid #1f1f3a;
        }

        .admin-container a {
            color: #1f1f3a;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            background-color: #f0f0f0;
        }

        .admin-container a:hover {
            background-color: #d1d1d1;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>CRUD Admin</h2>

        <!-- Membuat admin baru -->
        <form method="POST">
            <h3>Buat Admin</h3>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit" name="create">Buat Admin</button>
        </form>

        <!-- Edit admin -->
        <?php if (isset($admin)): ?>
            <form method="POST">
                <h3>Edit Admin</h3>
                <input type="hidden" name="admin_id" value="<?= $admin['id'] ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= $admin['username'] ?>" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <button type="submit" name="update">Perbarui Admin</button>
            </form>
        <?php endif; ?>

        <h3>Kelola Akun Admin</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
            <?php while ($admin = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $admin['id'] ?></td>
                    <td><?= $admin['username'] ?></td>
                    <td>******</td> <!-- Menampilkan tanda bintang untuk password -->
                    <td>
                        <a href="admin_crud.php?edit=<?= $admin['id'] ?>">Edit</a> |
                        <a href="admin_crud.php?delete=<?= $admin['id'] ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
