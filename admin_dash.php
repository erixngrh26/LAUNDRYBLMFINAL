<?php
session_start();
require_once "database.php";

// Memanggil kelas database
$pdo = new database();
$edit_form = false;
$view_order = false;

// Init
$garisLintang = "";
$garisBujur = "";

// Jika user belum login dan membuka ini, maka langsung diarahkan ke halaman login
if (!isset($_SESSION['email'])) {
    exit("<h1>Access Denied</h1>");
}

// Akses selain e-mail admin akan ditolak
if ($_SESSION['email'] != 'admin@laundryonlinemks.com') {
    exit("<h1>Access Denied</h1>");
}

// Memunculkan data customers
$rows = $pdo->showData();

// Memunculkan data order
$orders = $pdo->showPesanan();

// Menghapus data
if (isset($_POST['delete'])) {
    // Jika tekan hapus admin
    if ($_POST['id'] == 1) {
        echo('<div class="alert alert-danger" role="alert">');
        echo('Tidak bisa hapus administrator');
        echo('</div>');
    } else {
        $pdo->deleteData($_POST['id']);
        header("Location: admin_dash.php#customers");
        exit;
    }
}

// Mengambil data dan menaruh di kotak edit customer
if (isset($_GET['edit'])) {
    $data = $pdo->getData($_GET['edit']);
    $edit_form = true;
    $name = $data['name'];
    $email = $data['email'];
    $nomor_telepon = $data['nomor_telepon'];
    $id = $data['id'];
}

// Mengambil data dan menaruh di kotak view order
if (isset($_GET['view'])) {
    $pemesanan = $pdo->getOrder($_GET['view']);
    $view_order = true;
    $userId = $pemesanan['id_user'];
    $jenisLaundry = $pemesanan['jenis_laundry'];
    $massaBarang = $pemesanan['massa_barang'];
    $jumlahBarang = $pemesanan['jumlah_barang'];
    $waktuPengambilan = $pemesanan['waktu_pengambilan'];
    $waktuPengantaran = $pemesanan['waktu_pengantaran'];
    $alamat = $pemesanan['alamat'];
    $catatan = $pemesanan['catatan'];
    $garisLintang = $pemesanan['garis_lintang'];
    $garisBujur = $pemesanan['garis_bujur'];
    $hargaTotal = $pemesanan['harga_total'];
    $statusPemesanan = $pemesanan['status_pemesanan'];
    $orderId = $pemesanan['id'];
    $listSatuan = $pemesanan['list_satuan'];
}

// Mengupdate data customers
if (isset($_POST['update'])) {
    $update = $pdo->updateData($_POST['nama'], $_POST['email'], $_POST['password'], $_POST['nomor_telepon'], $id);
    header("Location: admin_dash.php#customers");
    exit;
}

// Mengupdate data order
if (isset($_POST['update_order'])) {
    $radio_status = $_POST['status'];
    $update = $pdo->updateStatus($radio_status, $orderId);
    header("Location: admin_dash.php#pesanan");
    exit;
}

// Untuk tombol membatalkan edit
if (isset($_POST['cancel'])) {
    header("Location: admin_dash.php#customers");
    exit;
}

// Untuk tombol membatalkan edit
if (isset($_POST['cancel_update'])) {
    header("Location: admin_dash.php#pesanan");
    exit;
}

// Mengambil jumlah data customers
$banyakdata = $pdo->banyak_data();

// Mengambil jumlah data pesanan
$banyakpesanan = $pdo->banyak_pesanan();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Laundry OnLine</title>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="bootstrap/jquery.dataTables.min.js"></script>
    <script src="bootstrap/dataTables.bootstrap4.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel ```html
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="bootstrap/dataTables.bootstrap4.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav id="navbar-admin" class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="admin_dash.php"><b>Laundry OnLine</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#beranda">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#statistik">Statistik</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#pesanan">Pesanan</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#customers">Profil Customers</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Isi -->
    <div data-spy="scroll" data-target="#navbar-admin" data-offset="0">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 id="beranda" class="display-4">Selamat datang, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
                <br>
                <p class="lead">Anda berada di ruang admin, cek pesanan dan profil pelanggan disini.</p>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">
                <h1 class="tengah" id="statistik">Statistik</h1>
                <p class="tengah">Melihat berapa banyak pesanan dan pelanggan yang terdaftar.</p>
                <br>
                <div class="row">
                    <div class="col-6"><div class="tengah"><h3>Pesanan</h3></div></div>
                    <div class="col-6"><div class="tengah"><h3>Pelanggan</h3></div></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6"><div class="tengah"><img src="images/pesanan.png" width="100px"></div></div>
                    <div class="col-6"><div class="tengah"><img src="images/users.png" width="100px"></div></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6"><div class="tengah"><h5><?php echo htmlspecialchars($banyakpesanan); ?> pesanan</h5></div></div>
                    <div class="col-6"><div class="tengah"><h5><?php echo htmlspecialchars($banyakdata); ?> pelanggan</h5></div></div>
                </div>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid bg-light">
            <div class="container">
                <h1 class="tengah" id="pesanan">Pesanan</h1>
                <p class="tengah">Daftar pesanan dari pelanggan.</p>
                <br>
                <table id="pagination" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID User</th>
                            <th scope="col">Jenis Laundry</th>
                            <th scope="col">List Satuan</th>
                            <th scope="col">Massa Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Harga Total</th>
                            <th scope="col">Status Pemesanan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($order['id_user']); ?></th>
                            <td><?= htmlspecialchars($order[' jenis_laundry']); ?></td>
                            <td><?= htmlspecialchars($order['list_satuan']); ?></td>
                            <td><?= htmlspecialchars($order['massa_barang']); ?></td>
                            <td><?= htmlspecialchars($order['jumlah_barang']); ?></td>
                            <td><?= htmlspecialchars($order['harga_total']); ?></td>
                            <td><?= htmlspecialchars($order['status_pemesanan']); ?></td>
                            <td>
                                <form action="admin_dash.php?view=<?= $order['id']; ?>#pesanan" method="post">
                                    <input type="hidden" name="id" value="<?= $order['id']; ?>">
                                    <input type="submit" value="View" name="view">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br><br>
                <?php if ($view_order): ?>
                    <h4 class="tengah">View Data</h4>
                    <ul>
                        <li>ID User : <?= htmlspecialchars($userId); ?></li><br>
                        <li>Jenis Laundry : <?= htmlspecialchars($jenisLaundry); ?></li><br>
                        <li>List Satuan : <?= htmlspecialchars($listSatuan); ?></li><br>
                        <li>Massa Barang : <?= htmlspecialchars($massaBarang); ?></li><br>
                        <li>Jumlah Barang : <?= htmlspecialchars($jumlahBarang); ?></li><br>
                        <li>Waktu Pengambilan : <?= htmlspecialchars($waktuPengambilan); ?></li><br>
                        <li>Waktu Pengantaran : <?= htmlspecialchars($waktuPengantaran); ?></li><br>
                        <li>Alamat : <?= htmlspecialchars($alamat); ?></li><br>
                        <li>Catatan : <?= htmlspecialchars($catatan); ?></li><br>
                        <li>Harga Total : <?= htmlspecialchars($hargaTotal); ?></li><br>
                        <li>Lokasi : </li><br>
                        <div id="googleMaps" style="width:50%; height:440px; border:solid black 1px;"></div>
                        <br>
                        <form method="post">
                            <li>Status Pemesanan :</li><br>
                            <input type="radio" id="tunggu_konfirmasi" name="status" value="Tunggu Konfirmasi" checked>
                            <label for="tunggu_konfirmasi">Tunggu Konfirmasi</label><br>
                            <input type="radio" id="diambil_kurir" name="status" value="Kurir mengambil laundry">
                            <label for="diambil_kurir">Kurir mengambil laundry</label><br>
                            <input type="radio" id="dicuci" name="status" value="Sementara dicuci">
                            <label for="dicuci">Sementara dicuci</label><br>
                            <input type="radio" id="diantar_kurir" name="status" value="Kurir mengantar laundry">
                            <label for="diantar_kurir">Kurir mengantar laundry</label><br>
                            <input type="radio" id="selesai" name="status" value="Selesai">
                            <label for="selesai">Selesai</label>
                        </ul>
                        <p class="tengah">
                            <input type="submit" name="update_order" value="Update"/>
                            <input type="submit" name="cancel_update" value="Cancel"/>
                        </p>
                        </form>
                    <?php endif; ?>
            </div>
        </div>

        <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">
                <h1 class="tengah" id="customers">Profil Pelanggan</h1>
                <p class="tengah">Daftar pelanggan yang terdaftar.</p>
                <br>
                <table id="pagination2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID User</th>
                            <th scope="col">Nama</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                        <tr>
                            <th><?= htmlspecialchars($row['id']); ?></th>
                            <th><?= htmlspecialchars($row['name']); ?></th>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['nomor_telepon']); ?></td>
                            <td>
                                <form action="admin_dash.php?edit=<?= $ row['id']; ?>#customers" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <input type="submit" value="Edit" name="edit">
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <input type="submit" value="Delete" name="delete">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <?php if ($edit_form): ?>
                <h4 class="tengah">Edit customer</h4>
                <form method="post">
                    <p class="tengah">Nama : </p>
                    <p class="tengah"><input type="text" class="tengah" name="nama" value="<?= htmlspecialchars($name); ?>"></p>
                    <p class="tengah">E-mail : </p>
                    <p class="tengah"><input type="email" class="tengah" name="email" value="<?= htmlspecialchars($email); ?>"></p>
                    <p class="tengah">Password : </p>
                    <p class="tengah"><input type="password" class="tengah" name="password" id="password"></p>
                    <p class="tengah"><input type="checkbox" onclick="myFunction()"> Show Password</p>
                    <p class="tengah">Nomor Telepon : </p>
                    <p class="tengah"><input type="text" class="tengah" name="nomor_telepon" value="<?= htmlspecialchars($nomor_telepon); ?>"></p>
                    <p class="tengah"><input type="submit" name="update" value="Update"/>
                    <input type="submit" name="cancel" value="Cancel"/></p>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3 bg-dark text-white">© 2024 Copyright:
            <a href="https://sae.com/"> Laundry OnLine</a>
        </div>
    </footer>

    <script>
        // Menggunakan library DataTables
        $(document).ready(function() {
            $('#pagination').DataTable();
            $('#pagination2').DataTable();
        });

        // Memunculkan password
        function myFunction() {
            var x = document.getElementById("password");
            x.type = (x.type === "password") ? "text" : "password";
        }

        // fungsi initialize untuk mempersiapkan peta
        function initMap() {
            var propertiPeta = {
                center: new google.maps.LatLng(<?= htmlspecialchars($garisLintang); ?>, <?= htmlspecialchars($garisBujur); ?>),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(<?= htmlspecialchars($garisLintang); ?>, <?= htmlspecialchars($garisBujur); ?>),
                map: peta,
                animation: google.maps.Animation.BOUNCE
            });
        }
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</body>
</html>
