<?php
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "krnivoro_db", "Krnivoro.com1", "krnivoro_db");
if ($mysqli->connect_errno) {
    echo json_encode(["error" => "Fallo conexión"]);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';

function safe($str) { global $mysqli; return $mysqli->real_escape_string($str); }

if ($action === 'create') {
    $sql = "INSERT INTO directorio (nombre, puesto, empresa, ciudad, estado, pais, email, telefono, imagen)
            VALUES ('".safe($data['nombre'])."', '".safe($data['puesto'])."', '".safe($data['empresa'])."', '".safe($data['ciudad'])."', '".safe($data['estado'])."', '".safe($data['pais'])."', '".safe($data['email'])."', '".safe($data['telefono'])."', '".safe($data['imagen'])."')";
    $res = $mysqli->query($sql);
    echo json_encode(["success" => $res, "id" => $mysqli->insert_id]);
}
elseif ($action === 'read') {
    $id = isset($data['id']) ? intval($data['id']) : null;
    $sql = $id ? "SELECT * FROM directorio WHERE id=$id" : "SELECT * FROM directorio";
    $res = $mysqli->query($sql);
    $rows = [];
    while ($row = $res->fetch_assoc()) $rows[] = $row;
    echo json_encode($rows);
}
elseif ($action === 'update') {
    $id = intval($data['id']);
    $sets = [];
    foreach (['nombre','puesto','empresa','ciudad','estado','pais','email','telefono','imagen'] as $f) {
        if (isset($data[$f])) $sets[] = "$f='".safe($data[$f])."'";
    }
    $sql = "UPDATE directorio SET ".implode(',', $sets)." WHERE id=$id";
    $res = $mysqli->query($sql);
    echo json_encode(["success" => $res]);
}
elseif ($action === 'delete') {
    $id = intval($data['id']);
    $sql = "DELETE FROM directorio WHERE id=$id";
    $res = $mysqli->query($sql);
    echo json_encode(["success" => $res]);
}
else {
    echo json_encode(["error" => "Acción no válida"]);
}
$mysqli->close();
?>