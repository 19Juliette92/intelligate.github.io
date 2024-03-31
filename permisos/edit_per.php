<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_permiso = $_POST['id_permiso'];
    $nombre_permiso = $_POST['nombre_permiso'];
    $descripcion = $_POST['descripcion'];
    
    if (empty($nombre_permiso) || empty($descripcion)) {

        if (empty($nombre_permiso)) {
            echo "<font color='red'>Campo: tipo persona esta vacio.</font><br/>";
        }
        if (empty($descripcion)) {
            echo "<font color='red'>Campo: nombres esta vacio.</font><br/>";
        }
        
    } else {
        $sql = "UPDATE permisos SET nombre_permiso=:nombre_permiso, descripcion=:descripcion WHERE id_permiso=:id_permiso";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id_permiso', $id_permiso);
        $query->bindparam(':nombre_permiso', $nombre_permiso);
        $query->bindparam(':descripcion', $descripcion);
        $query->execute();
        header("Location:index_per.php");
    }
}
?>
<?php
$id_permiso = $_GET['id_permiso'];
$sql = "SELECT * FROM permisos WHERE id_permiso=:id_permiso";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_permiso' => $id_permiso));
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $nombre_permiso = $row['nombre_permiso'];
    $descripcion = $row['descripcion'];
}
?>
<html>

<head>
    <title>Editar datos</title>
</head>

<body>
    <a href="index_per.php">Inicio</a>
    <br /><br />
    <form name="form1" method="post" action="edit_per.php">
        <table border="0">
            <tr>
                <td>Tipo de permiso</td>
                <td><input type="text" name="nombre_permiso" value="<?php echo $nombre_permiso; ?>"></td>
            </tr>
            <tr>
                <td>Descripcion</td>
                <td><input type="text" name="descripcion" value="<?php echo $descripcion; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_permiso" value=<?php echo $_GET['id_permiso']; ?>></td>
                <td><input type="submit" name="update" value="Editar"></td>
            </tr>
        </table>
    </form>
</body>

</html>