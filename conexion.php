<?php
// Configuración de conexión para servidor local XAMPP
$servidor   = "localhost";
$usuario    = "root";
$password   = "";
$base_datos = "tienda_libros";

// Crear instancia de conexión MySQLi
$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar si ocurrió un error de conexión
if ($conn->connect_error) {
    die("Error de conexión con la base de datos: " . $conn->connect_error);
}

// Establecer codificación UTF-8 para caracteres especiales y acentos
$conn->set_charset("utf8mb4");
?>
