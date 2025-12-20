<?php
session_start();
header('Content-Type: application/json');

// Configuración de la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=krnivoro_db;charset=utf8mb4', 'krnivoro_db', 'Krnivoro.com1');

// Obtener método y datos
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

// LISTAR miembros del directorio
if ($method === 'GET') {
    $stmt = $pdo->query("SELECT id, nombre, email, telefono, puesto, empresa, ciudad, estado, pais, imagen, bio, rol, aprobado FROM Usuarios");
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
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo registrar el usuario.']);
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