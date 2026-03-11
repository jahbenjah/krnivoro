<?php
// admin/layout.php
function renderLayout($title, $content) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
<title><?php echo htmlspecialchars($title); ?></title>
<meta property="og:title" content="Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel" />
<meta name="author" content="Rosarito Centro" />
<meta property="og:locale" content="es_mx" />
<meta name="description" content="Conectamos líderes visionarios a través de sabores memorables, vínculos estratégicos y experiencias exclusivas que trascienden fronteras." />
<meta property="og:description" content="Conectamos líderes visionarios a través de sabores memorables, vínculos estratégicos y experiencias exclusivas que trascienden fronteras." />
<link rel="canonical" href="https://krnivoro.com/" />
<meta property="og:url" content="https://krnivoro.com/" />
<meta property="og:site_name" content="Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel" />
<meta property="og:image" content="https://krnivoro.com/assets/img/logo-krnivoro-og.jpg" />
<meta property="og:image:height" content="200" />
<meta property="og:image:width" content="200" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary" />
<meta property="twitter:image" content="https://krnivoro.com/assets/img/logo-krnivoro-og.jpg" />
<meta property="twitter:title" content="Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel" />
<meta name="twitter:site" content="@CentroRosarito" />
<meta name="twitter:creator" content="@Rosarito Centro" />
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"WebSite","author":{"@type":"Person","name":"Rosarito Centro"},"description":"Conectamos líderes visionarios a través de sabores memorables, vínculos estratégicos y experiencias exclusivas que trascienden fronteras.","headline":"Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel","image":{"height":200,"width":200,"url":"https://krnivoro.com/assets/img/logo-krnivoro-og.jpg","@type":"imageObject"},"name":"Krnivoro Experiencias Gastronómicas y Networking de Alto Nivel","url":"https://krnivoro.com/"}</script>
<!-- End Jekyll SEO tag -->
<link type="application/atom+xml" rel="alternate" href="https://krnivoro.com/feed.xml" title="Krnivoro | Experiencias Gastronómicas y Networking de Alto Nivel" /><!-- SEO Meta Tags -->
<meta name="description" content="">
<meta name="keywords" content="Krnivoro, experiencias, networking, lujo, gastronomía, hospitalidad, eventos, ejecutivos, Ensenada, México">
<link rel="canonical" href="https://krnivoro.com/">

<!-- Open Graph / Facebook -->
<!--meta property="og:title" content="Krnivoro | Experiencias Gastronómicas y Networking de Alto Nivel">
<meta property="og:description" content="Experiencias exclusivas, networking de alto nivel y hospitalidad de lujo en Krnivoro."-->
<meta property="og:type" content="website">
<meta property="og:url" content="https://krnivoro.com/">

<!--Bootstrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


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
    <style>
            body { background: #f8f9fa; }
            .sidebar { min-width: 200px; background: #343a40; color: #fff; height: 100vh; position: fixed; top:0; left:0; z-index:1000; }
            .sidebar a { color: #fff; display: block; padding: 1rem; text-decoration: none; }
            .sidebar a.active, .sidebar a:hover { background: #495057; }
            .main { margin-left: 200px; padding: 2rem; }
            @media (max-width: 991px) {
                .sidebar { position: absolute; width: 100%; height: auto; min-width: 0; }
                .main { margin-left: 0; padding: 1rem; }
            }
        </style>
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
</script>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark d-lg-none">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <span class="navbar-brand">KRNIVORO</span>
            </div>
        </nav>
        <div class="collapse d-lg-block sidebar" id="sidebarMenu">
            <h4 class="p-3 d-none d-lg-block">KRNIVORO</h4>
              <?php
              // Obtener rol del usuario
              $rol = 'directorio';
              if (isset($_SESSION['usuario_id'])) {
                $pdo = getPDO();
                $stmt = $pdo->prepare("SELECT rol FROM Usuarios WHERE id = ?");
                $stmt->execute([$_SESSION['usuario_id']]);
                $usuario = $stmt->fetch();
                $rol = $usuario['rol'] ?? 'directorio';
              }
              if ($rol === 'admin') {
                echo '<a href="/admin/dashboard.php">Dashboard</a>';
                echo '<a href="/admin/blog-list.php">Blog</a>';
              }
              echo '<a href="/admin/directorio.php">Directorio</a>';
              echo '<a href="/admin/perfil.php">Perfil</a>';
              echo '<a href="/admin/logout.php">Salir</a>';
              ?>
        </div>
        <div class="main">
            <?php echo $content; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
