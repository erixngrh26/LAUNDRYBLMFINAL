<?php
require 'database.php'; // Include your database class

$db = new database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addUser '])) {
        // Add user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $db->tambah_data($name, $email, $password, $phone);
        header("Location: index.php"); // Redirect back to the main page
    }

    if (isset($_POST['addOrder'])) {
        // Add order
        $jenis_laundry = $_POST['jenis_laundry'];
        $massa_barang = $_POST['massa_barang'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $waktu_pengambilan = $_POST['waktu_pengambilan'];
 $waktu_pengantaran = $_POST['waktu_pengantaran'];
        $alamat = $_POST['alamat'];
        $catatan = $_POST['catatan'];
        $garis_lintang = $_POST['garis_lintang'];
        $garis_bujur = $_POST['garis_bujur'];
        $harga_total = $_POST['harga_total'];
        $status = $_POST['status'];
        $user_id = $_POST['user_id'];
        $db->tambah_pesanan($jenis_laundry, $massa_barang, $jumlah_barang, $waktu_pengambilan, $waktu_pengantaran, $alamat, $catatan, $garis_lintang, $garis_bujur, $harga_total, $status, $user_id, ''); // Assuming list_satuan is not used
        header("Location: index.php"); // Redirect back to the main page
    }
}
?> ```html
        <section id="viewUsers">
            <h2>View Users</h2>
            <div id="userList">
                <?php
                $users = $db->showData();
                foreach ($users as $user) {
                    echo "<div class='user'>";
                    echo "<p>Name: " . htmlspecialchars($user['name']) . "</p>";
                    echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
                    echo "<p>Phone: " . htmlspecialchars($user['nomor_telepon']) . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>

        <section id="viewOrders">
            <h2>View Orders</h2>
            <div id="orderList">
                <?php
                $orders = $db->showPesanan();
                foreach ($orders as $order) {
                    echo "<div class='order'>";
                    echo "<p>Type: " . htmlspecialchars($order['jenis_laundry']) . "</p>";
                    echo "<p>Weight: " . htmlspecialchars($order['massa_barang']) . "</p>";
                    echo "<p>Quantity: " . htmlspecialchars($order['jumlah_barang']) . "</p>";
                    echo "<p>Pickup Time: " . htmlspecialchars($order['waktu_pengambilan']) . "</p>";
                    echo "<p>Delivery Time: " . htmlspecialchars($order['waktu_pengantaran']) . "</p>";
                    echo "<p>Address: " . htmlspecialchars($order['alamat']) . "</p>";
                    echo "<p>Status: " . htmlspecialchars($order['status_pemesanan']) . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>