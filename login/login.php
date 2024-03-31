<?php
require 'config.php';

if (isset($_POST['login'])) {
    $errMsg = '';

    // Obtener datos del FORMULARIO
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    if ($nombre_usuario == '')
        $errMsg = 'Ingrese un usuario';
    if ($contrasena == '')
        $errMsg = 'Ingrese una contraseña';

    if ($errMsg == '') {
        try {
            $stmt = $connect->prepare('SELECT id_usuario, nombre_usuario, contrasena FROM usuarios WHERE nombre_usuario = :nombre_usuario');
            $stmt->execute(array(
                ':nombre_usuario' => $nombre_usuario
            ));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data == false) {
                $errMsg = "Usuario $nombre_usuario no encontrado.";
            } else {
                if ($contrasena == $data['contrasena']) {

                    $_SESSION['nombre_usuario'] = $data['nombre_usuario'];
                    $_SESSION['contrasena'] = $data['contrasena'];

                    header('Location: ../paginaprincipal.php');
                    exit;
                } else
                    $errMsg = 'Contraseña Incorrecta.';
            }
        } catch (PDOException $e) {
            $errMsg = $e->getMessage();
        }
    }
}
?>

<html>

<head>
    <title>Ingreso</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<link rel="stylesheet" href="../css/estilosInicioSesion.css">

<body>

    <div class="login-container">

        <div class="brand-section">
            <img src="../img/Intelligate_logo.jpg" alt="Logo de la empresa" class="logo">
        </div>
        <span>
            <a href="register.php">Registrate</a>
        </span>
        <form action="" method="post" class="login-form">
            <div class="input-group">
                <br>
                <label>Usuario</label>
                <br>
                <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" value="<?php if (isset($_POST['nombre_usuario'])) echo $_POST['nombre_usuario'] ?>" autocomplete="off" class="box" /><br /><br />
            </div>

            <div class="input-group">
                <label for="">Contraseña</label>
                <br>

                <input type="password" name="contrasena" placeholder="Contraseña" value="<?php if (isset($_POST['contrasena'])) echo $_POST['contrasena'] ?>" autocomplete="off" class="box" /><br /><br />
                <input type="submit" name='login' value="Ingresar" class='login-btn' /><br />
            </div>

        </form>
        <span><a href="forgot.php">Olvido la Contraseña</a></span><br>
        <span><a href="index.php">Volver al inicio</a></span>
    </div>
    <?php
    if (isset($errMsg)) {
        echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
    }
    ?>
    </div>

    </div>
    </div>
</body>

</html>