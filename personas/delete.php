<?php
include("../config.php");

// Obtener el ID de la persona a eliminar
$id_persona = $_GET['id_persona'];

try {
    // Iniciar transacción
    $dbConn->beginTransaction();

    // Eliminar dependencias en otras tablas

    // Eliminar registros de la tabla 'parqueaderos'
    $sql_parqueaderos = "DELETE FROM parqueaderos WHERE id_persona = :id_persona";
    $query_parqueaderos = $dbConn->prepare($sql_parqueaderos);
    $query_parqueaderos->execute(array(':id_persona' => $id_persona));

    // Eliminar registros de la tabla 'inmuebles'
    $sql_inmuebles = "DELETE FROM inmuebles WHERE id_persona = :id_persona";
    $query_inmuebles = $dbConn->prepare($sql_inmuebles);
    $query_inmuebles->execute(array(':id_persona' => $id_persona));

    // Eliminar registros de la tabla 'accesos'
    $sql_accesos = "DELETE FROM accesos WHERE id_persona = :id_persona";
    $query_accesos = $dbConn->prepare($sql_accesos);
    $query_accesos->execute(array(':id_persona' => $id_persona));

    // Eliminar registros de la tabla 'vehiculos'
    $sql_vehiculos = "DELETE FROM vehiculos WHERE id_persona = :id_persona";
    $query_vehiculos = $dbConn->prepare($sql_vehiculos);
    $query_vehiculos->execute(array(':id_persona' => $id_persona));

    // Eliminar el registro de la tabla 'personas'
    $sql_personas = "DELETE FROM personas WHERE id_persona = :id_persona";
    $query_personas = $dbConn->prepare($sql_personas);
    $query_personas->execute(array(':id_persona' => $id_persona));

    // Confirmar transacción
    $dbConn->commit();

    // Redirigir al usuario de vuelta al índice
    header("Location: index.php");
} catch (PDOException $e) {
    // Revertir transacción si hay un error
    $dbConn->rollBack();
    echo "Error al eliminar la persona: " . $e->getMessage();
}
?>
