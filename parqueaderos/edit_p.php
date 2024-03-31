<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_parqueadero = $_POST['id_parqueadero'];
    $id_persona = $_POST['id_persona'];
    $placa = $_POST['placa'];
    $id_inmueble = $_POST['id_inmueble'];
    $id_usuario = $_POST['id_usuario'];
    $nom_parqueadero = $_POST['nom_parqueadero'];
    
    if (empty($id_persona) || empty($placa) || empty($id_inmueble) || empty($id_usuario) || empty($nom_parqueadero)) {

        if (empty($id_persona)) {
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
        if (empty($nom_parqueadero)) {
            echo "<font color='red'>Campo: genero esta vacio.</font><br/>";
        }
        
    } else {
        $sql = "UPDATE parqueaderos SET id_persona=:id_persona, placa=:placa, id_inmueble=:id_inmueble, id_usuario=:id_usuario, nom_parqueadero=:nom_parqueadero WHERE id_parqueadero=:id_parqueadero";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id_parqueadero', $id_parqueadero);
        $query->bindparam(':id_persona', $id_persona);
        $query->bindparam(':placa', $placa);
        $query->bindparam(':id_inmueble', $id_inmueble);
        $query->bindparam(':id_usuario', $id_usuario);
        $query->bindparam(':nom_parqueadero', $nom_parqueadero);
        $query->execute();
        header("Location:index_p.php");
    }
}
?>
<?php
$id_parqueadero = $_GET['id_parqueadero'];
$sql = "SELECT * FROM parqueaderos WHERE id_parqueadero=:id_parqueadero";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_parqueadero' => $id_parqueadero));
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $id_persona = $row['id_persona'];
    $placa = $row['placa'];
    $id_inmueble = $row['id_inmueble'];
    $id_usuario = $row['id_usuario'];
    $nom_parqueadero = $row['nom_parqueadero'];
}
?>
<html>

<head>
    <title>Editar datos</title>
</head>

<body>
    <a href="index_p.php">Inicio</a>
    <br /><br />
    <form name="form1" method="post" action="edit_p.php">
        <table border="0">
            <tr>
                <td>Persona</td>
                <td><input type="text" name="id_persona" value="<?php echo $id_persona; ?>"></td>
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
                <td><input type="text" name="nom_parqueadero" value="<?php echo $nom_parqueadero; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_parqueadero" value=<?php echo $_GET['id_parqueadero']; ?>></td>
                <td><input type="submit" name="update" value="Editar"></td>
            </tr>
        </table>
    </form>
</body>

</html>