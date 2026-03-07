<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
require_once __DIR__.'/layout.php';
$pdo = getPDO();
$id = $_GET['id'] ?? null;
if (!$id) { header('Location: /admin/blog-list.php'); exit; }
$stmt = $pdo->prepare("SELECT a.*, c.nombre AS categoria FROM BlogArticulos a LEFT JOIN BlogCategorias c ON a.categoria_id = c.id WHERE a.id = ?");
$stmt->execute([$id]);
$articulo = $stmt->fetch();

$view = '<h2>'.htmlspecialchars($articulo['titulo']).'</h2>';
$view .= '<p><strong>Categoría:</strong> '.htmlspecialchars($articulo['categoria']).'</p>';
$view .= '<p><strong>Autor:</strong> '.htmlspecialchars($articulo['autor']).'</p>';
$view .= '<p><strong>Fecha:</strong> '.htmlspecialchars($articulo['fecha_publicacion']).'</p>';
$view .= '<hr>';
$view .= '<div>'.nl2br(htmlspecialchars($articulo['contenido'])).'</div>';
$view .= '<hr>';
$view .= '<p><strong>SEO Title:</strong> '.htmlspecialchars($articulo['seo_title']).'</p>';
$view .= '<p><strong>SEO Description:</strong> '.htmlspecialchars($articulo['seo_description']).'</p>';
$view .= '<a href="/admin/blog-edit.php?id='.$articulo['id'].'" class="btn btn-warning">Editar</a> ';
$view .= '<a href="/admin/blog-list.php" class="btn btn-secondary">Volver a la lista</a>';

renderLayout(htmlspecialchars($articulo['titulo']), $view);
