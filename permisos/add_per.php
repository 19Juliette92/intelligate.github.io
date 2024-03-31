<html>

<head>
    <title>Adicionar inmueble</title>
</head>

<body>
    <?php
    include_once("../config.php");
    if (isset($_POST['Submit'])) {
        $nombre_permiso = $_POST['nombre_permiso'];
        $descripcion = $_POST['descripcion'];
       
        if (empty($nombre_permiso) || empty($descripcion)) {

            if (empty($nombre_permiso)) {
                echo "<font color='red'>Campo: persona esta vacio.</font><br/>";
            }
            if (empty($descripcion)) {
                echo "<font color='red'>Campo: placa esta vacio.</font><br/>";
            }

            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            $sql = "INSERT INTO permisos (nombre_permiso, descripcion) VALUES (:nombre_permiso, :descripcion)";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':nombre_permiso', $nombre_permiso);
            $query->bindparam(':descripcion', $descripcion);
            $query->execute();
            echo "<font color='green'>Registro Agregado Correctamente.";
            echo "Cantidad de Registros Agregados: " . $query->rowCount() . "<br>";
            echo "<br/><a href='index_per.php'>Ver Todos los Registros</a>";
        }
    }
    ?>
</body>

</html>