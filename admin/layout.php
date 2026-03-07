<?php
// admin/layout.php
function renderLayout($title, $content) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($title); ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
            <a href="/admin/dashboard.php">Dashboard</a>
            <a href="/admin/directorio.php">Directorio</a>
            <a href="/admin/perfil.php">Perfil</a>
            <a href="/admin/blog-list.php">Blog</a>
            <a href="/admin/logout.php">Salir</a>
        </div>
        <div class="main">
            <?php echo $content; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
