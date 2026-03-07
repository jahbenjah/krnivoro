<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=krnivoro_db;charset=utf8mb4', 'krnivoro_db', 'Krnivoro.com1');
$stmt = $pdo->prepare("SELECT rol, nombre, aprobado FROM Usuarios WHERE id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuario = $stmt->fetch();
$rol = $usuario['rol'] ?? 'directorio';
$nombre = $usuario['nombre'] ?? '';
$aprobado = $usuario['aprobado'] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard KRNIVORO</title>
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
        <a href="/admin/directorio.php">Directorio</a>
        <?php if ($rol === 'admin'): ?>
            <a href="/admin/blog.php">Blog</a>
            <h4>Miembros pendientes de aprobación</h4>
            <div id="pendientes-list" class="row"></div>
            <script>
            async function cargarPendientes() {
                const res = await fetch('/api/usuarios.php');
                const usuarios = await res.json();
                const pendientes = usuarios.filter(u => u.aprobado == 0);
                const cont = document.getElementById('pendientes-list');
                cont.innerHTML = pendientes.map(u => `
                    <div class='col-md-4 mb-3'>
                        <div class='card border-warning'>
                            <div class='card-body'>
                                <h5 class='card-title text-warning'>${u.nombre}</h5>
                                <p class='card-text'>
                                    <strong>${u.puesto || ''}</strong><br>
                                    ${u.empresa || ''}<br>
                                    ${u.ciudad || ''}, ${u.estado || ''}, ${u.pais || ''}
                                </p>
                                <a href='mailto:${u.email}' class='btn btn-success'>Contactar</a>
                                <button class='btn btn-primary' onclick='aprobarUsuario(${u.id})'>Aprobar</button>
                            </div>
                        </div>
                    </div>
                `).join('');
            }
            async function aprobarUsuario(id) {
                const res = await fetch('/api/usuarios.php?aprobar=1', {
                    method: 'PUT',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({id})
                });
                const result = await res.json();
                if (result.success) {
                    cargarPendientes();
                    alert('Miembro aprobado correctamente.');
                }
            }
            cargarPendientes();
            </script>
        <?php endif; ?>
        <a href="/admin/logout.php">Salir</a>
    </div>
    <div class="main">
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre); ?>!</h2>
        <p>Panel de administración KRNIVORO.</p>
        <hr>
        <?php if ($rol === 'directorio' && !$aprobado): ?>
            <div class="alert alert-warning">Tu aplicación está en revisión. El equipo de KRNIVORO está revisando tus datos. Pronto recibirás una notificación.</div>
        <?php elseif ($rol === 'directorio'): ?>
            <h4>Directorio de Profesionales</h4>
            <form method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre, empresa o ciudad" value="<?php echo htmlspecialchars($_GET['buscar'] ?? ''); ?>">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
            <?php
            $query = "SELECT nombre, puesto, empresa, ciudad, estado, pais, email FROM Usuarios WHERE aprobado = 1";
            $params = [];
            if (!empty($_GET['buscar'])) {
                $query .= " AND (nombre LIKE ? OR empresa LIKE ? OR ciudad LIKE ?)";
                $busqueda = '%' . $_GET['buscar'] . '%';
                $params = [$busqueda, $busqueda, $busqueda];
            }
            $stmtDir = $pdo->prepare($query);
            $stmtDir->execute($params);
            $profesionales = $stmtDir->fetchAll();
            ?>
            <div class="row">
                <?php foreach ($profesionales as $pro): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($pro['nombre']); ?></h5>
                                <p class="card-text">
                                    <strong><?php echo htmlspecialchars($pro['puesto']); ?></strong><br>
                                    <?php echo htmlspecialchars($pro['empresa']); ?><br>
                                    <?php echo htmlspecialchars($pro['ciudad']); ?>, <?php echo htmlspecialchars($pro['estado']); ?>, <?php echo htmlspecialchars($pro['pais']); ?>
                                </p>
                                <a href="mailto:<?php echo htmlspecialchars($pro['email']); ?>" class="btn btn-success">Contactar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Usa el menú lateral para navegar.</p>
        <?php endif; ?>
    </div>
</body>
</html>
