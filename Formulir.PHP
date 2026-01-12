<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Pendaftaran Mahasiswa</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- CSS Styles sama seperti sebelumnya -->
  <style>
    /* Paste CSS dari file Formulir.PHP asli Anda di sini, atau link ke style eksternal */
    body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #ffb347, #ffffff); display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
    .form-container { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: #333; }
    .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;}
    .submit-btn { width: 100%; padding: 12px; background: #ff8c42; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px; }
    .submit-btn:hover { background: #e67e22; }
    h2 { text-align: center; color: #2c3e50; }
    .back-btn { display: block; text-align: center; margin-top: 15px; color: #555; text-decoration: none; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Daftar Mahasiswa</h2>
    <!-- PERUBAHAN PENTING: action ke proses_daftar.php -->
    <form action="proses_daftar.php" method="POST">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
      </div>
      <div class="form-group">
        <label>Nomor Induk Mahasiswa (NIM)</label>
        <input type="text" name="nim" required>
      </div>
      <div class="form-group">
        <label>Tempat, Tanggal Lahir</label>
        <input type="text" name="ttl" required>
      </div>
      <div class="form-group">
        <label>Jurusan</label>
        <input type="text" name="jurusan" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>
      <div class="form-group">
        <label>Kata Sandi</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Daftar Sekarang</button>
    </form>
    <a href="login.php" class="back-btn">Sudah punya akun? Login</a>
  </div>
</body>
</html>