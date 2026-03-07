<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
$pdo = getPDO();
$id = $_GET['id'] ?? null;
if ($id) {
    $pdo->prepare("DELETE FROM BlogArticulos WHERE id = ?")->execute([$id]);
}
header('Location: /admin/blog-list.php');
exit;
