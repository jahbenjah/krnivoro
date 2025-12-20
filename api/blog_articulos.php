<?php
session_start();
header('Content-Type: application/json');

$pdo = new PDO('mysql:host=localhost;dbname=krnivoro_db;charset=utf8mb4', 'krnivoro_db', 'Krnivoro.com1');
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

// LISTAR artículos
if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM BlogArticulos ORDER BY fecha_publicacion DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

// CREAR artículo
if ($method === 'POST') {
    $required = ['titulo','autor','seccion','contenido'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios: ' . $field]);
            exit;
        }
    }
    $sql = "INSERT INTO BlogArticulos (titulo, autor, seccion, contenido, fecha_publicacion) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            $data['titulo'],
            $data['autor'],
            $data['seccion'],
            $data['contenido']
        ]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo crear el artículo.']);
    }
    exit;
}

// ACTUALIZAR artículo
if ($method === 'PUT') {
    if (empty($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el id del artículo']);
        exit;
    }
    $sql = "UPDATE BlogArticulos SET titulo=?, autor=?, seccion=?, contenido=?, actualizado_en=NOW() WHERE id=?";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            $data['titulo'],
            $data['autor'],
            $data['seccion'],
            $data['contenido'],
            $data['id']
        ]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo actualizar el artículo.']);
    }
    exit;
}

// ELIMINAR artículo
if ($method === 'DELETE') {
    if (empty($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el id del artículo']);
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM BlogArticulos WHERE id = ?");
    try {
        $stmt->execute([$data['id']]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(['error' => 'No se pudo eliminar el artículo.']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Método no permitido']);
