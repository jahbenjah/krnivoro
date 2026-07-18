<?php
// Archivo: config.php
// Centraliza las credenciales de conexión a la base de datos

define('DB_HOST', 'localhost');
define('DB_NAME', 'javie320_krnivoro');
define('DB_USER', 'javie320_krnivoro'); 
define('DB_PASS', 'javie320_Krn1v@r@.c@m'); 

function getPDO() {
    try {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        return new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // Diagnóstico: Captura el error sin exponer credenciales
        error_log("Error de conexión PDO: " . $e->getMessage());
        return null; 
    }
}