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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $importe = $_POST["importe"];
    $usuarioId = $_SESSION["usuario_id"];
    $documentoCliente = $_POST["documento_cliente"];

    // Establecer la zona horaria a la de tu sistema Windows
    date_default_timezone_set('America/Lima'); // Ejemplo: 'America/New_York'

    // Obtener la hora actual del sistema en formato MySQL
    $currentDateTime = date("Y-m-d H:i:s");

    $sql_insert_venta = "INSERT INTO venta (importe, fecha_hora, id_usuario, documento_cliente) VALUES ('$importe', '$currentDateTime', '$usuarioId', '$documentoCliente')";

    if ($conn->query($sql_insert_venta) === TRUE) {
        echo "Venta guardada con éxito.";
    } else {
        echo "Error al guardar la venta: " . $conn->error;
    }
}

$conn->close();
?>
