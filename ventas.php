<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ventas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos para la barra de navegación */
        .navbar {
            background-color: #FF1493; /* Color rosa tipo Barbie */
        }
        .navbar-text {
            color: white;
            padding-right: 15px;
        }
        .navbar-brand {
            padding: 0 15px;
        }
        .navbar-text {
            color: white;
            padding-right: 15px;
        }
        .operations {
            position: relative;
            cursor: pointer;
            color: white;
        }
        .operations-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: none;
            min-width: 160px;
        }
        .operations.active .operations-menu {
            display: block;
        }
        .operations-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .operations-menu li {
            padding: 10px 20px;
            border-bottom: 1px solid #e0e0e0;
            text-align: right;
            cursor: pointer;
        }
        .operations-menu li:last-child {
            border-bottom: none;
        }

        .clock {
            color: white;
            margin-right: 15px;
        }

        /* Estilos para los artículos */
        .articulos {
            display: flex;
            flex-wrap: wrap;
            width: 70%;
        }
        .articulo {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            width: 120px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .articulo:hover {
            background-color: #F5F5F5; /* Cambia el color de fondo al pasar el mouse */
        }

        .articulo img {
            max-width: 100%; /* Hace que la imagen se ajuste a su contenedor */
            height: auto;
        }

        /* Estilos para la cola de compras */
        .cola {
            width: 25%;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        .cola h3 {
            text-align: center;
        }
        .cola ul {
            list-style: none;
            padding: 0;
        }
        .cola li {
            margin-bottom: 10px;
        }
        .total {
            text-align: right;
            margin-top: 10px;
            font-weight: bold;
        }

        /* Estilos para los botones */
        .opciones {
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            background-color: #FF1493;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #FF007F; /* Cambia el color de fondo al pasar el mouse */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="https://clubfranquicia.pe/public/imagen/franquicia/club-franquicia-peru-q-churros-1505249847.png" alt="Logo de la empresa" height="40">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text clock"></span>
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

    $sql_usuario = "SELECT nombre, saldo FROM Usuario WHERE id = $usuario_id";
    $result_usuario = $conn->query($sql_usuario);

    if (isset($_SESSION["usuario_id"])) {
        $usuario_id = $_SESSION["usuario_id"];
        $sql_info_usuario = "SELECT nombre, saldo FROM Usuario WHERE id = $usuario_id";
        $result_info = $conn->query($sql_info_usuario);

        if ($result_info->num_rows > 0) {
            $row_info = $result_info->fetch_assoc();
            $nombre_usuario = $row_info["nombre"];
            $saldo_caja = $row_info["saldo"];
            echo "Hola, $nombre_usuario";
            echo "<br>";
            echo "Saldo: $" . number_format($saldo_caja, 2);
        }
    }
    ?>
             </span>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="menu_principal.php">Volver al Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Registro de Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cierre de Caja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="text-center">Lista de Ventas</h1>
        
        <?php
        $sql_ventas = "SELECT v.id, v.importe, v.fecha_hora, u.nombre AS nombre_usuario, v.documento_cliente 
                       FROM venta v
                       INNER JOIN usuario u ON v.id_usuario = u.id
                       ORDER BY v.fecha_hora DESC";

        $result_ventas = $conn->query($sql_ventas);

        if ($result_ventas->num_rows > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Importe</th>
                            <th>Fecha y Hora</th>
                            <th>Asesor</th>
                            <th>Documento Cliente</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            while ($row_venta = $result_ventas->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row_venta["id"] . '</td>
                        <td>' . $row_venta["importe"] . '</td>
                        <td>' . $row_venta["fecha_hora"] . '</td>
                        <td>' . $row_venta["nombre_usuario"] . '</td>
                        <td>' . $row_venta["documento_cliente"] . '</td>
                      </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p class="text-center">No hay ventas registradas.</p>';
        }
        ?>
    </div>
</body>
</html>