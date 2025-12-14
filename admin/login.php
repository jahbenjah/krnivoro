<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    $pdo = new PDO('mysql:host=localhost;dbname=krnivoro_db;charset=utf8mb4', 'krnivoro_db', 'Krnivoro.com1');
    $stmt = $pdo->prepare("SELECT id, password_hash FROM Usuarios WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $usuario = $stmt->fetch();
    if ($usuario && password_verify($_POST['password'], $usuario['password_hash'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header('Location: /admin/directorio.php');
        exit;
    } else {
        $error = 'Correo o contraseña incorrectos';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Iniciar Sesión - Krnivoro</title>
  <meta name="description" content="Acceso privado para administración de Krnivoro.">
  <meta name="keywords" content="login, acceso, administración, Krnivoro, servicios">
  <meta name="author" content="Krnivoro">
  <meta name="robots" content="noindex, nofollow">
  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="Iniciar Sesión - Krnivoro">
  <meta property="og:description" content="Acceso privado para administración de Krnivoro.">
  <meta property="og:image" content="/assets/img/logo.png">
  <meta property="og:url" content="https://krnivoro.com/admin/login.php">
  <meta property="og:type" content="website">
  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Iniciar Sesión - Krnivoro">
  <meta name="twitter:description" content="Acceso privado para administración de Krnivoro.">
  <meta name="twitter:image" content="/assets/img/logo.png">
  <meta name="twitter:site" content="https://twitter.com/krnivoro">
  <link rel="icon" type="image/png" href="/assets/img/favicon.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="/assets/img/favicon.svg" />
  <link rel="shortcut icon" href="/assets/img/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png" />
  <!-- Puedes agregar un manifest propio si existe -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body.bg-light {
      min-height: 100vh;
      position: relative;
      overflow: hidden;
    }
    /* Fondo de logos en mosaico y difuminado */
    body.bg-light::before {
      content: '';
      position: fixed;
      top: 0; left: 0; width: 100vw; height: 100vh;
      z-index: 0;
      background-image: url('/assets/img/logo.png');
      background-repeat: repeat;
      background-size: 180px auto;
      opacity: 0.10;
      filter: blur(6px);
      pointer-events: none;
    }
    @media (max-width: 767px) {
      body.bg-light::before {
        background-size: 90px auto;
        filter: blur(4px);
      }
      .card {
        margin-top: 2rem;
        margin-bottom: 2rem;
      }
    }
    .logo-login {
      width: 110px;
      height: auto;
      margin-bottom: 10px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      border-radius: 16px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.10);
      background: #fff;
      padding: 8px;
    }
    .btn-primary {
      background: #a51c30;
      border: none;
    }
    .btn-primary:hover, .btn-primary:focus {
      background: #7a1422;
    }
  </style>
</head>
<body class="bg-light d-flex align-items-center">
  <div class="container" style="position:relative; z-index:1;">
    <div class="row justify-content-center">
      <div class="col-md-4 col-12">
        <div class="card shadow mt-5">
          <div class="card-body">
            <div class="text-center mb-4">
              <img src="/assets/img/logo.png" alt="Krnivoro" class="logo-login">
            </div>
            <h2 class="mb-4 text-center">Acceso Krnivoro</h2>
            <?php if ($error): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" autocomplete="off">
              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ingresar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>