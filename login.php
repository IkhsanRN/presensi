<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Presensi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Gaya Sederhana agar fungsional dulu */
    body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #ffb347, #ffffff); height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }
    .login-container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); width: 350px; text-align: center; }
    .login-container h2 { margin-bottom: 20px; color: #333; }
    input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
    .btn { width: 100%; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 5px; }
    .btn-login { background: #ff8c42; color: white; }
    .btn-daftar { background: #eee; color: #333; }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login Presensi</h2>
    <!-- PERUBAHAN PENTING: action ke proses_login.php -->
    <form action="proses_login.php" method="POST">
      <input type="text" name="username" placeholder="Nama Mahasiswa" required>
      <input type="password" name="password" placeholder="Kata Sandi" required>
      <button type="submit" class="btn btn-login">Masuk</button>
    </form>
    <button onclick="location.href='formulir.php'" class="btn btn-daftar">Daftar Akun Baru</button>
  </div>
</body>
</html>