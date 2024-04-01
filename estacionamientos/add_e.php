<html>

<head>
    <title>Adicionar parqueadero</title>
</head>

<body>
    <?php
    include_once("../config.php");
    if (isset($_POST['Submit'])) {
        $id_titular = $_POST['id_titular'];
        $placa = $_POST['placa'];
        $id_inmueble = $_POST['id_inmueble'];
        $id_usuario = $_POST['id_usuario'];
        $no_parqueadero = $_POST['no_parqueadero'];
       
        if (empty($id_titular) || empty($placa) || empty($id_inmueble) || empty($id_usuario) || empty($no_parqueadero)) {

            if (empty($id_titular)) {
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
            if (empty($no_parqueadero)) {
                echo "<font color='red'>Campo: usuario esta vacio.</font><br/>";
            }

            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            $sql = "INSERT INTO estacionamientos (id_titular, placa, id_inmueble, id_usuario, no_parqueadero) VALUES (:id_titular, :placa, :id_inmueble, :id_usuario, :no_parqueadero)";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':id_titular', $id_titular);
            $query->bindparam(':placa', $placa);
            $query->bindparam(':id_inmueble', $id_inmueble);
            $query->bindparam(':id_usuario', $id_usuario);
            $query->bindparam(':no_parqueadero', $no_parqueadero);
            $query->execute();
            echo "<font color='green'>Registro Agregado Correctamente.";
            echo "Cantidad de Registros Agregados: " . $query->rowCount() . "<br>";
            echo "<br/><a href='index_e.php'>Ver Todos los Registros</a>";
        }
    }
    ?>
</body>

</html>