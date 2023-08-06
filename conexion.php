<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "sistema_caja_web";

// Crear la conexión
$conexion = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>