<!DOCTYPE html>
<html>
<head>
    <title>Menú Principal</title>
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

    <div class="articulos">
        <?php
        // Consulta para obtener los artículos de la base de datos
        $sql_articulos = "SELECT * FROM Articulo";
        $result_articulos = $conn->query($sql_articulos);

        if ($result_articulos->num_rows > 0) {
            while ($row_articulo = $result_articulos->fetch_assoc()) {
                $nombre_articulo = $row_articulo["nombre"];
                $precio_articulo = $row_articulo["precio"];
                $stock_articulo = $row_articulo["stock"];
                $imagen_articulo = $row_articulo["imagen"];

                echo '<div class="articulo" onclick="agregarArticulo(\'' . $nombre_articulo . '\', ' . $precio_articulo . ', ' . $stock_articulo . ')">';
                echo '<img src="' . $imagen_articulo . '" alt="' . $nombre_articulo . '">';
                echo '<h4>' . $nombre_articulo . '</h4>';
                echo '<p>Precio: $' . number_format($precio_articulo, 2) . '</p>';
                echo '<p>Stock: ' . $stock_articulo . '</p>';
                echo '</div>';
            }
        } else {
            echo "No hay artículos disponibles.";
        }
        ?>
    </div>

    <div class="cola">
        <h3>Cola de Compras</h3>
        <ul id="cola-list">
        </ul>
        <div class="total" id="total">Total: $0.00</div>
        <button onclick="eliminarItem()">Eliminar Item</button>
        <button onclick="realizarVenta()">Realizar Venta</button>
    </div>

    <script>
        var cola = [];
        var total = 0;

        function agregarArticulo(nombre, precio, stock) {
            if (stock > 0) {
                cola.push({ nombre: nombre, precio: precio });
                total += precio;
                stock--;
                actualizarCola();
            }
        }

        function actualizarCola() {
            var colaList = document.getElementById("cola-list");
            colaList.innerHTML = "";

            for (var i = 0; i < cola.length; i++) {
                var item = cola[i];
                var listItem = document.createElement("li");
                listItem.innerText = item.nombre + " - $" + item.precio.toFixed(2);
                colaList.appendChild(listItem);
            }

            var totalElement = document.getElementById("total");
            totalElement.innerText = "Total: $" + total.toFixed(2);
        }

        function eliminarItem() {
            if (cola.length > 0) {
                var itemEliminado = cola.pop();
                total -= itemEliminado.precio;
                actualizarCola();
            }
        }

        function realizarVenta() {
            // Aquí podrías enviar la cola de compras y el total a una página de procesamiento
            // utilizando AJAX u otras tecnologías.
            alert("Venta realizada con éxito.");
            cola = [];
            total = 0;
            actualizarCola();
        }

        // Manejo del menú de operaciones
        const operationsMenu = document.querySelector(".operations");
        const operationsSubMenu = operationsMenu.querySelector(".operations-menu");
        
        operationsMenu.addEventListener("click", () => {
            operationsMenu.classList.toggle("active");
        });
        
        // Mostrar la hora en tiempo real
        function updateClock() {
            const currentTime = new Date();
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const seconds = currentTime.getSeconds();
            
            const formattedTime = `${hours}:${addLeadingZero(minutes)}:${addLeadingZero(seconds)}`;
            
            document.querySelector(".clock").textContent = formattedTime;
        }
        
        function addLeadingZero(number) {
            return number < 10 ? "0" + number : number;
        }
        
        setInterval(updateClock, 1000); // Actualizar cada segundo
    </script>
</body>
</html>
