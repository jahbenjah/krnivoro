<?php
// Archivo: config.php
// Centraliza las credenciales de conexión a la base de datos

define('DB_HOST', 'localhost');
define('DB_NAME', 'javie320_krnivoro');
define('DB_USER', 'javie320_krnivoro'); 
define('DB_PASS', 'javie320_Krn1v@r@.c@m'); 

function getPDO() {
    return new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS);
}
