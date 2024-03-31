<?php
include_once("../config.php");
?>


<html>

<head>
  <meta charset="UTF-8">
  <title>Agregar</title>
</head>

<body>
  <a href="index.php">Inicio</a>
  <br /><br />
  <form action="add.php" method="post" name="form1">
    <table width="25%" border="0">
    <tr>
        <td>Tipo de persona</td>
        <td>
          <select name="tipo_persona">
            <option>Seleccionar...</option>
            <?php
            $sql = "SELECT * FROM tipos WHERE nombre_tipo IN ('Propietario', 'Arrendatario', 'Visitante')";
            $query = $dbConn->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='" . $row['id_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Tipo de documento</td>
        <td>
          <select name="tip_doc">
            <option>Seleccionar...</option>
            <?php
            $sql = "SELECT * FROM tipos WHERE nombre_tipo IN ('CC', 'TI', 'PP', 'CE', 'NIT', 'Otro')";
            $query = $dbConn->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='" . $row['nombre_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Número de identicación</td>
        <td><input type="text" name="num_doc" /></td>
      </tr>
      <tr>
        <td>Nombres</td>
        <td><input type="text" name="nombres" /></td>
      </tr>
      <tr>
        <td>Apellidos</td>
        <td><input type="text" name="apellidos" /></td>
      </tr>
      <tr>
        <td>Genero</td>
        <td>
          <select name="genero">
            <option>Seleccionar...</option>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
            <option value="otros">Otros</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="text" name="email" /></td>
      </tr>
      <tr>
        <td>Teléfono</td>
        <td><input type="text" name="telefono" /></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="Submit" value="Agregar" /></td>
      </tr>
    </table>
  </form>
</body>

</html>