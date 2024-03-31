<html>

<head>
    <title>Adicionar inmueble</title>
</head>

<body>
    <?php
    include_once("../config.php");
    if (isset($_POST['Submit'])) {
        $bloque = $_POST['bloque'];
        $apto = $_POST['apto'];
        $id_persona = $_POST['id_persona'];
       
        if (empty($bloque) || empty($apto) || empty($id_persona)) {

            if (empty($bloque)) {
                echo "<font color='red'>Campo: bloque esta vacio.</font><br/>";
            }
            if (empty($apto)) {
                echo "<font color='red'>Campo: apartamento esta vacio.</font><br/>";
            }
            if (empty($id_persona)) {
                echo "<font color='red'>Campo: color esta vacio.</font><br/>";
            }

            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {
            $sql = "INSERT INTO inmuebles (bloque, apto, id_persona) VALUES (:bloque, :apto, :id_persona)";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':bloque', $bloque);
            $query->bindparam(':apto', $apto);
            $query->bindparam(':id_persona', $id_persona);
            $query->execute();
            echo "<font color='green'>Registro Agregado Correctamente.";
            echo "Cantidad de Registros Agregados: " . $query->rowCount() . "<br>";
            echo "<br/><a href='index_i.php'>Ver Todos los Registros</a>";
        }
    }
    ?>
</body>

</html>