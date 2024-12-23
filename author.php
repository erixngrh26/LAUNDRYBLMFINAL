<?php
// about_team.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About the Team - Laundry OnLine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #004aad;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        ul li {
            margin-bottom: 10px;
        }
        .website-info {
            margin-bottom: 30px;
        }
        .hero-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .profile-section {
            margin-top: 30px;
        }
        .profile {
            margin-bottom: 20px;
        }
        .profile-info {
            text-align: left;
        }
        .profile-info p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #666;
        }
        .back-to-dashboard {
            display: block;
            width: 150px;
            margin: 20px auto 30px;
            text-align: center;
            padding: 10px;
            background-color: #004aad;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .back-to-dashboard:hover {
            background-color: #00328d;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Back to Dashboard Button -->
        <a href="index.php">KEMBALIKAN SAJA</a> 

        <!-- Hero Image -->
        <img src="images/teamgjls.png" alt="Team Hero Image" class="hero-image">

        <!-- Section: About the Website -->
        <div class="website-info">
            <h2>Website Laundry Antar Jemput</h2>
            <p>
                Website laundry antar jemput adalah platform digital yang dirancang untuk mempermudah pelanggan dalam mendapatkan layanan laundry berkualitas tanpa harus keluar rumah. Dengan layanan ini, pelanggan dapat memesan jasa laundry, mengatur penjemputan, dan pengantaran pakaian bersih dengan cepat dan praktis melalui perangkat mereka.
            </p>
            <p>
                Fitur Utama:
            </p>
            <ul>
                <li><strong>Pemesan Layanan:</strong> Pelanggan dapat memesan layanan laundry langsung dari website dengan mengisi formulir online yang mudah digunakan.</li>
                <li><strong>Jadwal Penjemputan & Pengantaran:</strong> Pelanggan dapat memilih waktu penjemputan dan pengantaran pakaian sesuai dengan kebutuhan mereka.</li>
                <li><strong>Pelacakan Pesanan:</strong> Fitur ini memungkinkan pelanggan untuk melacak status pesanan mereka secara real-time, mulai dari proses pencucian hingga pengantaran.</li>
                <li><strong>Daftar Layanan & Harga:</strong> Website menampilkan berbagai pilihan layanan, seperti cuci kering, cuci lipat, dan setrika, lengkap dengan informasi harga yang transparan.</li>
            </ul>
            <p>
                Website ini cocok untuk pelanggan yang memiliki jadwal padat atau kesulitan mengakses layanan laundry tradisional. Dengan desain yang user-friendly dan layanan yang andal, website ini memberikan solusi modern untuk kebutuhan laundry harian.
            </p>
        </div>

        <!-- Section: Developer Profiles -->
        <div class="profile-section">
            <h2>Meet the Developers</h2>

            <div class="profile">
                <div class="profile-info">
                    <p><strong>Name:</strong> Hadar S.</p>
                    <p><strong>Role:</strong> Frontend Developer</p>
                    <p><strong>Email:</strong> hasara@gmail.com</p>
                </div>
            </div>

            <div class="profile">
                <div class="profile-info">
                    <p><strong>Name:</strong> Hamid A.A</p>
                    <p><strong>Role:</strong> Backend Developer</p>
                    <p><strong>Email:</strong> HAzhar@yahoo.com</p>
                </div>
            </div>

            <div class="profile">
                <div class="profile-info">
                    <p><strong>Name:</strong> E Ngrh</p>
                    <p><strong>Role:</strong> Backend Developer</p>
                    <p><strong>Email:</strong> Erixngrh@gmail.com</p>
                </div>
            </div>

            <div class="profile">
                <div class="profile-info">
                    <p><strong>Name:</strong> Y Pangestu</p>
                    <p><strong>Role:</strong> Editor & UI/UX Designer</p>
                    <p><strong>Email:</strong> YPanges@students.com</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="page-footer font-small blue">
            <div class="footer-copyright text-center py-3 bg-dark text-white">© 2024 Copyright:
                <a href="https://sae.com/"> LONDO > Laundry OnLine by SAEY</a>
            </div>
        </footer>
    </div>
</body>
</html>
