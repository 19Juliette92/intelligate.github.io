<?php
include("../config.php");
$id_parqueadero = $_GET['id_parqueadero'];
$sql = "DELETE FROM parqueaderos WHERE id_parqueadero=:id_parqueadero";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_parqueadero' => $id_parqueadero));
header("Location:index_p.php");
