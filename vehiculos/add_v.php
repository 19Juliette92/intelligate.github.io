<html>

<head>
    <title>Adicionar Datos</title>
</head>

<body>
    <?php
    include_once("../config.php");

    if (isset($_POST['Submit'])) {
        $placa = $_POST['placa'];
        $id_persona = $_POST['id_persona'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $tipo_vehiculo = $_POST['tipo_vehiculo'];

        if (
            empty($placa) || empty($id_persona) || empty($marca) ||
            empty($modelo) || empty($color) || empty($tipo_vehiculo)
        ) {

            if (empty($placa)) {
                echo "<font color='red'>Campo: placa esta 
vacio.</font><br/>";
            }
            if (empty($id_persona)) {
                echo "<font color='red'>Campo: id_persona esta 
vacio.</font><br/>";
            }
            if (empty($marca)) {
                echo "<font color='red'>Campo: marca esta 
vacio.</font><br/>";
            }
            if (empty($modelo)) {
                echo "<font color='red'>Campo: modelo esta 
vacio.</font><br/>";
            }
            if (empty($color)) {
                echo "<font color='red'>Campo: color esta 
    vacio.</font><br/>";
            }
            if (empty($tipo_vehiculo)) {
                echo "<font color='red'>Campo: tipo_vehiculo esta 
    vacio.</font><br/>";
            }
            echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
        } else {

            $sql = "INSERT INTO vehiculos(placa, id_persona,  
marca, modelo, color, tipo_vehiculo, fecha_registro) VALUES(:placa, :id_persona, :marca, :modelo, 
:color,:id_tipo, NOW())";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':placa', $placa);
            $query->bindparam(':id_persona', $id_persona);
            $query->bindparam(':marca', $marca);
            $query->bindparam(':modelo', $modelo);
            $query->bindparam(':color', $color);
            $query->bindparam(':id_tipo', $tipo_vehiculo);
            $query->execute();
            echo "<font color='green'>Registro Agregado Correctamente.";
            echo "Cantidad de Registros Agregados: " . $query->rowCount() . "<br>";
            echo "<br/><a href=' index_v.php'>Ver Todos los Registros</a>";
        }
    }
    ?>
</body>

</html>