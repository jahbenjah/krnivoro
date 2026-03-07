<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
require_once __DIR__.'/layout.php';
$pdo = getPDO();
$stmt = $pdo->query("SELECT a.id, a.titulo, a.slug, a.fecha_publicacion, c.nombre AS categoria FROM BlogArticulos a LEFT JOIN BlogCategorias c ON a.categoria_id = c.id ORDER BY a.fecha_publicacion DESC");
$articulos = $stmt->fetchAll();

$blogListContent = '<h2>Artículos del Blog</h2>';
$blogListContent .= '<a href="/admin/blog-create.php" class="btn btn-primary mb-3">Crear nuevo artículo</a>';
$blogListContent .= '<table class="table table-bordered bg-white">';
$blogListContent .= '<thead><tr><th>Título</th><th>Categoría</th><th>Fecha</th><th>Acciones</th></tr></thead><tbody>';
foreach ($articulos as $a) {
    $blogListContent .= '<tr>';
    $blogListContent .= '<td>'.htmlspecialchars($a['titulo']).'</td>';
    $blogListContent .= '<td>'.htmlspecialchars($a['categoria']).'</td>';
    $blogListContent .= '<td>'.htmlspecialchars($a['fecha_publicacion']).'</td>';
    $blogListContent .= '<td>';
    $blogListContent .= '<a href="/admin/blog-view.php?id='.$a['id'].'" class="btn btn-info btn-sm">Ver</a> ';
    $blogListContent .= '<a href="/admin/blog-edit.php?id='.$a['id'].'" class="btn btn-warning btn-sm">Editar</a> ';
    $blogListContent .= '<a href="/admin/blog-delete.php?id='.$a['id'].'" class="btn btn-danger btn-sm">Eliminar</a>';
    $blogListContent .= '</td>';
    $blogListContent .= '</tr>';
}
$blogListContent .= '</tbody></table>';

renderLayout('Lista de Blogs', $blogListContent);
