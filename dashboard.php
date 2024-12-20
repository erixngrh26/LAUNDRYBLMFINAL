<?php
session_start();
require_once "database.php";
$pdo = new database();
$edit_form = false;

// Jika user belum login, redirect ke halaman login
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Jika admin login, redirect ke halaman dashboard admin
if ($_SESSION['email'] == 'admin@laundryonlinemks.com') {
    header('Location: admin_dash.php');
    exit();
}

// Memanggil tabel pesanan
$rows = $pdo->getPesanan($_SESSION['id']);
if (!$rows) {
    $rows = [];
}

// Mengambil data untuk edit
if (isset($_GET['edit'])) {
    $data = $pdo->getEditPesanan($_GET['edit']);
    if (!$data) {
        die("Data pesanan tidak ditemukan.");
    }
    $edit_form = true;
    $name = $data['name'];
    $email = $data['email'];
    $nomor_telepon = $data['nomor_telepon'];
    $id = $data['id'];
}

// Mengupdate data
if (isset($_POST['update'])) {
    $id = $_SESSION['id'];
    $update = $pdo->updateData($_POST['nama'], $_POST['email'], $_POST['password'], $_POST['nomor_telepon'], $id);
    $_SESSION['name'] = $_POST['nama'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['nomortelepon'] = $_POST['nomor_telepon'];
    header("Location: dashboard.php#profil");
    exit();
}

// Membatalkan edit
if (isset($_POST['cancel'])) {
    header("Location: dashboard.php#profil");
    exit();
}
?>
