<?php
include_once("../config.php");
?>

<html>

<head>
  <title>Ingresar vehiculo</title>
</head>

<body>
  <a href="index_v.php">Inicio</a>
  <br /><br />
  <form action="add_v.php" method="post" name="form1">
    <table width="25%" border="0">
      <tr>
        <td>placa</td>
        <td><input type="text" name="placa" /></td>
      </tr>
      <tr>
        <td>Persona</td>
        <td><input type="text" name="id_conductor" /></td>
      </tr>
      <tr>
      <tr>
        <td>Marca</td>
        <td><input type="text" name="marca" /></td>
      </tr>
      <tr>
        <td>Modelo</td>
        <td><input type="text" name="modelo" /></td>
      </tr>

      <tr>
        <td>Color</td>
        <td><input type="text" name="color" /></td>
      </tr>
      <tr>
        <td>Vehículo</td>
        <td>
          <select name="tipo_vehiculo">
            <option>Seleccionar...</option>
            <?php
            $sql = "SELECT * FROM tipos WHERE nombre_tipo IN ('Moto', 'Vehículo', 'Camioneta')";
            $query = $dbConn->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='" . $row['id_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="Submit" value="Agregar" /></td>
      </tr>
    </table>
  </form>
</body>

</html>