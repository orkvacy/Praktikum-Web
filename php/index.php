<?php
session_start(); // Wajib ada di baris paling atas untuk menggunakan session
include 'koneksi.php'; // Hubungkan ke database
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pesan tiket pesawat, hotel, paket tour, dan cruise dengan penawaran terbaik. Rencanakan liburan impian Anda bersama kami.">
    <meta name="keywords" content="tour, travel, cruise, hotel, tiket pesawat, visa, promo">
    <title>KroTravel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body data-is-logged-in="<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>">

    <header>
        <div class="headerContainer">
            <h1 class="logo"><a href="#">KroTravel</a></h1>
            <nav>
                <ul class="mainNav">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#promoSection">Paket Tour</a></li>
                    <li><a href="#">Hotel</a></li>
                    <li><a href="#">Tiket Pesawat</a></li>
                    
                    <?php if (isset($_SESSION['username'])): ?>
                        
                        <?php?>
                        <?php if ($_SESSION['username'] === 'admin'): ?>
                            <li><a href="dashboard.php" class="actionButton">Dashboard</a></li>
                        <?php endif; ?>

                        <?php?>
                        <li><a href="logout.php" class="actionButton">Logout</a></li>

                    <?php else: ?>
                        <?php?>
                        <li><a href="login.php" class="actionButton">Login</a></li>
                    <?php endif; ?>

                    <li>
                        <div class="darkModeContainer">
                            <label class="darkModeSwitch">
                                <input type="checkbox" id="darkModeToggle">
                                <span class="slider"></span>
                            </label>
                            <span id="darkModeLabel">Dark</span>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="heroSection">
            <div class="heroContent">
                <h2>Cape dengan Kaderisasi? Mari Rencanakan Liburan Anda</h2>
                <p>Luapkan emosi Anda dengan cara berjalan-jalan</p>
                <div id="heroForm">
                    <form id="searchForm">
                        <input type="text" id="tujuan" name="tujuan" placeholder="Contoh: Jepang, India" required>
                        <input type="date" id="tanggal" name="tanggal" required>
                        <button type="submit" class="actionButton">Cari Paket</button>
                    </form>
                </div>
            </div>
        </section>

        <div class="mainContainer">
            <section id="promoSection">
                <h2>Special For You</h2>
                <div class="tableWrapper">
                    <table class="promoTable">
                        <thead>
                            <tr>
                                <th>Paket Tour</th>
                                <th>Destinasi</th>
                                <th>Harga</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM paket_tour ORDER BY id DESC LIMIT 3";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td style="font-weight: bold;"><?php echo htmlspecialchars($row['nama_paket']); ?></td>
                                <td><?php echo htmlspecialchars($row['destinasi']); ?></td>
                                <td>
                                    <s>Rp <?php echo number_format($row['harga_normal'], 0, ',', '.'); ?></s><br>
                                    <strong>Rp <?php echo number_format($row['harga_promo'], 0, ',', '.'); ?></strong>
                                </td>
                                <td><a href="#" class="actionButton detailButton">Lihat Detail</a></td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='4' style='text-align:center;'>Promo tidak tersedia saat ini.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="destinationSection">
                <h2>Destinasi Favorit</h2>
                <div class="gridContainer">
                    <div class="infoCard">
                        <img src="pic/eropa.png" alt="Benua Eropa">
                        <div class="cardContent">
                            <h3>Eropa</h3>
                            <p>Swiss, Italia, Prancis, Belanda</p>
                        </div>
                    </div>
                    <div class="infoCard">
                        <img src="pic/asia.png" alt="Benua Asia">
                        <div class="cardContent">
                            <h3>Asia Timur</h3>
                            <p>Jepang, Korea Selatan, China</p>
                        </div>
                    </div>
                    <div class="infoCard">
                        <img src="pic/amerika.png" alt="Benua Amerika">
                        <div class="cardContent">
                            <h3>Amerika</h3>
                            <p>USA West Coast, Kanada</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="testimonialSection">
                <h2>Testimoni dari Pelanggan Kami</h2>
                <div class="gridContainer">
                    <div class="infoCard testimonialCard">
                        <div class="cardContent">
                            <blockquote>"Asik banget, saya jadi pengen ke korea lagi"</blockquote>
                            <p>- Dapoy<br><em>Peserta Tour Korea Selatan</em></p>
                        </div>
                    </div>
                    <div class="infoCard testimonialCard">
                        <div class="cardContent">
                            <blockquote>"Sebagai solo traveler, awalnya saya ragu. Tapi tim KroTravel membuat semuanya mudah dan aman"</blockquote>
                            <p>- Jojo Santoso<br><em>Peserta Tour Turki</em></p>
                        </div>
                    </div>
                    <div class="infoCard testimonialCard">
                        <div class="cardContent">
                            <blockquote>"Proses pemesanan sangat mudah dan tim customer service responsif. Semua pertanyaan saya dijawab dengan cepat."</blockquote>
                            <p>- Sifu<br><em>Peserta Tour Singapura & Cruise</em></p>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="inspirationSection">
                <h2>Inspirasi Liburan Untuk Anda</h2>
                <article>
                    <a href="#">
                        <img src="pic/foodJepang.png" alt="Makanan Jepang">
                    </a>
                    <div>
                        <a href="#">
                            <h3>10 Makanan Wajib Coba Saat Berlibur ke Jepang</h3>
                        </a>
                        <p>Jepang bukan hanya tentang sushi. Temukan ragam kuliner otentik yang akan memanjakan lidah Anda...</p>
                        <a href="#" class="actionButton">Baca Selengkapnya</a>
                    </div>
                </article>
                <article>
                    <a href="#">
                        <img src="pic/eropa.png" alt="Musim Dingin di Eropa" style="object-position: left;">
                    </a>
                    <div>
                        <a href="#">
                            <h3>Tips Packing Cerdas Untuk Liburan Musim Dingin di Eropa</h3>
                        </a>
                        <p>Jangan sampai salah kostum! Simak tips berikut agar liburan musim dingin Anda tetap hangat dan nyaman...</p>
                        <a href="#" class="actionButton">Baca Selengkapnya</a>
                    </div>
                </article>
            </section>
        </div>
    </main>

    <footer>
        <div class="mainContainer">
            <h3>KroTravel Head Office</h3>
            <p>Jl. Kelapa Gading. Blok M 45, Jakarta, Indonesia</p>
            <p>Telepon: (021) 812-9397 | Email: help-center@krotravel.com</p>
            <hr>
            <p>Referensi Desain Web: <a href="https://www.bayubuanatravel.com/" target="_blank" rel="noopener noreferrer">BayuBuanaTravel.com</a></p>
            <p>&copy; 2025 KroTravel. Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <div id="customModal" class="modal">
        <div class="modalContent">
            <span class="closeButton">&times;</span>
            <div id="modalBody">
                <p id="modalText"></p>
                
                <form id="popupLoginForm" style="display: none;">
                    <h2 style="text-align: center; color: var(--primary-color);">Login Dulu Yuk!</h2>
                    <p style="text-align: center;">Anda harus masuk untuk melanjutkan.</p>
                    
                    <div id="popupError" class="error-message" style="display: none;"></div>
                    
                    <div class="input-group">
                        <label for="popupUsername">Username</label>
                        <input type="text" id="popupUsername" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="popupPassword">Password</label>
                        <input type="password" id="popupPassword" name="password" required>
                    </div>
                    <button type="submit" class="actionButton">Login</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>