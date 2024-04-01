<?php
include("../config.php");
$id_estacionamiento = $_GET['id_estacionamiento'];
$sql = "DELETE FROM estacionamientos WHERE id_estacionamiento=:id_estacionamiento";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_estacionamiento' => $id_estacionamiento));
header("Location:index_p.php");
