<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
$pdo = getPDO();
$categorias = $pdo->query("SELECT id, nombre FROM BlogCategorias")->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO BlogArticulos (titulo, slug, autor, contenido, resumen, fecha_publicacion, estado, seo_title, seo_description, categoria_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['titulo'],
        $_POST['slug'],
        $_POST['autor'],
        $_POST['contenido'],
        $_POST['resumen'],
        $_POST['fecha_publicacion'],
        $_POST['estado'],
        $_POST['seo_title'],
        $_POST['seo_description'],
        $_POST['categoria_id']
    ]);
    header('Location: /admin/blog-list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Blog</title>
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
        <h2>Crear nuevo artículo</h2>
        <form method="post">
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Slug (URL)</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Autor</label>
                <input type="text" name="autor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Contenido</label>
                <textarea name="contenido" class="form-control" rows="8" required></textarea>
            </div>
            <div class="mb-3">
                <label>Resumen</label>
                <textarea name="resumen" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label>Fecha de publicación</label>
                <input type="date" name="fecha_publicacion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="publicado">Publicado</option>
                    <option value="borrador">Borrador</option>
                </select>
            </div>
            <div class="mb-3">
                <label>SEO Title</label>
                <input type="text" name="seo_title" class="form-control">
            </div>
            <div class="mb-3">
                <label>SEO Description</label>
                <input type="text" name="seo_description" class="form-control">
            </div>
            <div class="mb-3">
                <label>Categoría</label>
                <select name="categoria_id" class="form-control">
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
