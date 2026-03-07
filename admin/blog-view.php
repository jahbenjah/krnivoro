<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
$pdo = new PDO('mysql:host=localhost;dbname=krnivoro_db;charset=utf8mb4', 'krnivoro_db', 'Krnivoro.com1');
$id = $_GET['id'] ?? null;
if (!$id) { header('Location: /admin/blog-list.php'); exit; }
$stmt = $pdo->prepare("SELECT a.*, c.nombre AS categoria FROM BlogArticulos a LEFT JOIN BlogCategorias c ON a.categoria_id = c.id WHERE a.id = ?");
$stmt->execute([$id]);
$articulo = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($articulo['titulo']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-width: 200px; background: #343a40; color: #fff; height: 100vh; position: fixed; }
        .sidebar a { color: #fff; display: block; padding: 1rem; text-decoration: none; }
        .sidebar a.active, .sidebar a:hover { background: #495057; }
        .main { margin-left: 200px; padding: 2rem; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="p-3">KRNIVORO</h4>
        <a href="/admin/dashboard.php">Dashboard</a>
        <a href="/admin/blog-list.php" class="active">Blog</a>
        <a href="/admin/directorio.php">Directorio</a>
        <a href="/admin/logout.php">Salir</a>
    </div>
    <div class="main">
        <h2><?php echo htmlspecialchars($articulo['titulo']); ?></h2>
        <p><strong>Categoría:</strong> <?php echo htmlspecialchars($articulo['categoria']); ?></p>
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($articulo['autor']); ?></p>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($articulo['fecha_publicacion']); ?></p>
        <hr>
        <div><?php echo nl2br(htmlspecialchars($articulo['contenido'])); ?></div>
        <hr>
        <p><strong>SEO Title:</strong> <?php echo htmlspecialchars($articulo['seo_title']); ?></p>
        <p><strong>SEO Description:</strong> <?php echo htmlspecialchars($articulo['seo_description']); ?></p>
        <a href="/admin/blog-edit.php?id=<?php echo $articulo['id']; ?>" class="btn btn-warning">Editar</a>
        <a href="/admin/blog-list.php" class="btn btn-secondary">Volver a la lista</a>
    </div>
</body>
</html>
