USE laundry;

-- Tabel users
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) DEFAULT NULL,
  `email` VARCHAR(128) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `nomor_telepon` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- Tabel orders
CREATE TABLE `orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `jenis_laundry` VARCHAR(8) DEFAULT NULL,
  `massa_barang` INT(3) DEFAULT NULL,
  `jumlah_barang` INT(3) DEFAULT NULL,
  `waktu_pengambilan` DATE DEFAULT NULL,
  `waktu_pengantaran` DATE DEFAULT NULL,
  `alamat` VARCHAR(80) DEFAULT NULL,
  `catatan` VARCHAR(255) DEFAULT NULL,
  `garis_lintang` DECIMAL(10,6) DEFAULT NULL,
  `garis_bujur` DECIMAL(10,6) DEFAULT NULL,
  `harga_total` INT(10) DEFAULT NULL,
  `status_pemesanan` VARCHAR(50) DEFAULT NULL,
  `id_user` INT(11) DEFAULT NULL,
  `list_satuan` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- Tabel harga
CREATE TABLE `harga` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` VARCHAR(30) DEFAULT NULL,
  `harga` DECIMAL(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- Tambah data ke tabel users
INSERT INTO users (name, email, password, nomor_telepon) 
VALUES ("Administrator", "admin@laundryonlinemks.com", "$2y$10$3ZovOOjFDvk4eain7/XFFuAfVLt9.zOyFM/FK8NC/2KHmA0Zk5O6W", "081242133333");

-- Tambah data ke tabel harga
INSERT INTO `harga` (id, nama_barang, harga) VALUES (1, "Kaos/T-Shirt", 10000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (2, "Kemeja", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (3, "Kemeja Batik", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (4, "Baju Muslim", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (5, "Kebaya", 40000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (6, "Gaun Panjang", 25000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (7, "Rok", 15000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (8, "Baju Hangat/Sweater", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (9, "Jaket", 30000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (10, "Jas/Blazer", 45000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (11, "Celana Pendek", 10000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (12, "Celana Panjang", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (13, "Sarung", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (14, "Tas Sekolah/Ransel", 30000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (15, "Selendang/Kerudung", 10000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (16, "Blouse", 15000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (17, "Mukena", 25000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (18, "Sajadah", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (19, "Topi", 10000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (20, "Handuk Mandi", 25000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (21, "Bantal", 20000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (22, "Sarung Bantal/Guling", 5000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (23, "Sprei Single", 15000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (24, "Selimut", 25000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (25, "Bed Cover", 60000.00);
INSERT INTO `harga` (id, nama_barang, harga) VALUES (26, "Keset", 20000.00);
