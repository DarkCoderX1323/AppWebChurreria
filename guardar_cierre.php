<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "1234";
$db_name = "appchurreriadb";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$usuario_id = $_SESSION["usuario_id"];
date_default_timezone_set('America/Lima'); // Zona horaria de Lima, Perú

$fechaHora = date("Y-m-d H:i:s"); // Fecha y hora actual

// Obtener saldo del asesor
$sql_saldo = "SELECT saldo FROM Usuario WHERE id = $usuario_id";
$result_saldo = $conn->query($sql_saldo);
$row_saldo = $result_saldo->fetch_assoc();
$saldo_final = $row_saldo["saldo"];

// Insertar el cierre en la tabla
$sql_insert_cierre = "INSERT INTO cierre_caja (saldo_final, id_usuario, fecha_hora) VALUES ($saldo_final, $usuario_id, '$fechaHora')";

if ($conn->query($sql_insert_cierre) === TRUE) {
    // Actualizar saldo del asesor a 0
    $sql_actualizar_saldo = "UPDATE Usuario SET saldo = 0 WHERE id = $usuario_id";
    if ($conn->query($sql_actualizar_saldo) === TRUE) {
        echo "success"; // Éxito en el cierre de caja y actualización de saldo
    } else {
        echo "error"; // Error al actualizar el saldo del asesor
    }
} else {
    echo "error"; // Error al insertar el cierre en la tabla
}

$conn->close();
?>
