<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__.'/../config.php';
require_once __DIR__.'/layout.php';
$pdo = getPDO();
$stmt = $pdo->prepare("SELECT rol, nombre, aprobado FROM Usuarios WHERE id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuario = $stmt->fetch();
$rol = $usuario['rol'] ?? 'directorio';
$nombre = $usuario['nombre'] ?? '';
$aprobado = $usuario['aprobado'] ?? 0;

$dashboardContent = '';
$dashboardContent .= '<h2>Bienvenido, '.htmlspecialchars($nombre).'</h2>';
$dashboardContent .= '<p>Panel de control de KRNIVORO.</p>';
if ($rol === 'admin') {
    $dashboardContent .= '<h4>Miembros pendientes de aprobación</h4>';
    $dashboardContent .= '<div id="pendientes-list" class="row"></div>';
    $dashboardContent .= '<script>
    async function cargarPendientes() {
        const res = await fetch("/api/usuarios.php");
        const usuarios = await res.json();
        const pendientes = usuarios.filter(u => u.aprobado == 0);
        const cont = document.getElementById("pendientes-list");
        cont.innerHTML = pendientes.map(u => `
            <div class="col-md-4 mb-3">
                <div class="card border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-warning">${u.nombre}</h5>
                        <p class="card-text">
                            <strong>${u.puesto || ""}</strong><br>
                            ${u.empresa || ""}<br>
                            ${u.ciudad || ""}, ${u.estado || ""}, ${u.pais || ""}
                        </p>
                        <a href="mailto:${u.email}" class="btn btn-success">Contactar</a>
                        <button class="btn btn-primary" onclick="aprobarUsuario(${u.id})">Aprobar</button>
                    </div>
                </div>
            </div>
        `).join("");
    }
    async function aprobarUsuario(id) {
        const res = await fetch("/api/usuarios.php?aprobar=1", {
            method: "PUT",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({id})
        });
        const result = await res.json();
        if (result.success) {
            cargarPendientes();
            alert("Miembro aprobado correctamente.");
        }
    }
    cargarPendientes();
    </script>';
}
renderLayout('Dashboard KRNIVORO', $dashboardContent);
?>
    <a href="/admin/logout.php">Salir</a>
    </div>
    <div class="main">
       
        <?php if ($rol === 'directorio' && !$aprobado): ?>
            <div class="alert alert-warning">Tu aplicación está en revisión. El equipo de KRNIVORO está revisando tus datos. Pronto recibirás una notificación.</div>
        <?php elseif ($rol === 'directorio'): ?>
            <h4>Directorio de Profesionales</h4>
            <form method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre, empresa o ciudad" value="<?php echo htmlspecialchars($_GET['buscar'] ?? ''); ?>">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            <?php
            session_start();
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: /admin/login.php');
                exit;
            }
            // Filtro: solo profesionales con rol 'directorio'
            $buscar = $_GET['buscar'] ?? '';
            $sql = "SELECT u.*, ui.imagen_base64 AS imagen FROM Usuarios u LEFT JOIN UsuarioImagenes ui ON u.id = ui.usuario_id WHERE u.rol = 'directorio' AND u.aprobado = 1";
            $params = [];
            if ($buscar) {
                $sql .= " AND (u.nombre LIKE ? OR u.empresa LIKE ? OR u.ciudad LIKE ?)";
                $params = ["%$buscar%", "%$buscar%", "%$buscar%"];
            }
            $stmtDir = $pdo->prepare($sql);
            $stmtDir->execute($params);
            $profesionales = $stmtDir->fetchAll();
            ?>
            <div class="row">
                <?php foreach ($profesionales as $pro): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                // Mostrar imagen de perfil en base64 si existe
                                if (!empty($pro['imagen'])) {
                                    echo '<img src="data:image/png;base64,'.htmlspecialchars($pro['imagen']).'" alt="Perfil" class="img-fluid rounded-circle mb-2" style="width:80px;height:80px;object-fit:cover;">';
                                }
                                ?>
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
