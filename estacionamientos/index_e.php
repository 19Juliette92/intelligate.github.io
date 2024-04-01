<?php
include_once("../config.php");
$result = $dbConn->query("SELECT * FROM estacionamientos");

require '../login/config.php';
if (empty($_SESSION['nombre_usuario']))
    header('Location: ../login/login.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <title> Listado de parqueaderos</title>
    <link rel="stylesheet" href="../css/estilosPagPrincipal.css">
</head>

<body>
    <header class="cabecera-pagina">
        <img src="../img/Intelligate_logo.jpg" alt="Logo de INTELLIGATE" class="logo-cabecera">
        <div class="contenedor_dashboard_info">
            <div class="caja_info_dashboard">
                <?php
                if (isset($errMsg)) {
                    echo '<div class="mensaje-error">' . $errMsg . '</div>';
                }
                ?>
                <div class="contenido_dashboard">
                    <div class="encabezado_dashboard">
                        <div class="titulo_encabezado_dashboard"><?php echo $_SESSION['nombre_usuario']; ?></div>
                    </div>
                    <div class="cuerpo_dashboard">
                        Bienvenido <?php echo $_SESSION['nombre_usuario']; ?><br><br>
                        <a href="../login/update.php">Actualizar</a>
                        <a href="../login/logout.php">Salir</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="enlaces-crud">
        <a href="add_e.html">Ingresar parqueadero</a>
        <a href="../paginaprincipal.php">Volver</a>
    </div>
    <table>
        <tr>
            <th>Persona</th>
            <th>placa</th>
            <th>Inmueble</th>
            <th>Usuario</th>
            <th>Número estacionamiento</th>
            <th>Acción</th>
        </tr>
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id_titular'] . "</td>";
            echo "<td>" . $row['placa'] . "</td>";
            echo "<td>" . $row['id_inmueble'] . "</td>";
            echo "<td>" . $row['id_usuario'] . "</td>";
            echo "<td>" . $row['no_parqueadero'] . "</td>";

            echo "<td><a href=\"edit_e.php?id_estacionamiento=$row[id_estacionamiento]\">Editar</a> | <a href=\"delete_e.php?id_estacionamiento=$row[id_estacionamiento]\"
onClick=\"return confirm('Esta seguro de eliminar el registro?')\">Eliminar</a></td>";
        }
        ?>
    </table>
</body>

</html>