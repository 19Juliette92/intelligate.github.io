<?php
include_once("../config.php");
$result = $dbConn->query("SELECT * FROM permisos");
?>
<html>

<head>
    <title> Listado de permisos</title>
</head>

<body>
    <a href="add_per.html">Adicionar permiso</a><br /><br />
    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <td>Acceso</td>
            <td>Persona</td>
            <td>Usuario</td>
            <td>Tipo de acceso</td>
            <td>Fecha y hora</td>
            <td>Acción</td>
        </tr>
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            
            echo "<tr>";
            echo "<td>" . $row['id_persona'] . "</td>";
            echo "<td>" . $row['id_usuario'] . "</td>";
            echo "<td>" . $row['tipo_acceso'] . "</td>";
            echo "<td>" . $row['fecha_hora'] . "</td>";
        
            echo "<td><a href=\"edit_per.php?id_permiso=$row[id_permiso]\">Editar</a> | <a href=\"delete_per.php?id_permiso=$row[id_permiso]\"
onClick=\"return confirm('Esta seguro de eliminar el registro?')\">Eliminar</a></td>";
        }
        ?>
    </table>
</body>

</html>