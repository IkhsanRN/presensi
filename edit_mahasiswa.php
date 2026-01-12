<?php
include 'koneksi.php';

// Validasi apakah parameter 'id' ada
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_dashboard.php?pesan=id_kosong");
    exit();
}

$id = $_GET['id'];

// Gunakan prepared statement untuk keamanan SQL injection
$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah data ditemukan
if ($result->num_rows == 0) {
    header("Location: admin_dashboard.php?pesan=data_tidak_ditemukan");
    exit();
}

$data = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa - Sistem Presensi</title>
    
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
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
            padding: 20px;
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

        /* ====== Form Container ====== */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 550px;
            position: relative;
            z-index: 2;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ====== Header ====== */
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .form-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #777;
            font-size: 14px;
        }

        /* ====== Back Button ====== */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ff8c00;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            color: #ffb347;
            transform: translateX(-5px);
            text-decoration: none;
        }

        /* ====== Form Groups ====== */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group label i {
            color: #ff8c00;
        }

        .form-group label.required::after {
            content: '*';
            color: #e74c3c;
            margin-left: 4px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: #999;
            font-size: 16px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-control:read-only {
            background: #f8f9fa;
            cursor: not-allowed;
        }

        .form-control.highlight {
            border-color: #ff8c00;
        }

        .form-control.highlight:focus {
            border-color: #ff8c00;
            box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.1);
        }

        .form-text {
            display: flex;
            align-items: start;
            gap: 6px;
            margin-top: 6px;
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        .form-text i {
            color: #3498db;
            margin-top: 2px;
        }

        /* ====== Alert Box ====== */
        .alert-box {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.1), rgba(192, 57, 43, 0.1));
            border-left: 4px solid #e74c3c;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .alert-box i {
            color: #e74c3c;
            font-size: 20px;
            margin-top: 2px;
        }

        .alert-content h4 {
            font-size: 14px;
            font-weight: 700;
            color: #e74c3c;
            margin: 0 0 5px 0;
        }

        .alert-content p {
            font-size: 13px;
            color: #666;
            margin: 0;
            line-height: 1.5;
        }

        /* ====== Buttons ====== */
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background: white;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-secondary:hover {
            background: #f8f9fa;
            border-color: #ccc;
            text-decoration: none;
            color: #333;
        }

        /* ====== Student Info Card ====== */
        .student-info {
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(41, 128, 185, 0.1));
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .student-info h3 {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .student-info h3 i {
            color: #3498db;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            font-size: 12px;
            color: #777;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 15px;
            color: #2c3e50;
            font-weight: 600;
        }

        /* ====== Responsive Design ====== */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .form-container {
                padding: 30px 25px;
            }

            .form-header h2 {
                font-size: 22px;
            }

            .button-group {
                flex-direction: column;
            }

            .student-accent {
                font-size: 3rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
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
    </div>

    <!-- Student Accents -->
    <i class="fas fa-fingerprint student-accent accent-1"></i>
    <i class="fas fa-user-edit student-accent accent-2"></i>

    <!-- Form Container -->
    <div class="form-container">
        <!-- Back Button -->
        <a href="admin_dashboard.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <!-- Header -->
        <div class="form-header">
            <div class="form-icon">
                <i class="fas fa-fingerprint"></i>
            </div>
            <h2>Set ID Fingerprint</h2>
            <p>Konfigurasi ID fingerprint mahasiswa untuk presensi</p>
        </div>

        <!-- Student Info -->
        <div class="student-info">
            <h3><i class="fas fa-user-circle"></i> Informasi Mahasiswa</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value"><?php echo htmlspecialchars($data['nama']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">NIM</span>
                    <span class="info-value"><?php echo htmlspecialchars($data['nim']); ?></span>
                </div>
            </div>
        </div>

        <!-- Alert Box -->
        <div class="alert-box">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="alert-content">
                <h4>Penting!</h4>
                <p>Pastikan ID Fingerprint yang dimasukkan sesuai dengan nomor yang tersimpan di sensor AS608 (Range: 1-127)</p>
            </div>
        </div>

        <!-- Form -->
        <form action="proses_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            
            <div class="form-group">
                <label class="required">
                    <i class="fas fa-fingerprint"></i>
                    ID Fingerprint
                </label>
                <div class="input-wrapper">
                    <i class="input-icon fas fa-hashtag"></i>
                    <input 
                        type="number" 
                        name="fingerprint_id" 
                        class="form-control highlight" 
                        value="<?php echo htmlspecialchars($data['fingerprint_id']); ?>" 
                        min="1" 
                        max="127" 
                        required
                        placeholder="Masukkan ID (1-127)"
                    >
                </div>
                <div class="form-text">
                    <i class="fas fa-info-circle"></i>
                    <span>Masukkan nomor ID yang sesuai dengan data di sensor fingerprint AS608</span>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="admin_dashboard.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>