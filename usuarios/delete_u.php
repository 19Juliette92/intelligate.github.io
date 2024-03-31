<?php
include("../config.php");
$id_usuario = $_GET['id_usuario'];
$sql = "DELETE FROM usuarios WHERE id_usuario=:id_usuario";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_usuario' => $id_usuario));
header("Location:index_u.php");
