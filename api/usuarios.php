<?php

// Configuración de la base de datos
$host = 'localhost';
$db   = 'adrosari_propiedades';
$user = 'adrosari_paginaweb';
$pass = 'password_db';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión a la base de datos']);
    exit;
}

// Función para obtener datos del body (JSON)
function getJsonInput() {
    return json_decode(file_get_contents('php://input'), true);
}

// CRUD

$method = $_SERVER['REQUEST_METHOD'];

// CREATE usuario
if ($method === 'POST') {
    $data = getJsonInput();
    if (!isset($data['nombre'], $data['email'], $data['password'], $data['telefono'], $data['rol'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Faltan campos obligatorios']);
        exit;
    }
    // Hash de la contraseña
    $password_hash = password_hash($data['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO Usuarios (nombre, email, password_hash, telefono, rol) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            $data['nombre'],
            $data['email'],
            $password_hash,
            $data['telefono'],
            $data['rol']
        ]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo crear el usuario.']);
    }
    exit;
}

// READ usuarios (todos o uno)
if ($method === 'GET') {
    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT id, nombre, email, telefono, rol, creado_en FROM Usuarios WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $usuario = $stmt->fetch();
        if ($usuario) {
            echo json_encode($usuario);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
    } else {
        $stmt = $pdo->query("SELECT id, nombre, email, telefono, rol, creado_en FROM Usuarios");
        echo json_encode($stmt->fetchAll());
    }
    exit;
}

// UPDATE usuario
if ($method === 'PUT') {
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el parámetro id']);
        exit;
    }
    $data = getJsonInput();
    $campos = [];
    $params = [];

    if (isset($data['nombre'])) {
        $campos[] = "nombre = ?";
        $params[] = $data['nombre'];
    }
    if (isset($data['email'])) {
        $campos[] = "email = ?";
        $params[] = $data['email'];
    }
    if (isset($data['password'])) {
        $campos[] = "password_hash = ?";
        $params[] = password_hash($data['password'], PASSWORD_BCRYPT);
    }
    if (isset($data['telefono'])) {
        $campos[] = "telefono = ?";
        $params[] = $data['telefono'];
    }
    if (isset($data['rol'])) {
        $campos[] = "rol = ?";
        $params[] = $data['rol'];
    }

    if (empty($campos)) {
        http_response_code(400);
        echo json_encode(['error' => 'No hay campos para actualizar']);
        exit;
    }

    $params[] = $_GET['id'];
    $sql = "UPDATE Usuarios SET " . implode(', ', $campos) . " WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute($params);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo actualizar el usuario.']);
    }
    exit;
}

// DELETE usuario
if ($method === 'DELETE') {
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el parámetro id']);
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM Usuarios WHERE id = ?");
    try {
        $stmt->execute([$_GET['id']]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo eliminar el usuario.']);
    }
    exit;
}

// Si no coincide ningún método
http_response_code(405);
echo json_encode(['error' => 'Método no permitido']);
exit;