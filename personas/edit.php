<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_persona = $_POST['id_persona'];
    $tipo_persona = $_POST['tipo_persona'];
    $tip_doc = $_POST['tip_doc'];
    $num_doc = $_POST['num_doc'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    if (empty($tipo_persona) || empty($tip_doc) || empty($num_doc) || empty($nombres) || empty($apellidos) || empty($genero) || empty($email) || empty($telefono)) {

        if (empty($tipo_persona)) {
            echo "<font color='red'>Campo: tipo persona esta vacio.</font><br/>";
        }
        if (empty($tip_doc)) {
            echo "<font color='red'>Campo: nombres esta vacio.</font><br/>";
        }
        if (empty($num_doc)) {
            echo "<font color='red'>Campo: nombres esta vacio.</font><br/>";
        }
        if (empty($nombres)) {
            echo "<font color='red'>Campo: nombres esta vacio.</font><br/>";
        }
        if (empty($apellidos)) {
            echo "<font color='red'>Campo: apellidos esta vacio.</font><br/>";
        }
        if (empty($genero)) {
            echo "<font color='red'>Campo: genero esta vacio.</font><br/>";
        }
        if (empty($email)) {
            echo "<font color='red'>Campo: email esta vacio.</font><br/>";
        }
        if (empty($telefono)) {
            echo "<font color='red'>Campo: talefono esta vacio.</font><br/>";
        }
        if (empty($fecha_creacion)) {
            echo "<font color='red'>Campo: fecha creacion esta vacio.</font><br/>";
        }
    } else {
        $sql = "UPDATE personas SET tipo_persona=:tipo_persona, tip_doc=:tip_doc, num_doc=:num_doc, nombres=:nombres, apellidos=:apellidos, genero=:genero, email=:email, telefono=:telefono, fecha_actualizacion=NOW() WHERE id_persona=:id_persona";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id_persona', $id_persona);
        $query->bindparam(':tipo_persona', $tipo_persona);
        $query->bindparam(':tip_doc', $tip_doc);
        $query->bindparam(':num_doc', $num_doc);
        $query->bindparam(':nombres', $nombres);
        $query->bindparam(':apellidos', $apellidos);
        $query->bindparam(':genero', $genero);
        $query->bindparam(':email', $email);
        $query->bindparam(':telefono', $telefono);
        $query->execute();
        header("Location: index.php");
    }
}
?>
<?php
$id_persona = $_GET['id_persona'];
$sql = "SELECT * FROM personas WHERE id_persona=:id_persona";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_persona' => $id_persona));
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $tipo_persona = $row['tipo_persona'];
    $tip_doc = $row['tip_doc'];
    $num_doc = $row['num_doc'];
    $nombres = $row['nombres'];
    $apellidos = $row['apellidos'];
    $genero = $row['genero'];
    $email = $row['email'];
    $telefono = $row['telefono'];
    $fecha_creacion = $row['fecha_creacion'];
    $fecha_actualizacion = $row['fecha_actualizacion'];
}
?>
<html>

<head>
    <title>Editar datos</title>
</head>

<body>
    <a href="index.php">Inicio</a>
    <br /><br />
    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Tipo de persona</td>
                <td>
                    <select name="tipo_persona">
                        <option>Seleccionar...</option>
                        <?php
                        $sql = "SELECT * FROM tipos WHERE nombre_tipo IN ('Propietario', 'Arrendatario', 'Visitante')";
                        $query = $dbConn->query($sql);
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['id_tipo'] == $tipo_persona) ? 'selected' : '';
                            echo "<option value='" . $row['id_tipo'] . "' $selected>" . $row['nombre_tipo'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Tipo de documento</td>
                <td>
                    <select name="tip_doc">
                        <option>Seleccionar...</option>
                        <?php
                        $sql = "SELECT * FROM tipos WHERE nombre_tipo IN ('CC', 'TI', 'PP', 'CE', 'NIT', 'Otro')";
                        $query = $dbConn->query($sql);
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['nombre_tipo'] == $tip_doc) ? 'selected' : '';
                            echo "<option value='" . $row['nombre_tipo'] . "'$selected>" . $row['nombre_tipo'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Número de identicación</td>
                <td><input type="text" name="num_doc" value="<?php echo $num_doc; ?>"></td>
            </tr>
            <tr>
                <td>Nombres</td>
                <td><input type="text" name="nombres" value="<?php echo $nombres; ?>"></td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td><input type="text" name="apellidos" value="<?php echo $apellidos; ?>"></td>
            </tr>
            <tr>
                <td>Genero</td>
                <td><input type="text" name="genero" value="<?php echo $genero; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>Teléfono</td>
                <td><input type="text" name="telefono" value="<?php echo $telefono; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_persona" value=<?php echo $_GET['id_persona']; ?>></td>
                <td><input type="submit" name="update" value="Editar"></td>
            </tr>
        </table>
    </form>
</body>

</html>