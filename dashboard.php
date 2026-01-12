<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: login.php?pesan=belum_login");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Presensi Mahasiswa</title>
    
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
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
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
            top: 60px;
            left: 50px;
            transform: rotate(-15deg);
        }

        .accent-2 {
            bottom: 80px;
            right: 70px;
            transform: rotate(20deg);
        }

        /* ====== Top Navigation ====== */
        .top-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        .top-nav-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ff8c00;
            font-size: 22px;
            font-weight: 700;
        }

        .brand i {
            font-size: 28px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #333;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffb347, #ff8c00);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(255, 140, 0, 0.3);
        }

        .user-name {
            font-weight: 600;
            color: #2c3e50;
        }

        /* ====== Main Container ====== */
        .dashboard-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 30px;
            position: relative;
            z-index: 2;
        }

        /* ====== Welcome Card ====== */
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            margin-bottom: 30px;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .welcome-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .welcome-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, #ffb347, #ff8c00);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            box-shadow: 0 5px 15px rgba(255, 140, 0, 0.3);
        }

        .welcome-text h2 {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .welcome-text p {
            color: #666;
            margin: 5px 0 0 0;
        }

        .welcome-message {
            background: linear-gradient(135deg, rgba(255, 179, 71, 0.1), rgba(255, 140, 0, 0.1));
            border-left: 4px solid #ff8c00;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .welcome-message p {
            margin: 0;
            color: #555;
            line-height: 1.6;
        }

        /* ====== Profile Section ====== */
        .profile-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #ff8c00;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .profile-item {
            display: flex;
            align-items: start;
            gap: 12px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .profile-item:hover {
            background: rgba(255, 179, 71, 0.1);
            transform: translateX(5px);
        }

        .profile-item i {
            color: #ff8c00;
            font-size: 20px;
            margin-top: 3px;
        }

        .profile-item-content {
            flex: 1;
        }

        .profile-label {
            font-size: 12px;
            color: #777;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .profile-value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 600;
            margin-top: 3px;
        }

        /* ====== Action Buttons ====== */
        .actions-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.2);
            text-decoration: none;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: white;
            flex-shrink: 0;
        }

        .action-icon.primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }

        .action-icon.success {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
        }

        .action-icon.warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
        }

        .action-icon.danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        .action-content h3 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 5px 0;
        }

        .action-content p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }

        /* ====== Logout Button ====== */
        .logout-section {
            text-align: center;
            margin-top: 40px;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 40px;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-logout:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
            text-decoration: none;
            color: white;
        }

        /* ====== Responsive Design ====== */
        @media (max-width: 768px) {
            .dashboard-container {
                margin: 30px auto;
                padding: 0 20px;
            }

            .top-nav-wrapper {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .welcome-card {
                padding: 25px;
            }

            .welcome-text h2 {
                font-size: 24px;
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }

            .actions-section {
                grid-template-columns: 1fr;
            }

            .student-accent {
                font-size: 3rem;
            }
        }

        /* ====== Stats Cards ====== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: linear-gradient(135deg, #ffb347, #ff8c00);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }

        .stat-label {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
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
    </div>

    <!-- Student Accents -->
    <i class="fas fa-graduation-cap student-accent accent-1"></i>
    <i class="fas fa-book-reader student-accent accent-2"></i>

    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="top-nav-wrapper">
            <div class="brand">
                <i class="fas fa-fingerprint"></i>
                <span>Sistem Presensi</span>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION['nama'], 0, 1)); ?>
                </div>
                <div>
                    <div class="user-name"><?php echo $_SESSION['nama']; ?></div>
                    <small style="color: #777;">NIM: <?php echo $_SESSION['nim']; ?></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Container -->
    <div class="dashboard-container">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <div class="welcome-header">
                <div class="welcome-icon">
                    <i class="fas fa-hand-sparkles"></i>
                </div>
                <div class="welcome-text">
                    <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h2>
                    <p>Senang melihat Anda kembali</p>
                </div>
            </div>
            
            <div class="welcome-message">
                <p><i class="fas fa-check-circle" style="color: #27ae60; margin-right: 8px;"></i> 
                Anda berhasil login ke Sistem Presensi Berbasis Fingerprint. Kelola kehadiran Anda dengan mudah dan pantau statistik presensi Anda secara real-time.</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="profile-section">
            <h3 class="section-title">
                <i class="fas fa-user-circle"></i>
                Informasi Profil
            </h3>
            <div class="profile-grid">
                <div class="profile-item">
                    <i class="fas fa-id-card"></i>
                    <div class="profile-item-content">
                        <div class="profile-label">Nama Lengkap</div>
                        <div class="profile-value"><?php echo $_SESSION['nama']; ?></div>
                    </div>
                </div>
                <div class="profile-item">
                    <i class="fas fa-hashtag"></i>
                    <div class="profile-item-content">
                        <div class="profile-label">Nomor Induk Mahasiswa</div>
                        <div class="profile-value"><?php echo $_SESSION['nim']; ?></div>
                    </div>
                </div>
                <div class="profile-item">
                    <i class="fas fa-shield-alt"></i>
                    <div class="profile-item-content">
                        <div class="profile-label">Status</div>
                        <div class="profile-value" style="color: #27ae60;">Aktif</div>
                    </div>
                </div>
                <div class="profile-item">
                    <i class="fas fa-calendar-check"></i>
                    <div class="profile-item-content">
                        <div class="profile-label">Login Terakhir</div>
                        <div class="profile-value"><?php echo date('d M Y, H:i'); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Cards -->
        <h3 class="section-title" style="margin-bottom: 20px;">
            <i class="fas fa-th-large"></i>
            Menu Utama
        </h3>
        <div class="actions-section">
            <a href="index.php" class="action-card">
                <div class="action-icon primary">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="action-content">
                    <h3>Log Absensi</h3>
                    <p>Lihat riwayat kehadiran Anda</p>
                </div>
            </a>

            <a href="presensi.php" class="action-card">
                <div class="action-icon success">
                    <i class="fas fa-fingerprint"></i>
                </div>
                <div class="action-content">
                    <h3>Presensi Sekarang</h3>
                    <p>Lakukan presensi kehadiran</p>
                </div>
            </a>

            <a href="edit_mahasiswa.php" class="action-card">
                <div class="action-icon warning">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="action-content">
                    <h3>Edit Profil</h3>
                    <p>Perbarui informasi akun Anda</p>
                </div>
            </a>
        </div>

        <!-- Logout Section -->
        <div class="logout-section">
            <a href="logout.php" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i>
                Keluar dari Sistem
            </a>
        </div>
    </div>
</body>
</html>