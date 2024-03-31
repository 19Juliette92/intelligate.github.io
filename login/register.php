<?php
require 'config.php';

if (isset($_POST['register'])) {
	$errMsg = '';

	// Get data from FROM

	$nombre_usuario = $_POST['nombre_usuario'];
	$contrasena = $_POST['contrasena'];
	$email = $_POST['email'];
	$estado = $_POST['estado'];

	if ($nombre_usuario == '')
		$errMsg = 'Ingrese su Usuario';
	if ($contrasena == '')
		$errMsg = 'Ingrese su Contraseña';
	if ($email == '')
		$errMsg = 'Ingrese su email';
	if ($estado == '')
		$errMsg = 'Ingrese su estado';


	if ($errMsg == '') {
		try {
			$stmt = $connect->prepare('INSERT INTO usuarios (nombre_usuario, contrasena, email, fecha_creacion, estado) VALUES ( :nombre_usuario, :contrasena, :email, NOW(), :estado)');
			$stmt->execute(array(

				':nombre_usuario' => $nombre_usuario,
				':contrasena' => $contrasena,
				':email' => $email,
				':estado' => $estado,


			));
			header('Location: register.php?action=joined');
			exit;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'joined') {
	$errMsg = 'Registro Exitoso!!. Ahora puede Ingresar <a href="login.php">Ingreso</a>';
}
?>

<html>

<head>
	<title>Registro</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="../css/registro_inicio.css">

<body>
	<div class="registro-container">
		<div>
			<div class="caja-registro">
				<div >
					<img class="logo" src="../img/Intelligate_logo.jpg" alt="">
				</div>
				<div class="registro-titulo">Regístrate</div>
				<div>
					<form action="" method="post">
						<input type="text" name="nombre_usuario" placeholder="Usuario" value="<?php if (isset($_POST['nombre_usuario'])) echo $_POST['nombre_usuario'] ?>" autocomplete="off" class="caja" /><br /><br />
						<input type="password" name="contrasena" placeholder="Contraseña" value="<?php if (isset($_POST['contrasena'])) echo $_POST['contrasena'] ?>" class="caja" /><br /><br />
						<input type="email" name="email" placeholder="Correo Electrónico" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" class="caja" /><br /><br />
						<input type="text" name="estado" placeholder="Estado" value="<?php if (isset($_POST['estado'])) echo $_POST['estado'] ?>" class="caja" /><br /><br />
						<input type="submit" name='register' value="Registro" class='submit' /><br /><br>
						<span class="registro-enlace"><a href="index.php">Volver al inicio</a></span>
					</form>
					
				</div>
			</div>
			<?php
			if (isset($errMsg)) {
				echo '<div class="mensaje-error">' . $errMsg . '</div>';
			}
			?>
		</div>
	</div>
</body>

</html>