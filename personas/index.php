<?php
include_once("../config.php");
$result = $dbConn->query("SELECT personas.*, tipos.nombre_tipo FROM personas INNER JOIN tipos ON personas.tipo_persona = tipos.id_tipo");

require '../login/config.php';
if (empty($_SESSION['nombre_usuario']))
    header('Location: ../login/login.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <title> Listado de residentes</title>
    <link rel="stylesheet" href="../css/estilosPagPrincipal.css">
</head>

<body>
    <div class="contenedor-principal">
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
            <a href="add_html.php">Adicionar</a>
            <a href="../paginaprincipal.php">Volver</a>
        </div>

        <div class="contenedor-tabla">
            <table>
                <tr>
                    <th>Tipo persona</th>
                    <th>Tipo documento</th>
                    <th>Número de identificación</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Genero</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha creación</th>
                    <th>Fecha actualización</th>
                    <th>Accion</th>
                </tr>
                <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre_tipo'] . "</td>";
                    echo "<td>" . $row['tip_doc'] . "</td>";
                    echo "<td>" . $row['num_doc'] . "</td>";
                    echo "<td>" . $row['nombres'] . "</td>";
                    echo "<td>" . $row['apellidos'] . "</td>";
                    echo "<td>" . $row['genero'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['fecha_creacion'] . "</td>";
                    echo "<td>" . $row['fecha_actualizacion'] . "</td>";
                    echo "<td><a href=\"edit.php?id_persona=$row[id_persona]\">Editar</a> | <a href=\"delete.php?id_persona=$row[id_persona]\"
    onClick=\"return confirm('Esta seguro de eliminar el registro?')\">Eliminar</a></td>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>