<?php
session_start();
require_once "database.php";

// Memanggil kelas database
$pdo = new database();
$edit_form = false;
$view_order = false;

if (!isset($_SESSION['email'])) {
    exit("<h1>Access Denied</h1>");
}

if ($_SESSION['email'] != 'admin@laundryonlinemks.com') {
    exit("<h1>Access Denied</h1>");
}

// Memunculkan data customers dan pesanan
$rows = $pdo->showData();
$orders = $pdo->showPesanan();

// Menghapus data
if (isset($_POST['delete'])) {
    if ($_POST['id'] == 1) {
        echo('<div class="alert alert-danger" role="alert">Tidak bisa hapus administrator</div>');
    } else {
        $pdo->deleteData($_POST['id']);
        header("Location: admin_dash.php#customers");
    }
}

// Mengambil data untuk view pesanan
if (isset($_GET['view'])) {
    $pemesanan = $pdo->getOrder($_GET['view']);
    $view_order = true;
}

// Mengupdate status pesanan
if (isset($_POST['update_order'])) {
    $update = $pdo->updateStatus($_POST['status'], $_POST['order_id']);
    header("Location: admin_dash.php#pesanan");
}

// Membatalkan aksi
if (isset($_POST['cancel_update'])) {
    header("Location: admin_dash.php#pesanan");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Laundry OnLine</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/dash.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="bootstrap/jquery.dataTables.min.js"></script>
    <script src="bootstrap/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Laundry OnLine</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#pesanan">Pesanan</a></li>
            <li class="nav-item"><a class="nav-link" href="#customers">Profil Customers</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1>Daftar Pesanan</h1>
    <table id="pagination" class="table table-striped">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Jenis Laundry</th>
                <th>Massa Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id_user'] ?></td>
                    <td><?= $order['jenis_laundry'] ?></td>
                    <td><?= $order['massa_barang'] ?></td>
                    <td><?= $order['jumlah_barang'] ?></td>
                    <td><?= $order['harga_total'] ?></td>
                    <td><?= $order['status_pemesanan'] ?></td>
                    <td>
                        <form method="get" action="admin_dash.php">
                            <input type="hidden" name="view" value="<?= $order['id'] ?>">
                            <button class="btn btn-primary btn-sm" type="submit">View</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($view_order): ?>
        <div class="card mt-4">
            <div class="card-header">Detail Pesanan</div>
            <div class="card-body">
                <ul>
                    <li>ID User: <?= $pemesanan['id_user'] ?></li>
                    <li>Jenis Laundry: <?= $pemesanan['jenis_laundry'] ?></li>
                    <li>Massa Barang: <?= $pemesanan['massa_barang'] ?></li>
                    <li>Jumlah Barang: <?= $pemesanan['jumlah_barang'] ?></li>
                    <li>Harga Total: <?= $pemesanan['harga_total'] ?></li>
                    <li>Status: <?= $pemesanan['status_pemesanan'] ?></li>
                </ul>
                <form method="post">
                    <input type="hidden" name="order_id" value="<?= $pemesanan['id'] ?>">
                    <label for="status">Ubah Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Tunggu Konfirmasi">Tunggu Konfirmasi</option>
                        <option value="Kurir mengambil laundry">Kurir mengambil laundry</option>
                        <option value="Sementara dicuci">Sementara dicuci</option>
                        <option value="Kurir mengantar laundry">Kurir mengantar laundry</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <div class="mt-3">
                        <button class="btn btn-success" type="submit" name="update_order">Update</button>
                        <button class="btn btn-secondary" type="submit" name="cancel_update">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    $('#pagination').DataTable();
});
</script>
</body>
</html>
