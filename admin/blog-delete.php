<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
$pdo = new PDO('mysql:host=localhost;dbname=krnivoro_db;charset=utf8mb4', 'krnivoro_db', 'Krnivoro.com1');
$id = $_GET['id'] ?? null;
if ($id) {
    $pdo->prepare("DELETE FROM BlogArticulos WHERE id = ?")->execute([$id]);
}
header('Location: /admin/blog-list.php');
exit;
