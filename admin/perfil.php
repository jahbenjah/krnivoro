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

$stmt = $pdo->prepare("SELECT u.*, ui.imagen_base64 AS imagen FROM Usuarios u LEFT JOIN UsuarioImagenes ui ON u.id = ui.usuario_id WHERE u.id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuario = $stmt->fetch();
$nombre = $usuario['nombre'] ?? 'Usuario';
$email = $usuario['email'] ?? '';
$rol = $usuario['rol'] ?? '';
$telefono = $usuario['telefono'] ?? '';
$puesto = $usuario['puesto'] ?? '';
$empresa = $usuario['empresa'] ?? '';
$ciudad = $usuario['ciudad'] ?? '';
$estado = $usuario['estado'] ?? '';
$pais = $usuario['pais'] ?? '';
$bio = $usuario['bio'] ?? '';
$imagen = $usuario['imagen'] ?? '';




$perfilContent = '<h2>Editar Perfil</h2>';
if (!empty($imagen)) {
    $perfilContent .= '<div class="mb-3 text-center"><img src="'.htmlspecialchars($imagen).'" alt="Perfil" class="rounded-circle" style="width:120px;height:120px;object-fit:cover;"></div>';
}
$perfilContent .= '<form id="editar-perfil" class="php-email-form" enctype="multipart/form-data" autocomplete="off">';
$perfilContent .= '<div class="row gy-3">';
$perfilContent .= '<div class="col-md-6"><label for="nombre" class="form-label visually-hidden">Nombre</label><input id="nombre" type="text" name="nombre" class="form-control" placeholder="Nombre" value="'.htmlspecialchars($nombre).'" required></div>';
$perfilContent .= '<div class="col-md-6"><label for="email" class="form-label visually-hidden">Email</label><input id="email" type="email" name="email" class="form-control" placeholder="Email" value="'.htmlspecialchars($email).'" required></div>';
$perfilContent .= '<div class="col-md-6"><label for="telefono" class="form-label visually-hidden">Teléfono</label><input id="telefono" type="text" name="telefono" class="form-control" placeholder="Teléfono" value="'.htmlspecialchars($telefono).'" required></div>';
$perfilContent .= '<div class="col-md-6"><label for="puesto" class="form-label visually-hidden">Puesto</label><input id="puesto" type="text" name="puesto" class="form-control" placeholder="Puesto" value="'.htmlspecialchars($puesto).'" required></div>';
$perfilContent .= '<div class="col-md-6"><label for="empresa" class="form-label visually-hidden">Empresa</label><input id="empresa" type="text" name="empresa" class="form-control" placeholder="Empresa" value="'.htmlspecialchars($empresa).'" required></div>';
$perfilContent .= '<div class="col-md-6"><label for="ciudad" class="form-label visually-hidden">Ciudad</label><input id="ciudad" type="text" name="ciudad" class="form-control" placeholder="Ciudad" value="'.htmlspecialchars($ciudad).'" required></div>';
$perfilContent .= '<div class="col-md-6"><label for="estado" class="form-label visually-hidden">Estado</label><input id="estado" type="text" name="estado" class="form-control" placeholder="Estado" value="'.htmlspecialchars($estado).'" required></div>';
$perfilContent .= '<div class="col-md-6"><label for="pais" class="form-label visually-hidden">País</label><input id="pais" type="text" name="pais" class="form-control" placeholder="País" value="'.htmlspecialchars($pais).'" required></div>';
$perfilContent .= '<div class="col-12"><label for="bio" class="form-label">Biografía / Servicios (opcional)</label><textarea id="bio" name="bio" rows="3" class="form-control" placeholder="Descripción breve">'.htmlspecialchars($bio).'</textarea></div>';
$perfilContent .= '<div class="col-md-8"><label for="imagen_file" class="form-label">Subir imagen de perfil (opcional)</label><input id="imagen_file" name="imagen_file" type="file" accept="image/*" class="form-control"></div>';
$perfilContent .= '<div class="col-12 text-center"><div class="loading" style="display:none;">Cargando</div><div class="error-message"></div><div class="sent-message" style="display:none;">¡Perfil actualizado!</div><button type="submit" class="btn btn-primary btn-lg mt-2">Guardar Cambios</button></div>';
$perfilContent .= '</div></form>';
$perfilContent .= '<a href="/admin/dashboard.php" class="btn btn-secondary mt-3">Volver al Dashboard</a>';

renderLayout('Editar Perfil', $perfilContent);
