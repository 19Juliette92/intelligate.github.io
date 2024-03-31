<?php
include_once("../config.php");
if (isset($_POST['update'])) {
    $id_usuario = $_POST['id_usuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];
    $estado = $_POST['estado'];

    if (empty($nombre_usuario) || empty($contrasena)  || empty($email) || empty($estado)) {

        if (empty($nombre_usuario)) {
            echo "<font Nombre usuario ='red'>Campo: nombre_usuario esta 
vacio.</font><br/>";
        }
        if (empty($contrasena)) {
            echo "<font Contraseña ='red'>Campo: contrasena esta 
vacio.</font><br/>";
        }

        if (empty($email)) {
            echo "<font Email ='red'>Campo: email esta 
vacio.</font><br/>";
        }
        if (empty($estado)) {
            echo "<font Estado ='red'>Campo: estado esta 
vacio.</font><br/>";
        }
    } else {
        $sql = "UPDATE usuarios SET nombre_usuario=:nombre_usuario, contrasena=:contrasena, email=:email, estado=:estado WHERE id_usuario=:id_usuario";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':id_usuario', $id_usuario);
        $query->bindparam(':nombre_usuario', $nombre_usuario);
        $query->bindparam(':contrasena', $contrasena);
        $query->bindparam(':email', $email);
        $query->bindparam(':estado', $estado);
        $query->execute();
        header("Location:index_u.php");
    }
}
?>
<?php
$id_usuario = $_GET['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id_usuario=:id_usuario";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_usuario' => $id_usuario));
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $nombre_usuario = $row['nombre_usuario'];
    $contrasena = $row['contrasena'];
    $email = $row['email'];
    $estado = $row['estado'];
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
</head>

<body>
    <a href="index_u.php">Inicio</a>
    <br /><br />
    <form name="form1" method="post" action="edit_u.php">
        <table border="0">
            <tr>
                <td>Nombre usuario</td>
                <td><input type="text" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>"></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="text" name="contrasena" value="<?php echo $contrasena; ?>"></td>
            </tr>

            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>Estado</td>
                <td><input type="text" name="estado" value="<?php echo $estado; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_usuario" value=<?php echo $_GET['id_usuario']; ?>></td>
                <td><input type="submit" name="update" value="Editar"></td>
            </tr>
        </table>
    </form>
</body>

</html>