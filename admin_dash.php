<?php
require_once 'database.php';
$pdo = new Database();

// Periksa apakah parameter 'view' ada
if (isset($_GET['view'])) {
    $viewId = htmlspecialchars($_GET['view'], ENT_QUOTES, 'UTF-8');
    $pemesanan = $pdo->getOrder($viewId);

    // Cek apakah data ditemukan
    if ($pemesanan === false) {
        echo "<h1>Order not found</h1>";
        exit();
    }
} else {
    $pemesanan = null;
}

// Fungsi getOrder
class Database {
    private $pdo;

    public function __construct() {
        $dsn = 'mysql:host=laundrycc.mysql.database.azure.com;dbname=laundrycc;charset=utf8mb4';
        $username = 'laundrycc';
        $password = 'Admin123';

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getOrder($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pesanan WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    
    <?php if ($pemesanan): ?>
        <h2>Detail Pemesanan</h2>
        <p>ID: <?php echo htmlspecialchars($pemesanan['id'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Nama: <?php echo htmlspecialchars($pemesanan['nama'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Alamat: <?php echo htmlspecialchars($pemesanan['alamat'], ENT_QUOTES, 'UTF-8'); ?></p>
    <?php else: ?>
        <p>Tidak ada detail untuk ditampilkan.</p>
    <?php endif; ?>

    <form action="admin_dash.php" method="get">
        <label for="view">Lihat Pesanan:</label>
        <input type="text" name="view" id="view" required>
        <button type="submit">Lihat</button>
    </form>
</body>
</html>
