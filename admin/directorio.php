<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
        header('Location: /admin/login.php');
        <?php
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /admin/login.php');
            exit;
        }
        $nombre = $_SESSION['nombre'] ?? 'Usuario';
        $rol = $_SESSION['rol'] ?? '';

        ?><!DOCTYPE html>
        <html lang="es-mx">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Administrador del Directorio | Krnivoro</title>
            <link rel="icon" type="image/png" href="/assets/img/krnivoro/favicon/favicon-96x96.png" sizes="96x96" />
            <link rel="icon" type="image/svg+xml" href="/assets/img/krnivoro/favicon/favicon.svg" />
            <link rel="shortcut icon" href="/assets/img/krnivoro/favicon/favicon.ico" />
            <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/krnivoro/favicon/apple-touch-icon.png" />
            <link rel="manifest" href="/assets/img/krnivoro/favicon/site.webmanifest" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
                            <li><a href="/admin/directorio.php" class="active">Directorio</a></li>
                            <li><a href="/admin/blog.php">Blog</a></li>
                            <li><a href="/admin/perfil.php">Perfil</a></li>
                            <li><form action="/admin/logout.php" method="post" style="display:inline;"><button type="submit" class="btn btn-danger">Cerrar Sesión</button></form></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                </div>
            </header>
            <main class="main pt-5" style="min-height:100vh;">
                <div class="container mt-5">
                    <h1 class="h3 mb-4">Panel de Administración</h1>
                    <div class="table-responsive">
                        <table id="tabla-usuarios" class="table table-striped table-bordered">
                            <thead><tr><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Puesto</th><th>Empresa</th><th>Ciudad</th><th>Estado</th><th>País</th><th>Aprobado</th><th>Acción</th></tr></thead>
                            <tbody></tbody>
                        </table>
                    </div>
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
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    function cargarUsuarios() {
                        $.get("/api/usuarios.php", function(usuarios) {
                            const tbody = $("#tabla-usuarios tbody");
                            tbody.empty();
                            usuarios.forEach(function(u) {
                                if (u.rol && u.rol === "admin") return;
                                let aprobado = u.aprobado == 1 ? "Sí" : "No";
                                let accion = "";
                                if (u.aprobado == 0) {
                                    accion = `<button class='btn btn-success btn-sm aprobar-btn' data-id='${u.id}'>Aprobar</button>`;
                                }
                                tbody.append(`<tr><td>${u.nombre}</td><td>${u.email}</td><td>${u.telefono || ""}</td><td>${u.puesto || ""}</td><td>${u.empresa || ""}</td><td>${u.ciudad || ""}</td><td>${u.estado || ""}</td><td>${u.pais || ""}</td><td>${aprobado}</td><td>${accion}</td></tr>`);
                            });
                            $("#tabla-usuarios").DataTable();
                        });
                    }
                    cargarUsuarios();
                    $(document).on("click", ".aprobar-btn", function() {
                        const id = $(this).data("id");
                        $.ajax({
                            url: "/api/usuarios.php?aprobar=1",
                            type: "PUT",
                            data: JSON.stringify({id: id}),
                            contentType: "application/json",
                            success: function(resp) {
                                alert("Usuario aprobado");
                                cargarUsuarios();
                            },
                            error: function() {
                                alert("Error al aprobar usuario");
                            }
                        });
                    });
                });
            </script>
        </body>
        </html>
        $sidebar .= '<li class="nav-item mb-3"><a class="nav-link text-white" href="/admin/blog.php"><i class="bi bi-journal-text me-2"></i> Blog</a></li>';
}
$sidebar .= '<li class="nav-item mb-3"><a class="nav-link text-white active" aria-current="page" href="/admin/directorio.php"><i class="bi bi-people me-2"></i> Directorio</a></li>';
$sidebar .= '<li class="nav-item mt-5"><form action="/admin/logout.php" method="post"><button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</button></form></li>';
$sidebar .= '</ul>';

$mainContent = '<h1 class="h3 mb-4">Panel de Administración</h1>';
$mainContent .= '<div id="contenido-pagina">';
$mainContent .= '<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">';
$mainContent .= '<div class="table-responsive">';
$mainContent .= '<table id="tabla-usuarios" class="table table-striped table-bordered">';
$mainContent .= '<thead><tr><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Puesto</th><th>Empresa</th><th>Ciudad</th><th>Estado</th><th>País</th><th>Aprobado</th><th>Acción</th></tr></thead><tbody></tbody></table>';
$mainContent .= '</div>';
$mainContent .= '</div>';
$mainContent .= '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>';
$mainContent .= '<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>';
$mainContent .= '<script>$(document).ready(function() {function cargarUsuarios() {$.get("/api/usuarios.php", function(usuarios) {const tbody = $("#tabla-usuarios tbody");tbody.empty();usuarios.forEach(function(u) {if (u.rol && u.rol === "admin") return;let aprobado = u.aprobado == 1 ? "Sí" : "No";let accion = "";if (u.aprobado == 0) {accion = `<button class=\"btn btn-success btn-sm aprobar-btn\" data-id=\"${u.id}\">Aprobar</button>`;}tbody.append(`<tr><td>${u.nombre}</td><td>${u.email}</td><td>${u.telefono || ""}</td><td>${u.puesto || ""}</td><td>${u.empresa || ""}</td><td>${u.ciudad || ""}</td><td>${u.estado || ""}</td><td>${u.pais || ""}</td><td>${aprobado}</td><td>${accion}</td></tr>`);});$("#tabla-usuarios").DataTable();});}cargarUsuarios();$(document).on("click", ".aprobar-btn", function() {const id = $(this).data("id");$.ajax({url: "/api/usuarios.php?aprobar=1",type: "PUT",data: JSON.stringify({id: id}),contentType: "application/json",success: function(resp) {alert("Usuario aprobado");cargarUsuarios();},error: function() {alert("Error al aprobar usuario");}});});});</script>';

renderLayout('Administrador del Directorio | Krnivoro', '<nav class="col-md-2 bg-dark sidebar vh-100 d-block" style="min-height:100vh;position:fixed;left:0;top:0;z-index:1000;width:220px;"><div class="position-sticky pt-3">'.$sidebar.'</div></nav><main class="col-md-10 ms-auto px-md-4" id="main-content" style="min-height:100vh;margin-left:220px;"><div class="pt-4">'.$mainContent.'</div></main>');
?>
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
                <nav id="sidebar" class="col-md-2 bg-dark sidebar vh-100 d-block" style="min-height:100vh;position:fixed;left:0;top:0;z-index:1000;width:220px;">
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
                                <a class="nav-link text-white active" aria-current="page" href="/admin/directorio.php">
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
                <main class="col-md-10 ms-auto px-md-4" id="main-content" style="min-height:100vh;margin-left:220px;">
                    <div class="pt-4">
                        <!-- Aquí va el contenido principal de la página -->
                        <h1 class="h3 mb-4">Panel de Administración</h1>
                        <div id="contenido-pagina">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="table-responsive">
    <table id="tabla-usuarios" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Puesto</th>
                <th>Empresa</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>País</th>
                <th>Aprobado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    function cargarUsuarios() {
        $.get('/api/usuarios.php', function(usuarios) {
            const tbody = $('#tabla-usuarios tbody');
            tbody.empty();
            usuarios.forEach(function(u) {
                // Filtrar administradores
                if (u.rol && u.rol === 'admin') return;
                let aprobado = u.aprobado == 1 ? 'Sí' : 'No';
                let accion = '';
                if (u.aprobado == 0) {
                    accion = `<button class="btn btn-success btn-sm aprobar-btn" data-id="${u.id}">Aprobar</button>`;
                }
                tbody.append(`
                    <tr>
                        <td>${u.nombre}</td>
                        <td>${u.email}</td>
                        <td>${u.telefono || ''}</td>
                        <td>${u.puesto || ''}</td>
                        <td>${u.empresa || ''}</td>
                        <td>${u.ciudad || ''}</td>
                        <td>${u.estado || ''}</td>
                        <td>${u.pais || ''}</td>
                        <td>${aprobado}</td>
                        <td>${accion}</td>
                    </tr>
                `);
            });
            $('#tabla-usuarios').DataTable();
        });
    }

    cargarUsuarios();

    // Aprobar usuario
    $(document).on('click', '.aprobar-btn', function() {
        const id = $(this).data('id');
        $.ajax({
            url: '/api/usuarios.php?aprobar=1',
            type: 'PUT',
            data: JSON.stringify({id: id}),
            contentType: 'application/json',
            success: function(resp) {
                alert('Usuario aprobado');
                cargarUsuarios();
            },
            error: function() {
                alert('Error al aprobar usuario');
            }
        });
    });
});
</script>
<script src="/assets/js/main.js"></script>
</body>

</html>