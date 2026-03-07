<?php
// Archivo: config.php
// Centraliza las credenciales de conexión a la base de datos

define('DB_HOST', 'localhost');
define('DB_NAME', 'karnivor_krnivoro');
define('DB_USER', 'karnivor_krnivoro'); 
define('DB_PASS', 'karnivor_krnivoro01'); 

def function getPDO() {
    return new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS);
}
