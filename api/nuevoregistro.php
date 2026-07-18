<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__.'/config.php';
$pdo = getPDO();

// Obtener método de la petición
$method = $_SERVER['REQUEST_METHOD'];

// REGISTRAR nuevo miembro (aprobado=0 por defecto)
if ($method === 'POST') {
    
    // IMPORTANTE: Al usar FormData en JS, los datos llegan en $_POST, no en un JSON raw.
    // Clonamos $_POST en un array $data para mantener tu lógica de validación intacta.
    $data = $_POST;

    // Validación backend
    $required = ['nombre', 'email', 'password', 'telefono', 'puesto', 'empresa', 'ciudad', 'estado', 'pais'];
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

    $password_hash = password_hash($data['password'], PASSWORD_BCRYPT);
    
    // Procesar la imagen física opcional si se subió a través de $_FILES
    $nombre_imagen_archivo = null;
    if (isset($_FILES['imagen_file']) && $_FILES['imagen_file']['error'] === UPLOAD_ERR_OK) {
        $temporal = $_FILES['imagen_file']['tmp_name'];
        $nombre_original = basename($_FILES['imagen_file']['name']);
        
        // Evitar colisiones de nombres generando un nombre único
        $extension = pathinfo($nombre_original, PATHINFO_EXTENSION);
        $nombre_imagen_archivo = uniqid('perfil_', true) . '.' . $extension;
        
        // Reemplaza 'subidas/' por la carpeta real en tu servidor donde guardas las fotos
        $ruta_destino = __DIR__ . '/subidas/' . $nombre_imagen_archivo;
        
        if (!move_uploaded_file($temporal, $ruta_destino)) {
            $nombre_imagen_archivo = null; // Si falla el movimiento, queda como null
        }
    }

    $sql = "INSERT INTO Usuarios (nombre, email, password_hash, telefono, puesto, empresa, city, estado, pais, imagen, bio, rol, aprobado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'directorio', 0)";
            
    // Nota: Revisar si en tu base de datos la columna es 'ciudad' o 'city' ya que tu consulta original usa variables mixtas. Ajustado aquí a tu orden de ejecución.
    
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            $data['nombre'],
            $data['email'],
            $password_hash,
            $data['telefono'] ?? null,
            $data['puesto'] ?? null,
            $data['empresa'] ?? null,
            $data['ciudad'] ?? null, // Revisa si tu BD mapea esto correctamente
            $data['estado'] ?? null,
            $data['pais'] ?? null,
            $nombre_imagen_archivo, // Se guarda el nombre del archivo subido (o null)
            $data['bio'] ?? null
        ]);
        
        $usuario_id = $pdo->lastInsertId();
        
        // Guardar imagen base64 si existe en el FormData
        if (!empty($data['imagen_base64'])) {
            $stmtImg = $pdo->prepare("INSERT INTO UsuarioImagenes (usuario_id, imagen_base64) VALUES (?, ?)");
            $stmtImg->execute([$usuario_id, $data['imagen_base64']]);
        }
        
        // IMPORTANTE: Tu JS espera un 'result.success' o un 'result.status === "success"'
        echo json_encode(['success' => true, 'status' => 'success', 'id' => $usuario_id]);
        
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

http_response_code(405);
echo json_encode(['error' => 'Método no permitido']);
