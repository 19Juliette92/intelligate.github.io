<?php
include_once("../config.php");
$result = $dbConn->query("SELECT * FROM usuarios ORDER BY id_usuario ASC");

require '../login/config.php';
if (empty($_SESSION['nombre_usuario']))
    header('Location: ../login/login.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de usuarios</title>
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
        <a href="add_u.html">Adicionar usuario</a>
        <a href="../paginaprincipal.php">Volver</a>
    </div>

    <table>
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>Email</th>
            <th>Fecha de creación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id_usuario'] . "</td>";
            echo "<td>" . $row['nombre_usuario'] . "</td>";
            echo "<td>" . $row['contrasena'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['fecha_creacion'] . "</td>";
            echo "<td>" . $row['estado'] . "</td>";

            echo "<td><a href=\"edit_u.php?id_usuario={$row['id_usuario']}\">Editar</a> | <a href=\"delete_u.php?id_usuario={$row['id_usuario']}\" onClick=\"return confirm('¿Está seguro de eliminar el registro?')\">Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>