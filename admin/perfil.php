<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
require_once __DIR__.'/layout.php';
$pdo = getPDO();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
$stmt = $pdo->prepare("SELECT nombre, email, rol FROM Usuarios WHERE id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuario = $stmt->fetch();
$nombre = $usuario['nombre'] ?? 'Usuario';
$email = $usuario['email'] ?? '';
$rol = $usuario['rol'] ?? '';

$perfilContent = '';
$perfilContent .= '<h2>Perfil de Usuario</h2>';
$perfilContent .= '<p><strong>Nombre:</strong> '.htmlspecialchars($nombre).'</p>';
$perfilContent .= '<p><strong>Email:</strong> '.htmlspecialchars($email).'</p>';
$perfilContent .= '<p><strong>Rol:</strong> '.htmlspecialchars($rol).'</p>';
$perfilContent .= '<a href="/admin/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>';

renderLayout('Perfil de Usuario', $perfilContent);
