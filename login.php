<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "1234";
$db_name = "appchurreriadb";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT id, password FROM Usuario WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stored_password = $row["password"];
    if ($password === $stored_password) {
        // Las credenciales son válidas, redirigir al menú principal
        header("Location: menu_principal.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}

$conn->close();
?>
