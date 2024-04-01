<?php
include_once("../config.php");
$result = $dbConn->query("SELECT inmuebles.*,
personas.nombres, personas.apellidos
FROM inmuebles
INNER JOIN personas ON inmuebles.id_titular = personas.id_titular");

require '../login/config.php';
if (empty($_SESSION['nombre_usuario']))
    header('Location: ../login/login.php');

?>

<html>

<head>
    <meta charset="UTF-8">
    <title> Listado de inmuebles</title>
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
                        <a href="login/update.php">Actualizar</a>
                        <a href="login/logout.php">Salir</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="enlaces-crud">
        <a href="add_i.html">Ingresar inmueble</a>
        <a href="../paginaprincipal.php">Volver</a>
    </div>

    <table>
        <tr>
            <th>Bloque</th>
            <th>Apartamento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Accion</th>
        </tr>
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['bloque'] . "</td>";
            echo "<td>" . $row['apto'] . "</td>";
            echo "<td>" . $row['nombres'] . "</td>";
            echo "<td>" . $row['apellidos'] . "</td>";

            echo "<td><a href=\"edit_i.php?id_inmueble=$row[id_inmueble]\">Editar</a> | <a href=\"delete_i.php?id_inmueble=$row[id_inmueble]\"
onClick=\"return confirm('Esta seguro de eliminar el registro?')\">Eliminar</a></td>";
        }
        ?>
    </table>
</body>

</html>