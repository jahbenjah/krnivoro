<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__.'/config.php';
$pdo = getPDO();

// Obtener método y datos
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

// LISTAR miembros del directorio
if ($method === 'GET') {
    $stmt = $pdo->query("SELECT u.id, u.nombre, u.email, u.telefono, u.puesto, u.empresa, u.ciudad, u.estado, u.pais, ui.imagen_base64 AS imagen, u.bio, u.rol, u.aprobado FROM Usuarios u LEFT JOIN UsuarioImagenes ui ON u.id = ui.usuario_id WHERE u.rol = 'directorio'");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

// REGISTRAR nuevo miembro (aprobado=0 por defecto)
if ($method === 'POST') {
    // Validación backend
    $required = ['nombre','email','password','telefono','puesto','empresa','ciudad','estado','pais'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios: ' . $field]);
            exit;
        }
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['error' => 'El email no es válido.']);
        exit;
    }
    if (!preg_match('/^[0-9\-\+\s]{7,20}$/', $data['telefono'])) {
        http_response_code(400);
        echo json_encode(['error' => 'El teléfono no es válido.']);
        exit;
    }
    // Puedes agregar más validaciones aquí (longitud, caracteres, etc.)
    $password_hash = password_hash($data['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO Usuarios (nombre, email, password_hash, telefono, puesto, empresa, ciudad, estado, pais, imagen, bio, rol, aprobado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'directorio', 0)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            $data['nombre'],
            $data['email'],
            $password_hash,
            $data['telefono'] ?? null,
            $data['puesto'] ?? null,
            $data['empresa'] ?? null,
            $data['ciudad'] ?? null,
            $data['estado'] ?? null,
            $data['pais'] ?? null,
            $data['imagen'] ?? null,
            $data['bio'] ?? null
        ]);
        $usuario_id = $pdo->lastInsertId();
        // Guardar imagen base64 si existe
        if (!empty($data['imagen_base64'])) {
            $stmtImg = $pdo->prepare("INSERT INTO UsuarioImagenes (usuario_id, imagen_base64) VALUES (?, ?)");
            $stmtImg->execute([$usuario_id, $data['imagen_base64']]);
        }
        echo json_encode(['success' => true, 'id' => $usuario_id]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode([
            'error' => 'No se pudo registrar el usuario.',
            'motivo' => $e->getMessage(),
            'sqlstate' => $e->getCode(),
            'query' => $sql,
            'datos' => [
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'puesto' => $data['puesto'],
                'empresa' => $data['empresa'],
                'ciudad' => $data['ciudad'],
                'estado' => $data['estado'],
                'pais' => $data['pais']
            ]
        ]);
    }
    exit;
}

// APROBAR miembro (solo admin, requiere id)
if ($method === 'PUT' && isset($_GET['aprobar'])) {
    // Aquí deberías validar que el usuario logueado es admin
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el id del usuario']);
        exit;
    }
    $stmt = $pdo->prepare("UPDATE Usuarios SET aprobado = 1 WHERE id = ?");
    $stmt->execute([$data['id']]);
    echo json_encode(['success' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Método no permitido']);