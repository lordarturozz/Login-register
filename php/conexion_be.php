<?php
$servidor = "localhost"; // O el nombre del servidor de tu base de datos
$usuario_bd = "root"; // Tu usuario de base de datos
$contrasena_bd = ""; // Tu contraseña de base de datos
$nombre_bd = "login_register_db"; // Nombre de la base de datos

// Crear conexión
$conexion = new mysqli($servidor, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8 para evitar problemas con caracteres especiales
$conexion->set_charset("utf8");
?>
