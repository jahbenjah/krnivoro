<?php
// Al inicio del archivo que muestra la lista de propiedades
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es-mx">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Krnivoro | Experiencias Gastronómicas y Networking de Alto Nivel</title><!-- Begin Jekyll SEO tag v2.8.0 -->
<title>Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel | Conectamos líderes visionarios a través de sabores memorables, vínculos estratégicos y experiencias exclusivas que trascienden fronteras.</title>
<meta name="generator" content="Jekyll v4.3.4" />
<meta property="og:title" content="Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel" />
<meta name="author" content="Rosarito Centro" />
<meta property="og:locale" content="es_mx" />
<meta name="description" content="Conectamos líderes visionarios a través de sabores memorables, vínculos estratégicos y experiencias exclusivas que trascienden fronteras." />
<meta property="og:description" content="Conectamos líderes visionarios a través de sabores memorables, vínculos estratégicos y experiencias exclusivas que trascienden fronteras." />
<link rel="canonical" href="http://localhost:4000/" />
<meta property="og:url" content="http://localhost:4000/" />
<meta property="og:site_name" content="Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel" />
<meta property="og:image" content="http://localhost:4000/assets/img/logo-krnivoro-og.jpg" />
<meta property="og:image:height" content="200" />
<meta property="og:image:width" content="200" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary" />
<meta property="twitter:image" content="http://localhost:4000/assets/img/logo-krnivoro-og.jpg" />
<meta property="twitter:title" content="Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel" />
<meta name="twitter:site" content="@CentroRosarito" />
<meta name="twitter:creator" content="@Rosarito Centro" />
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"WebSite","author":{"@type":"Person","name":"Rosarito Centro"},"description":"Conectamos líderes visionarios a través de sabores memorables, vínculos estratégicos y experiencias exclusivas que trascienden fronteras.","headline":"Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel","image":{"height":200,"width":200,"url":"http://localhost:4000/assets/img/logo-krnivoro-og.jpg","@type":"imageObject"},"name":"Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel","url":"http://localhost:4000/"}</script>
<!-- End Jekyll SEO tag -->
<link type="application/atom+xml" rel="alternate" href="http://localhost:4000/feed.xml" title="Krnivoro | Experiencias Gastronómicas y Networking de Alto Nivel" /><!-- SEO Meta Tags -->
<meta name="description" content="">
<meta name="keywords" content="Krnivoro, experiencias, networking, lujo, gastronomía, hospitalidad, eventos, ejecutivos, Ensenada, México">
<link rel="canonical" href="http://localhost:4000/">

<!-- Open Graph / Facebook -->
<!--meta property="og:title" content="Krnivoro | Experiencias Gastronómicas y Networking de Alto Nivel">
<meta property="og:description" content="Experiencias exclusivas, networking de alto nivel y hospitalidad de lujo en Krnivoro."-->
<meta property="og:type" content="website">
<meta property="og:url" content="http://localhost:4000/">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Krnivoro | Experiencias Gastronómicas y Networking de Alto Nivel">
<meta name="twitter:description" content="Experiencias exclusivas, networking de alto nivel y hospitalidad de lujo en Krnivoro.">
<meta name="twitter:image" content="https://krnivoro.com/assets/img/krnivoro/favicon/web-app-manifest-512x512.png">

<!-- Favicons -->
<link rel="icon" type="image/png" href="/assets/img/krnivoro/favicon/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/assets/img/krnivoro/favicon/favicon.svg" />
<link rel="shortcut icon" href="/assets/img/krnivoro/favicon/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/krnivoro/favicon/apple-touch-icon.png" />
<link rel="manifest" href="/assets/img/krnivoro/favicon/site.webmanifest" />
<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
  href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
  rel="stylesheet">
<!-- Vendor CSS Files -->
<link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="/assets/vendor/aos/aos.css" rel="stylesheet">
<link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet"><!-- Main CSS File -->
<link href="/assets/css/main.css" rel="stylesheet">

<script type="application/ld+json">
  {
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Krnivoro",
  "url": "https://krnivoro.com",
  "logo": "https://krnivoro.com/assets/img/knivoro.png",
  "contactPoint": [
    {
      "@type": "ContactPoint",
      "telephone": "+52 661 172 4066",
      "contactType": "customer service",
      "areaServed": "MX",
      "availableLanguage": ["Spanish"]
    }
  ],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "22762 Rancho Oasis",
    "addressLocality": "Ensenada",
    "addressRegion": "B.C.",
    "addressCountry": "MX"
  },
  "email": ["info@krnivoro.com", "contacto@krnivoro.com"]
}
</script></head>

<body class="index-page"><header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="/index.html" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="/assets/img/krnivoro.png" alt="Krnivoro Logo">
            <!-- <h1 class="sitename">Krnivoro</h1> -->
            <span></span>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="/#hero" class="active">Inicio<br></a></li>
                <li><a href="/conocenos.html">Conócenos</a></li>
                <li class="dropdown"><a href="#"><span>Servicios</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <!-- <li><a href="#">Lifestyle & Out Dor</a></li>
                        <li><a href="#">Salud, Bienestar & Medicina Premium</a></li>
                        <li><a href="#">Transporte Ejecutivo & Seguridad Privada</a></li> -->
                        <li><a href="/doing-business-at-KRNIVORO.html">Doing Business at KRNIVORO</a></li>
                        <li><a href="/KRNIVORO_sos.html">KRNIVORO SOS</a></li>
                        <li><a href="/KRNIVORO_legal_protection.html">KRNIVORO Legal Protection</a></li>
                        <li><a href="/KRNIVORO-dental-bernal.html">KRNIVORO Dental Bernal & Maxilofacial Excellence</a>
                        </li>
                        <li><a href="/KRNIVORO_store.html">KRNIVORO Store – Select Cuts & Premium Nutrition</a></li>
                        <li><a href="/KRNIVORO_outdoor.html">KRNIVORO Outdoor</a></li>
                        <li><a href="/KRNIVORO_hospedaje.html">Hospedaje, Restaurante & Viñedos</a></li>
                        <li><a href="/KRNIVORO-medicina-premium.html">Sección Médica Premium</a></li>
                        <li><a href="/KRNIVORO_transporte-ejecutivo.html">Transporte Ejecutivo</a></li>
                    </ul>
                </li>
                 <li><a href="/directorio.html">Directorio</a></li>
                <li><a href="/KRNIVORO_blog.html">Blog</a></li>
                <li><a href="/KRNIVORO_productos.html">Nuestros Productos</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="/contacto.html">Contacto</a>

    </div>
</header>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav id="sidebar" class="col-md-2 d-none d-md-block bg-dark sidebar vh-100" style="min-height:100vh;position:fixed;left:0;top:0;z-index:1000;">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column text-white">
                            <?php
                            // Obtener el rol del usuario
                            $rol = null;
                            if (isset($_SESSION['usuario_id'])) {
                                    $pdo = new PDO('mysql:host=localhost;dbname=krnivoro_db;charset=utf8mb4', 'krnivoro_db', 'Krnivoro.com1');
                                    $stmt = $pdo->prepare("SELECT rol FROM Usuarios WHERE id = ? LIMIT 1");
                                    $stmt->execute([$_SESSION['usuario_id']]);
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                    if ($row) $rol = $row['rol'];
                            }
                            if ($rol === 'admin') {
                            ?>
                            <li class="nav-item mb-3">
                                <a class="nav-link text-white" href="/admin/blog.php">
                                    <i class="bi bi-journal-text me-2"></i> Blog
                                </a>
                            </li>
                            <?php } ?>
                            <li class="nav-item mb-3">
                                <a class="nav-link text-white active" href="/admin/directorio.php">
                                    <i class="bi bi-people me-2"></i> Directorio
                                </a>
                            </li>
                            <li class="nav-item mt-5">
                                <form action="/admin/logout.php" method="post">
                                    <button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- Main content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 offset-md-2" id="main-content" style="min-height:100vh;">
                    <div class="pt-4">
                        <!-- Aquí va el contenido principal de la página -->
                        <h1 class="h3 mb-4">Panel de Administración</h1>
                        <div id="contenido-pagina">
                            <!-- Contenido dinámico aquí -->
                        </div>
                    </div>
                </main>
            </div>
        </div>
    
    <footer id="footer" class="footer dark-background">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="/assets/img/krnivoro.png" alt="Krnivoro Logo"> 
                    </a>
                    <div class="footer-contact pt-3">
                        <p><a href="tel:+52 661 172 4066">+52 661 172 4066</a></p>
                        <p><a href="mailto:contacto@krnivoro.com">contacto@krnivoro.com</a></p>
                        <p><a href="https://maps.app.goo.gl/rYkPGA6gTngpSu9i8">Rancho Oasis, 22760 Ensenada B.C México</a></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/message/5IQRNG5VKJ3IA1"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

            
                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Nuestros Servicios</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="/doing-business-at-KRNIVORO.html">Doing Business at KRNIVORO</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_sos.html">KRNIVORO SOS</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_legal_protection.html">KRNIVORO Legal Protection</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO-dental-bernal.html">KRNIVORO Dental Bernal & Maxilofacial Excellence</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_store.html">KRNIVORO Store – Select Cuts & Premium Nutrition</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_outdoor.html">KRNIVORO Outdoor</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Solicita un servicio</h4>
                    <p>Selecciona el servicio que deseas solicitar:</p>
                    <form action="forms/newsletter.php" method="post" class="php-email-form">
                        <div class="newsletter-form">
                            <select name="service" id="service" required>
                                <option value="" disabled selected>Selecciona un servicio</option>
                                <option value="Experiencia Gourmet">Experiencia Gourmet</option>
                                <option value="Networking Empresarial">Networking Empresarial</option|>
                            </select>   
                            <input type="submit" value="Solicitar Servicio">
                            
                        </div>
                        <div class="loading">Cargando</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Tu solicitud de suscripción ha sido enviada. ¡Gracias!</div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container text-center">
            <p>© <span>Derechos Reservados</span> <strong class="px-1 sitename">Krnivoro</strong> <span>Todos los derechos reservados</span></p>
            <div class="credits">
                Diseñado por <a href="https://krnivoro.com/">Krnivoro</a>
            </div>
        </div>
    </div>

</footer>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Preloader -->
<!-- <div id="preloader"></div> -->
<!-- Vendor JS Files -->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<!-- Main JS File -->
<script src="/assets/js/main.js"></script>
</body>

</html>