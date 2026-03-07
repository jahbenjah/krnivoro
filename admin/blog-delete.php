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
if ($id) {
    $pdo->prepare("DELETE FROM BlogArticulos WHERE id = ?")->execute([$id]);
    $content = '<div class="alert alert-success">Artículo eliminado correctamente.</div>';
    $content .= '<a href="/admin/blog-list.php" class="btn btn-primary">Volver a la lista</a>';
    renderLayout('Eliminar Blog', $content);
    exit;
}
header('Location: /admin/blog-list.php');
exit;
