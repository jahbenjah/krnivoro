<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
$nombre = $_SESSION['nombre'] ?? 'Usuario';
$email = $_SESSION['email'] ?? '';
$rol = $_SESSION['rol'] ?? '';

?><!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario | KRNIVORO</title>
    <link rel="icon" type="image/png" href="/assets/img/krnivoro/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/img/krnivoro/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/assets/img/krnivoro/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/krnivoro/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/img/krnivoro/favicon/site.webmanifest" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="/index.html" class="logo d-flex align-items-center me-auto me-lg-0">
                <img src="/assets/img/krnivoro.png" alt="Krnivoro Logo">
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/admin/dashboard.php">Dashboard</a></li>
                    <li><a href="/admin/directorio.php">Directorio</a></li>
                    <li><a href="/admin/blog.php">Blog</a></li>
                    <li><a href="/admin/perfil.php" class="active">Perfil</a></li>
                    <li><form action="/admin/logout.php" method="post" style="display:inline;"><button type="submit" class="btn btn-danger">Cerrar Sesión</button></form></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>
    <main class="main pt-5" style="min-height:100vh;">
        <div class="container mt-5">
            <h2>Perfil de Usuario</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($rol); ?></p>
            <a href="/admin/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
        </div>
    </main>
    <footer id="footer" class="footer dark-background mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="/index.html" class="logo d-flex align-items-center">
                        <img src="/assets/img/krnivoro.png" alt="Krnivoro Logo">
                    </a>
                    <div class="footer-contact pt-3">
                        <p><a href="tel:+5216643400882">+52 1 664 340 0882</a></p>
                        <p><a href="mailto:info@krnivoro.com">info@krnivoro.com</a></p>
                        <p><a href="https://maps.app.goo.gl/rYkPGA6gTngpSu9i8">Ensenada, México</a></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="https://facebook.com"><i class="bi bi-facebook"></i></a>
                        <a href="https://instagram.com"><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/5216643400882?text=Hola"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>Nuestros Servicios</h4>
                    <ul>
                        <li><a href="/doing-business-at-KRNIVORO.html">Doing Business at KRNIVORO</a></li>
                        <li><a href="/KRNIVORO_sos.html">KRNIVORO SOS</a></li>
                        <li><a href="/KRNIVORO_legal_protection.html">KRNIVORO Legal Protection</a></li>
                        <li><a href="/KRNIVORO-dental-bernal.html">KRNIVORO Dental Bernal & Maxilofacial Excellence</a></li>
                        <li><a href="/KRNIVORO_store.html">KRNIVORO Store – Select Cuts & Premium Nutrition</a></li>
                        <li><a href="/KRNIVORO_outdoor.html">KRNIVORO Outdoor</a></li>
                        <li><a href="/KRNIVORO_hospedaje.html">Hospedaje Restaurante y Viñedos</a></li>
                        <li><a href="/KRNIVORO-medicina-premium.html">Sección Médica Premium</a></li>
                        <li><a href="/KRNIVORO_transporte-ejecutivo.html">Transporte Ejecutivo</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Nuestros Socios</h4>
                    <ul>
                        <li><a href="/KRNIVORO_socioscomerciales.html">Socios Comerciales</a></li>
                        <li><a href="/KRNIVORO_productos.html">Nuestros Productos</a></li>
                        <li><a href="/contacto.html">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
