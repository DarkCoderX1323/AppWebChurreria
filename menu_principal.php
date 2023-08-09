<!DOCTYPE html>
<html>
<head>
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Estilos para la barra de navegación */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FF1493; /* Color rosa tipo Barbie */
            color: white;
            padding: 10px 20px;
        }
        .logo {
            width: 80px; /* Ajusta el tamaño del logo según sea necesario */
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-icon {
            margin-right: 10px;
            font-size: 20px;
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
    <div class="navbar">
        <img class="logo" src="logo.png" alt="Logo de la empresa">
        <div class="user-info">
            <div class="user-icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <?php
                // Conexión a la base de datos y consulta del nombre del usuario y saldo
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "1234";
                $db_name = "appchurreriadb";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                $nombre_usuario = "Nombre Usuario"; // Valor por defecto si no se puede obtener de la base de datos
                $saldo_caja = 0.00; // Valor por defecto si no se puede obtener de la base de datos

                // Consulta para obtener el nombre del usuario y el saldo de la caja
                $sql = "SELECT nombre, saldo FROM Usuario WHERE id = 1"; // Cambia el 1 por el ID del usuario en sesión
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nombre_usuario = $row["nombre"];
                    $saldo_caja = $row["saldo"];
                }

                echo "Hola, $nombre_usuario";
                ?>
                <br>
                Saldo: $<?php echo number_format($saldo_caja, 2); ?>
            </div>
        </div>
    </div>

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
    </script>
</body>
</html>
