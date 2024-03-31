<html>

<head>
    <title>Adicionar Datos</title>
</head>

<body>
    <?php
    include_once("../config.php");
    if (isset($_POST['Submit'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $contrasena = $_POST['contrasena'];
        $email = $_POST['email'];
        $estado = $_POST['estado'];

        if (empty($nombre_usuario)  || empty($contrasena) || empty($email) || empty($estado)) {

            if (empty($nombre_usuario)) {
                echo "<font Nombre usuario ='red'>Campo:nombre_usuario esta 
vacio.</font><br/>";
            }
            if (empty($contrasena)) {
                echo "<font Contraseña ='red'>Campo:contrasena esta 
vacio.</font><br/>";
            }

            if (empty($email)) {
                echo "<font Email ='red'>Campo:email esta 
vacio.</font><br/>";
            }
            if (empty($estado)) {
                echo "<font Estado ='red'>Campo:estado esta 
vacio.</font><br/>";
            }
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            $sql = "INSERT INTO usuarios(nombre_usuario, contrasena, email, fecha_creacion, estado) VALUES (:nombre_usuario, :contrasena, :email, NOW(), :estado)";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':nombre_usuario', $nombre_usuario);
            $query->bindparam(':contrasena', $contrasena);
            $query->bindparam(':email', $email);
            $query->bindparam(':estado', $estado);
            $query->execute();

            echo "<font color='green'>Registro Agregado Correctamente.";
            echo "Cantidad de Registros Agregados: " . $query->rowCount() . "<br>";
            echo "<br/><a href='index_u.php'>Ver Todos los Registros</a>";
        }
    }
    ?>
</body>

</html>