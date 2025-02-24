<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_inmueble = $_POST['id_inmueble'];
    $bloque = $_POST['bloque'];
    $apto = $_POST['apto'];
    $id_persona = $_POST['id_persona'];
    
    if (empty($id_inmueble) || empty($bloque) || empty($apto) || empty($id_persona)) {

        if (empty($id_inmueble)) {
            echo "<font color='red'>Campo: tipo persona esta vacio.</font><br/>";
        }
        if (empty($bloque)) {
            echo "<font color='red'>Campo: nombres esta vacio.</font><br/>";
        }
        if (empty($apto)) {
            echo "<font color='red'>Campo: apellidos esta vacio.</font><br/>";
        }
        if (empty($id_persona)) {
            echo "<font color='red'>Campo: genero esta vacio.</font><br/>";
        }
        
    } else {
        $sql = "UPDATE inmuebles SET bloque=:bloque, apto=:apto, id_persona=:id_persona WHERE id_inmueble=:id_inmueble";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id_inmueble', $id_inmueble);
        $query->bindparam(':bloque', $bloque);
        $query->bindparam(':apto', $apto);
        $query->bindparam(':id_persona', $id_persona);
        $query->execute();
        header("Location: index_i.php");
    }
}
?>
<?php
$id_inmueble = $_GET['id_inmueble'];
$sql = "SELECT * FROM inmuebles WHERE id_inmueble=:id_inmueble";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_inmueble' => $id_inmueble));
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $bloque = $row['bloque'];
    $apto = $row['apto'];
    $id_persona = $row['id_persona'];
}
?>
<html>

<head>
    <title>Editar datos</title>
</head>

<body>
    <a href="index_i.php">Inicio</a>
    <br /><br />
    <form name="form1" method="post" action="edit_i.php">
        <table border="0">
            <tr>
                <td>Bloque</td>
                <td><input type="text" name="bloque" value="<?php echo $bloque; ?>"></td>
            </tr>
            <tr>
                <td>Apartamento</td>
                <td><input type="text" name="apto" value="<?php echo $apto; ?>"></td>
            </tr>
            <tr>
                <td>Id persona</td>
                <td><input type="text" name="id_persona" value="<?php echo $id_persona; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_inmueble" value=<?php echo $_GET['id_inmueble']; ?>></td>
                <td><input type="submit" name="update" value="Editar"></td>
            </tr>
        </table>
    </form>
</body>

</html>