<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
require_once __DIR__.'/layout.php';
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

$form = '<h2>Crear nuevo artículo</h2>';
$form .= '<form method="post">';
$form .= '<div class="mb-3"><label>Título</label><input type="text" name="titulo" class="form-control" required></div>';
$form .= '<div class="mb-3"><label>Slug (URL)</label><input type="text" name="slug" class="form-control" required></div>';
$form .= '<div class="mb-3"><label>Autor</label><input type="text" name="autor" class="form-control" required></div>';
$form .= '<div class="mb-3"><label>Contenido</label><textarea name="contenido" class="form-control" rows="8" required></textarea></div>';
$form .= '<div class="mb-3"><label>Resumen</label><textarea name="resumen" class="form-control" rows="2"></textarea></div>';
$form .= '<div class="mb-3"><label>Fecha de publicación</label><input type="date" name="fecha_publicacion" class="form-control" required></div>';
$form .= '<div class="mb-3"><label>Estado</label><select name="estado" class="form-control"><option value="publicado">Publicado</option><option value="borrador">Borrador</option></select></div>';
$form .= '<div class="mb-3"><label>SEO Title</label><input type="text" name="seo_title" class="form-control"></div>';
$form .= '<div class="mb-3"><label>SEO Description</label><input type="text" name="seo_description" class="form-control"></div>';
$form .= '<div class="mb-3"><label>Categoría</label><select name="categoria_id" class="form-control">';
foreach ($categorias as $cat) {
    $form .= '<option value="'.$cat['id'].'">'.htmlspecialchars($cat['nombre']).'</option>';
}
$form .= '</select></div>';
$form .= '<button class="btn btn-primary" type="submit">Guardar</button>';
$form .= '</form>';

renderLayout('Crear Blog', $form);
