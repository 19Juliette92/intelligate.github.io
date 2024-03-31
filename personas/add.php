<html>

<head>
    <title>Adicionar Datos</title>
</head>

<body>
    <?php
    include_once("../config.php");
    if (isset($_POST['Submit'])) {
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
                echo "<font color='red'>Campo: tipo de documento esta vacio.</font><br/>";
            }
            if (empty($num_doc)) {
                echo "<font color='red'>Campo: número de documento esta vacio.</font><br/>";
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
                echo "<font color='red'>Campo: teléfono esta vacio.</font><br/>";
            }

            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            $sql = "INSERT INTO personas (tipo_persona, tip_doc, num_doc, nombres, apellidos, genero, email, telefono, fecha_creacion) VALUES (:tipo_persona, :tip_doc, :num_doc, :nombres, :apellidos, :genero, :email, :telefono, NOW())";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':tipo_persona', $tipo_persona);
            $query->bindparam(':tip_doc', $tip_doc);
            $query->bindparam(':num_doc', $num_doc);
            $query->bindparam(':nombres', $nombres);
            $query->bindparam(':apellidos', $apellidos);
            $query->bindparam(':genero', $genero);
            $query->bindparam(':email', $email);
            $query->bindparam(':telefono', $telefono);
            $query->execute();
            echo "<font color='green'>Registro Agregado Correctamente.";
            echo "Cantidad de Registros Agregados: " . $query->rowCount() . "<br>";
            echo "<br/><a href='index.php'>Ver Todos los Registros</a>";
        }
    }
    ?>
</body>

</html>