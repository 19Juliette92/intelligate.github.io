<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_estacionamiento = $_POST['id_estacionamiento'];
    $id_titular = $_POST['id_titular'];
    $placa = $_POST['placa'];
    $id_inmueble = $_POST['id_inmueble'];
    $id_usuario = $_POST['id_usuario'];
    $no_parqueadero = $_POST['no_parqueadero'];
    
    if (empty($id_titular) || empty($placa) || empty($id_inmueble) || empty($id_usuario) || empty($no_parqueadero)) {

        if (empty($id_titular)) {
            echo "<font color='red'>Campo: tipo persona esta vacio.</font><br/>";
        }
        if (empty($placa)) {
            echo "<font color='red'>Campo: nombres esta vacio.</font><br/>";
        }
        if (empty($id_inmueble)) {
            echo "<font color='red'>Campo: apellidos esta vacio.</font><br/>";
        }
        if (empty($id_usuario)) {
            echo "<font color='red'>Campo: genero esta vacio.</font><br/>";
        }
        if (empty($no_parqueadero)) {
            echo "<font color='red'>Campo: genero esta vacio.</font><br/>";
        }
        
    } else {
        $sql = "UPDATE estacionamientos SET id_titular=:id_titular, placa=:placa, id_inmueble=:id_inmueble, id_usuario=:id_usuario, no_parqueadero=:no_parqueadero WHERE id_estacionamiento=:id_estacionamiento";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id_estacionamiento', $id_estacionamiento);
        $query->bindparam(':id_titular', $id_titular);
        $query->bindparam(':placa', $placa);
        $query->bindparam(':id_inmueble', $id_inmueble);
        $query->bindparam(':id_usuario', $id_usuario);
        $query->bindparam(':no_parqueadero', $no_parqueadero);
        $query->execute();
        header("Location:index_e.php");
    }
}
?>
<?php
$id_estacionamiento = $_GET['id_estacionamiento'];
$sql = "SELECT * FROM estacionamientos WHERE id_estacionamiento=:id_estacionamiento";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_estacionamiento' => $id_estacionamiento));
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $id_titular = $row['id_titular'];
    $placa = $row['placa'];
    $id_inmueble = $row['id_inmueble'];
    $id_usuario = $row['id_usuario'];
    $no_parqueadero = $row['no_parqueadero'];
}
?>
<html>

<head>
    <title>Editar datos</title>
</head>

<body>
    <a href="index_e.php">Inicio</a>
    <br /><br />
    <form name="form1" method="post" action="edit_p.php">
        <table border="0">
            <tr>
                <td>Persona</td>
                <td><input type="text" name="id_titular" value="<?php echo $id_titular; ?>"></td>
            </tr>
            <tr>
                <td>Placa</td>
                <td><input type="text" name="placa" value="<?php echo $placa; ?>"></td>
            </tr>
            <tr>
                <td>Inmueble</td>
                <td><input type="text" name="id_inmueble" value="<?php echo $id_inmueble; ?>"></td>
            </tr>
            <tr>
                <td>Usuario</td>
                <td><input type="text" name="id_usuario" value="<?php echo $id_usuario; ?>"></td>
            </tr>
            <tr>
                <td>Nombre parqueadero</td>
                <td><input type="text" name="no_parqueadero" value="<?php echo $no_parqueadero; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_estacionamiento" value=<?php echo $_GET['id_estacionamiento']; ?>></td>
                <td><input type="submit" name="update" value="Editar"></td>
            </tr>
        </table>
    </form>
</body>

</html>