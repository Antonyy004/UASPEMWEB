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
            background-color: #f4f4f4;
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
            max-width: 800px;
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->


  <!-- Main Sidebar Container -->
  <aside style="background-color: #1f1f3a;" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="aset-gambar/DRIPTIQUE.svg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DRIPTIQUE</span>
    </a>

    <!-- Sidebar -->
    <div style="background-color: #1f1f3a;" class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="indexadmin.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="indexadmin.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Feedback</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="indexadmin.php">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Produk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
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
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
