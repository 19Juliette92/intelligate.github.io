<?php
include("../config.php");
$id_inmueble = $_GET['id_inmueble'];
$sql = "DELETE FROM inmuebles WHERE id_inmueble=:id_inmueble";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_inmueble' => $id_inmueble));
header("Location:index_i.php");
