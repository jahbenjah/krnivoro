<?php
// perfil.php - Página de perfil de usuario para KRNIVORO Admin
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}

$nombre = $_SESSION['nombre'] ?? 'Usuario';
$email = $_SESSION['email'] ?? '';
$rol = $_SESSION['rol'] ?? '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Perfil de Usuario</h2>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($rol); ?></p>
        <a href="/admin/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
</body>
</html>
