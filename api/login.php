<?php

// Configuración de la base de datos
$host = 'localhost';
$db   = 'krnivoro_db';
$user = 'krnivoro_db';
$pass = 'Krnivoro.com1';
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
    if (!isset($data['email'], $data['password'])) {
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


// Si no coincide ningún método
http_response_code(405);
echo json_encode(['error' => 'Método no permitido']);
exit;