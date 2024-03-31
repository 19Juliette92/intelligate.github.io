<?php
include_once("config.php");
$result = $dbConn->query("SELECT 
personas.id_persona,
personas.nombres, 
personas.apellidos, 
personas.num_doc,
inmuebles.bloque, 
inmuebles.apto, 
vehiculos.placa, 
parqueaderos.nom_parqueadero
FROM personas 
LEFT JOIN inmuebles ON personas.id_persona = inmuebles.id_persona
LEFT JOIN vehiculos ON personas.id_persona = vehiculos.id_persona
LEFT JOIN parqueaderos ON personas.id_persona = parqueaderos.id_persona");

require 'login/config.php';
if (empty($_SESSION['nombre_usuario']))
  header('Location: login/login.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Página Principal - INTELLIGATE</title>
  <link rel="stylesheet" href="css/estilosPagPrincipal.css">
</head>

<body>
  <div class="contenedor-principal">
    <header class="cabecera-pagina">
      <img src="img/Intelligate_logo.jpg" alt="Logo de INTELLIGATE" class="logo-cabecera">
      <div class="contenedor_dashboard_info">
        <div class="caja_info_dashboard">
          <?php
          if (isset($errMsg)) {
            echo '<div class="mensaje-error">' . $errMsg . '</div>';
          }
          ?>
          <div class="contenido_dashboard">
            <div class="encabezado_dashboard">
              <div class="titulo_encabezado_dashboard"><?php echo $_SESSION['nombre_usuario']; ?></div>
            </div>
            <div class="cuerpo_dashboard">
              Bienvenido <?php echo $_SESSION['nombre_usuario']; ?><br><br>
                <a href="login/update.php">Actualizar</a>
                <a href="login/logout.php">Salir</a>
            </div>
          </div>
        </div>
      </div>

    </header>
    <nav class="navegacion-principal">
      <ul>
        <ul>
          <li><a href="personas/index.php">Personas</a></li>
          <li><a href="inmuebles/index_i.php">Inmuebles</a></li>
          <li><a href="parqueaderos/index_p.php">Parqueaderos</a></li>
          <li><a href="vehiculos/index_v.php">Vehículos</a></li>
          <li><a href="usuarios/index_u.php">Usuarios</a></li>
        </ul>
    </nav>
    <div class="contenedor-tabla">
      <table>
        <tr>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Documento</th>
          <th>Bloque</th>
          <th>Apartamento</th>
          <th>Placa del vehículo</th>
          <th>Parqueadero</th>
          <th>Acción</th>
        </tr>

        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nombres'] . "</td>";
                echo "<td>" . $row['apellidos'] . "</td>";
                echo "<td>" . $row['num_doc'] . "</td>";
                echo "<td>" . $row['bloque'] . "</td>";
                echo "<td>" . $row['apto'] . "</td>";
                echo "<td>" . $row['placa'] . "</td>";
                echo "<td>" . $row['nom_parqueadero'] . "</td>";
                echo "<td><a href=\"edit.php?id_persona=$row[id_persona]\">Editar</a> | <a href=\"delete.php?id_persona=$row[id_persona]\"
onClick=\"return confirm('Esta seguro de eliminar el registro?')\">Eliminar</a></td>";
            }
            ?>

    </div>
  </div>
</body>

</html>