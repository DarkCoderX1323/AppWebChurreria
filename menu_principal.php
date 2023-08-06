<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

// Aquí puedes mostrar el contenido del menú principal
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menú Principal</title>
</head>
<body>
    <h1>Bienvenido al menú principal</h1>
    <p>Contenido del menú...</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
