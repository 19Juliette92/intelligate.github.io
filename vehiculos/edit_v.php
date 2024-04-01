<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $placa = $_POST['placa'];
    $id_conductor = $_POST['id_conductor'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $tipo_vehiculo = $_POST['tipo_vehiculo'];

    if (empty($id_conductor) || empty($marca) ||empty($modelo) || empty($color) || empty($tipo_vehiculo)) {

        if (empty($id_conductor)) {
            echo "<font Persona='red'>Campo: conductor esta 
vacio.</font><br/>";
        }
        if (empty($marca)) {
            echo "<font marca='red'>Campo: marca esta 
vacio.</font><br/>";
        }
        if (empty($modelo)) {
            echo "<font modelo='red'>Campo: modelo esta 
vacio.</font><br/>";
        }
        if (empty($color)) {
            echo "<font color='red'>Campo: color esta 
vacio.</font><br/>";
        }

        if (empty($tipo_vehiculo)) {
            echo "<font tipo de vehiculo='red'>Campo: nota 3 esta 
vacio.</font><br/>";
        }
    } else {
        $sql = "UPDATE vehiculos SET placa=:placa, 
id_conductor=:id_conductor, marca=:marca, modelo=:modelo, color=:color, tipo_vehiculo=:id_tipo WHERE placa=:placa";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':placa', $placa);
        $query->bindparam(':id_conductor', $id_conductor);
        $query->bindparam(':marca', $marca);
        $query->bindparam(':modelo', $modelo);
        $query->bindparam(':color', $color);
        $query->bindparam(':id_tipo', $tipo_vehiculo);
        $query->execute();
        header("Location: index_v.php");
    }
}
?>
<?php
$placa = $_GET['placa'];
$sql = "SELECT * FROM vehiculos WHERE placa=:placa";
$query = $dbConn->prepare($sql);
$query->execute(array(':placa' => $placa));
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $id_conductor = $row['id_conductor'];
    $marca = $row['marca'];
    $modelo = $row['modelo'];
    $color = $row['color'];
    $tipo_vehiculo = $row['tipo_vehiculo'];
}
?>
<html>

<head>
    <title>Edit Data</title>
</head>

<body>
    <a href="index_v.php">Inicio</a>
    <br /><br />
    <form name="form1" method="post" action="edit_v.php">
        <table border="0">
            <tr>
                <td>placa</td>
                <td><input type="text" name="placa" value="<?php echo $placa; ?>"></td>
            </tr>
            <tr>
                <td>Persona</td>
                <td><input type="text" name="id_conductor" value="<?php echo $id_conductor; ?>"></td>
            </tr>
            <tr>
                <td>Marca</td>
                <td><input type="text" name="marca" value="<?php echo $marca; ?>"></td>
            </tr>
            <tr>
                <td>Modelo</td>
                <td><input type="text" name="modelo" value="<?php echo $modelo; ?>"></td>
            </tr>
            <tr>
                <td>Color</td>
                <td><input type="text" name="color" value="<?php echo $color; ?>"></td>
            </tr>
            <tr>
                <td>Tipo de vehículo</td>
                <td>
                    <select name="tipo_vehiculo">
                        <option>Seleccionar...</option>
                        <?php
                        $sql = "SELECT * FROM tipos WHERE nombre_tipo IN ('Moto', 'Vehículo', 'Camioneta')";
                        $query = $dbConn->query($sql);
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['id_tipo'] == $tipo_vehiculo) ? 'selected' : '';
                            echo "<option value='" . $row['id_tipo'] . "' $selected>" . $row['nombre_tipo'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="idplaca" value=<?php echo $_GET['placa']; ?>></td>
                <td><input type="submit" name="update" value="Editar"></td>
            </tr>
        </table>
    </form>
</body>

</html