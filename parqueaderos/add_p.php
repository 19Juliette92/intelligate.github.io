<html>

<head>
    <title>Adicionar parqueadero</title>
</head>

<body>
    <?php
    include_once("../config.php");
    if (isset($_POST['Submit'])) {
        $id_persona = $_POST['id_persona'];
        $placa = $_POST['placa'];
        $id_inmueble = $_POST['id_inmueble'];
        $id_usuario = $_POST['id_usuario'];
        $nom_parqueadero = $_POST['nom_parqueadero'];
       
        if (empty($id_persona) || empty($placa) || empty($id_inmueble) || empty($id_usuario) || empty($nom_parqueadero)) {

            if (empty($id_persona)) {
                echo "<font color='red'>Campo: persona esta vacio.</font><br/>";
            }
            if (empty($placa)) {
                echo "<font color='red'>Campo: placa esta vacio.</font><br/>";
            }
            if (empty($id_inmueble)) {
                echo "<font color='red'>Campo: inmueble esta vacio.</font><br/>";
            }
            if (empty($id_usuario)) {
                echo "<font color='red'>Campo: usuario esta vacio.</font><br/>";
            }
            if (empty($nom_parqueadero)) {
                echo "<font color='red'>Campo: usuario esta vacio.</font><br/>";
            }

            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            $sql = "INSERT INTO parqueaderos (id_persona, placa, id_inmueble, id_usuario, nom_parqueadero) VALUES (:id_persona, :placa, :id_inmueble, :id_usuario, :nom_parqueadero)";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':id_persona', $id_persona);
            $query->bindparam(':placa', $placa);
            $query->bindparam(':id_inmueble', $id_inmueble);
            $query->bindparam(':id_usuario', $id_usuario);
            $query->bindparam(':nom_parqueadero', $nom_parqueadero);
            $query->execute();
            echo "<font color='green'>Registro Agregado Correctamente.";
            echo "Cantidad de Registros Agregados: " . $query->rowCount() . "<br>";
            echo "<br/><a href='index_p.php'>Ver Todos los Registros</a>";
        }
    }
    ?>
</body>

</html>