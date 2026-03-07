<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
$pdo = getPDO();
$stmt = $pdo->query("SELECT a.id, a.titulo, a.slug, a.fecha_publicacion, c.nombre AS categoria FROM BlogArticulos a LEFT JOIN BlogCategorias c ON a.categoria_id = c.id ORDER BY a.fecha_publicacion DESC");
$articulos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Blogs</title>
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
        <h2>Artículos del Blog</h2>
        <a href="/admin/blog-create.php" class="btn btn-primary mb-3">Crear nuevo artículo</a>
        <table class="table table-bordered bg-white">
            <thead>
                <tr><th>Título</th><th>Categoría</th><th>Fecha</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                <?php foreach ($articulos as $a): ?>
                <tr>
                    <td><?php echo htmlspecialchars($a['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($a['categoria']); ?></td>
                    <td><?php echo htmlspecialchars($a['fecha_publicacion']); ?></td>
                    <td>
                        <a href="/admin/blog-view.php?id=<?php echo $a['id']; ?>" class="btn btn-info btn-sm">Ver</a>
                        <a href="/admin/blog-edit.php?id=<?php echo $a['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/admin/blog-delete.php?id=<?php echo $a['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
