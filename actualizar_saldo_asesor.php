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

if (isset($_GET["monto"])) {
    $monto = $_GET["monto"];
    $usuario_id = $_SESSION["usuario_id"];

    $sql_actualizar_saldo = "UPDATE Usuario SET saldo = saldo + $monto WHERE id = $usuario_id";
    if ($conn->query($sql_actualizar_saldo) === TRUE) {
        echo "Saldo actualizado correctamente.";
    } else {
        echo "Error al actualizar el saldo del asesor: " . $conn->error;
    }
} else {
    echo "No se proporcionó el monto para actualizar el saldo.";
}

$conn->close();
?>
