<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #330000;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 800 400'%3E%3Cdefs%3E%3CradialGradient id='a' cx='396' cy='281' r='514' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23D18'/%3E%3Cstop offset='1' stop-color='%23330000'/%3E%3C/radialGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='400' y1='148' x2='400' y2='333'%3E%3Cstop offset='0' stop-color='%23FF5AB9' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23FF5AB9' stop-opacity='0.5'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='800' height='400'/%3E%3Cg fill-opacity='0.4'%3E%3Ccircle fill='url(%23b)' cx='267.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='532.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='400' cy='30' r='300'/%3E%3C/g%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;
        }
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco transparente */
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Ancho máximo del recuadro */
            margin: 0 20px; /* Espaciado izquierdo y derecho para centrarlo */
        }
        .logo {
            width: 100px; /* Ajusta el tamaño del logo según sea necesario */
            height: auto;
            margin-bottom: 20px;
        }
        .welcome {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .login-form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
        }
        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        button {
            padding: 10px 20px;
            background-color: #FF1493; /* Rosa tipo Barbie para el botón */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #FF007F; /* Rosa oscuro cuando el cursor está sobre el botón */
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="https://clubfranquicia.pe/public/imagen/franquicia/club-franquicia-peru-q-churros-1505249847.png" alt="Logo de la empresa">
        <h2 class="welcome">Bienvenid@</h2>
        <form class="login-form" action="login.php" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
