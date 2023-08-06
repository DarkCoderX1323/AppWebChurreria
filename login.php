<?php
// Incluir la conexión a la base de datos
include 'conexion.php'; // Asegúrate de tener un archivo 'conexion.php' con la configuración de la conexión

// Inicializar las variables para almacenar los mensajes de alerta
$mensaje = '';
$tipoMensaje = '';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        if (password_verify($password, $fila["password"])) {
            // Credenciales válidas, redirigir al menú principal
            session_start();
            $_SESSION["usuario_id"] = $fila["id"];
            header("Location: menu_principal.php");
            exit();
        } else {
            $mensaje = 'Contraseña incorrecta';
            $tipoMensaje = 'error';
        }
    } else {
        $mensaje = 'Usuario no encontrado';
        $tipoMensaje = 'error';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <?php if ($mensaje !== ''): ?>
        <div class="<?php echo $tipoMensaje; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    <form method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
