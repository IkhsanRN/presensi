<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Presensi - Institut Teknologi Nasional Bandung</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        /* ====== Reset & Base Styles ====== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffb347 0%, #fff 100%);
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* ====== Bokeh Background Effect ====== */
        .bokeh {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            animation: float 10s infinite ease-in-out;
        }

        .circle:nth-child(1) { width: 100px; height: 100px; top: 15%; left: 10%; animation-delay: 0s; }
        .circle:nth-child(2) { width: 150px; height: 150px; top: 60%; left: 5%; animation-delay: 2s; }
        .circle:nth-child(3) { width: 120px; height: 120px; top: 40%; left: 85%; animation-delay: 4s; }
        .circle:nth-child(4) { width: 80px; height: 80px; top: 25%; left: 70%; animation-delay: 6s; }
        .circle:nth-child(5) { width: 110px; height: 110px; top: 75%; left: 60%; animation-delay: 8s; }
        .circle:nth-child(6) { width: 90px; height: 90px; top: 50%; left: 30%; animation-delay: 3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.4; }
            50% { transform: translateY(-50px) scale(1.2); opacity: 0.8; }
        }

        /* ====== Student Accent Icons ====== */
        .student-accent {
            position: fixed;
            font-size: 5rem;
            color: rgba(255, 255, 255, 0.2);
            z-index: 1;
            pointer-events: none;
        }

        .accent-1 {
            top: 80px;
            left: 40px;
            transform: rotate(-15deg);
        }

        .accent-2 {
            bottom: 100px;
            right: 60px;
            transform: rotate(20deg);
        }

        .accent-3 {
            top: 50%;
            right: 5%;
            transform: rotate(-10deg);
            font-size: 3.5rem;
            color: rgba(255, 165, 0, 0.15);
        }

        /* ====== Navigation Bar ====== */
        nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        .navbar-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            height: 70px;
        }

        .logo a {
            font-size: 22px;
            font-weight: 700;
            color: #ff8c00;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.3s;
        }

        .logo a:hover {
            color: #ffb347;
        }

        .logo i {
            font-size: 28px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover {
            background: rgba(255, 140, 0, 0.1);
            color: #ff8c00;
        }

        .nav-menu .btn-signup {
            background: linear-gradient(90deg, #ffb347, #ff8c00);
            color: white !important;
            padding: 10px 20px;
            box-shadow: 0 3px 10px rgba(255, 140, 0, 0.3);
        }

        .nav-menu .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 140, 0, 0.4);
        }

        /* ====== Hero Section ====== */
        .hero-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 60px 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            animation: fadeInLeft 1s ease;
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .hero-tag {
            color: #ff8c00;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-description {
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
            text-align: justify;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ffb347, #ff8c00);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #ff8c00;
            border: 2px solid #ff8c00;
        }

        .btn-secondary:hover {
            background: #ff8c00;
            color: white;
        }

        .hero-image {
            animation: fadeInRight 1s ease;
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .hero-image img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .hero-image img:hover {
            transform: scale(1.02);
        }

        /* ====== Features Section ====== */
        .features-section {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 30px;
            position: relative;
            z-index: 2;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 50px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.2);
        }

        .feature-icon {
            font-size: 40px;
            color: #ff8c00;
            margin-bottom: 20px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
        }

        /* ====== Contact Section ====== */
        .contact-section {
            background: linear-gradient(135deg, #ff8c00, #ffb347);
            padding: 60px 30px;
            margin-top: 80px;
            position: relative;
            z-index: 2;
        }

        .contact-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        .contact-card h3 {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .contact-card p {
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .contact-card i {
            margin-right: 8px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* ====== Footer ====== */
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 25px 30px;
            position: relative;
            z-index: 2;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        .footer b {
            color: #ffb347;
        }

        /* ====== Responsive Design ====== */
        @media (max-width: 768px) {
            .navbar-wrapper {
                flex-direction: column;
                height: auto;
                padding: 15px 20px;
            }

            .nav-menu {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .hero-section {
                grid-template-columns: 1fr;
                margin: 30px auto;
                padding: 30px 20px;
            }

            .hero-image {
                order: -1;
            }

            .hero-title {
                font-size: 32px;
            }

            .section-title {
                font-size: 28px;
            }

            .student-accent {
                font-size: 3rem;
            }

            .accent-3 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Bokeh Background -->
    <div class="bokeh">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <!-- Student Accents -->
    <i class="fas fa-graduation-cap student-accent accent-1"></i>
    <i class="fas fa-book-open student-accent accent-2"></i>
    <i class="fas fa-pencil-alt student-accent accent-3"></i>

    <!-- Navigation -->
    <nav>
        <div class="navbar-wrapper">
            <div class="logo">
                <a href="landing-page.php">
                    <i class="fas fa-university"></i>
                    Institut Teknologi Nasional
                </a>
            </div>
            <ul class="nav-menu">
                <li><a href="#Home"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#Features"><i class="fas fa-star"></i> Features</a></li>
                <li><a href="#Contact"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li><a href="formulir.php" class="btn-signup"><i class="fas fa-user-plus"></i> Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="Home" class="hero-section">
        <div class="hero-content">
            <div class="hero-tag">
                <i class="fas fa-fingerprint"></i>
                Selamat Datang di
            </div>
            <h1 class="hero-title">Sistem Presensi Berbasis Fingerprint</h1>
            <p class="hero-description">
                Sistem Presensi Berbasis Fingerprint di universitas merupakan inovasi teknologi yang digunakan untuk mencatat kehadiran mahasiswa secara otomatis dan akurat melalui pemindaian sidik jari. Sistem ini memastikan kehadiran yang valid karena setiap sidik jari bersifat unik, sehingga meminimalkan kecurangan seperti titip absen. Data kehadiran tersimpan langsung dalam basis data terpusat dan dapat diakses oleh dosen maupun pihak administrasi untuk pemantauan real time.
            </p>
            <div class="hero-buttons">
                <a href="login.php" class="btn btn-primary">
                    <i class="fas fa-rocket"></i> Mulai Sekarang
                </a>
                <a href="#Features" class="btn btn-secondary">
                    <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://img.freepik.com/free-vector/software-development-team-concept-illustration_335657-5545.jpg" alt="Ilustrasi Sistem Presensi">
        </div>
    </section>

    <!-- Features Section -->
    <section id="Features" class="features-section">
        <h2 class="section-title">Keunggulan Sistem Kami</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Keamanan Tinggi</h3>
                <p class="feature-description">
                    Sistem autentikasi berbasis fingerprint memastikan identitas mahasiswa valid dan mencegah kecurangan absensi.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="feature-title">Real-Time Monitoring</h3>
                <p class="feature-description">
                    Data kehadiran tersimpan otomatis dan dapat dipantau secara real-time oleh dosen dan pihak administrasi.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title">Efisien & Akurat</h3>
                <p class="feature-description">
                    Proses absensi lebih cepat dan akurat, mendukung transformasi universitas menuju digitalisasi modern.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="Contact" class="contact-section">
        <div class="contact-wrapper">
            <h2 class="section-title" style="color: white;">Hubungi Kami</h2>
            <div class="contact-grid">
                <div class="contact-card">
                    <h3><i class="fas fa-university"></i> Tentang Itenas</h3>
                    <p>Institut Teknologi Nasional Bandung adalah perguruan tinggi teknik terkemuka yang berkomitmen menghasilkan lulusan berkualitas dan berdaya saing global.</p>
                </div>
                <div class="contact-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Kontak</h3>
                    <p><i class="fas fa-map-pin"></i> Jl. PKH. Hasan Mustopha No.23 Bandung</p>
                    <p><i class="fas fa-mail-bulk"></i> Kode Pos: 40124, Indonesia</p>
                    <p><i class="fas fa-phone"></i> Phone: +62 22 7272215 ext 275</p>
                    <p><i class="fas fa-envelope"></i> E-mail: spp@itenas.ac.id</p>
                </div>
                <div class="contact-card">
                    <h3><i class="fas fa-share-alt"></i> Media Sosial</h3>
                    <p><i class="fab fa-instagram"></i> Instagram: itenas.official</p>
                    <p><i class="fab fa-facebook"></i> Facebook: itenas.official</p>
                    <p><i class="fab fa-tiktok"></i> Tiktok: itenasofficial</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> <b>Institut Teknologi Nasional Bandung</b>. All Rights Reserved.</p>
    </footer>
</body>
</html>