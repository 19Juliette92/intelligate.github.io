<?php
	require 'config.php';
	if(empty($_SESSION['name']))
		header('Location: login.php');

	if(isset($_POST['update'])) {
		$errMsg = '';

		// Getting data from FROM
		$nombre_usuario = $_POST['nombre_usuario'];
		$contrasena = $_POST['contrasena'];
		$passwordVarify = $_POST['passwordVarify'];

		if($password != $passwordVarify)
			$errMsg = 'Error en la contraseña.';

		if($errMsg == '') {
			try {
		      $sql = "UPDATE usuarios SET  contrasena = :contrasena WHERE nombre_usuario = :nombre_usuario";
		      $stmt = $connect->prepare($sql);                                  
		      $stmt->execute(array(
		        
		        ':contrasena' => $contrasena,
		        ':nombre_usuario' => $_SESSION['nombre_usuario']
		      ));
				header('Location: update.php?action=updated');
				exit;

			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'updated')
		$errMsg = 'Datos Actualizados Correctamente. <a href="logout.php">Salga</a> e ingrese de nuevo.';
?>

<html>
	<head><title>Actualizar</title></head>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
	<style>
	html, body {
		margin: 1px;
		border: 0;
	}
	</style>
<body>
	<div style="margin: 15px">
		<div align="center">
			<div style=" border: solid 1px #079B96; " align="center">				
				<div style="background-color:#006D9C; color:#FFFFFF; padding:10px;"><b><?php echo $_SESSION['name'] ?></b></div>
				<div style="margin: 15px">
					<form action="" method="post">
						
						Usuario
						<input type="text" name="nombre_usuario" value="<?php echo $_SESSION['nombre_usuario']; ?>" disabled autocomplete="off" class="box"/>
						
						Contraseña
						<input type="contrasena" name="contrasena" value="<?php echo $_SESSION['contrasena'] ?>" class="box" />
						Validar Contraseña
						<input type="contrasena" name="passwordVarify" value="<?php echo $_SESSION['contrasena'] ?>" class="box" />
						<input type="submit" name='update' value="Actualizar" class='submit'/><br />
						<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
