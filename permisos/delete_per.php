<?php
include("../config.php");
$id_permiso = $_GET['id_permiso'];
$sql = "DELETE FROM permisos WHERE id_permiso=:id_permiso";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_permiso' => $id_permiso));
header("Location:index_per.php");
