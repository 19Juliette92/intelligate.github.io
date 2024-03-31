

<?php
include("../config.php");
$placa = $_GET['placa']; // Aquí estás obteniendo el parámetro 'placa' de la URL
$sql = "DELETE FROM vehiculos WHERE placa=:placa"; // Corrección: Utiliza 'placa' en lugar de ':placa'
$query = $dbConn->prepare($sql);
$query->execute(array(':placa' => $placa)); // Aquí estás usando ':placa' como parámetro
header("Location: index_v.php");
?>