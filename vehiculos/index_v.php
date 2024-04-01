<?php
include_once("../config.php");
$result = $dbConn->query("SELECT vehiculos.*, 
tipos.nombre_tipo, personas.nombres, personas.apellidos 
FROM vehiculos 
INNER JOIN tipos ON vehiculos.tipo_vehiculo = tipos.id_tipo
INNER JOIN personas ON vehiculos.id_conductor = personas.id_persona");

require '../login/config.php';
if (empty($_SESSION['nombre_usuario']))
    header('Location: ../login/login.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <title> Listado de vehiculos</title>
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
        <a href="addv_html.php">Ingresar vehiculo</a>
        <a href="../paginaprincipal.php">Volver</a>
    </div>

    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <th>Placa</th>
            <th>Nombres propietario</th>
            <th>Apellidos propietario</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Tipo de vehículo</th>
            <th>Fecha de registro</th>
            <th>Acción</th>
        </tr>
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['placa'] . "</td>";
            echo "<td>" . $row['nombres'] . "</td>";
            echo "<td>" . $row['apellidos'] . "</td>";
            echo "<td>" . $row['marca'] . "</td>";
            echo "<td>" . $row['modelo'] . "</td>";
            echo "<td>" . $row['color'] . "</td>";
            echo "<td>" . $row['nombre_tipo'] . "</td>";
            echo "<td>" . $row['fecha_registro'] . "</td>";
            echo "<td><a href=\"edit_v.php?placa=$row[placa]\">Editar</a> | <a 
href=\"delete_v.php?placa=$row[placa]\" 
onClick=\"return confirm('Esta seguro de eliminar el 
registro?')\">Eliminar</a></td>";
        }
        ?>
    </table>
</body>

</html>