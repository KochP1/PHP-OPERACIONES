<?php
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/styles.css">
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <title>Registro</title>
</head>
<body>
    <div class="form-wrapper regist-form-wrapper">
        <form action="" method="post" class="user-form regist-form">

            <div class="input__container">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="input__container">
                <label for="lastname">Apellido</label>
                <input type="text" id="lastname" name="lastname">
            </div>

            <div class="input__container">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username">
            </div>

            <div class="input__container">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary login-btn" name="registro">Registrame</button>
            <a href="index.php">Ya tienes una cuenta?</a>
        </form>
    </div>

    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['registro'])) {
    $nombre = mysqli_real_escape_string($enlace, $_POST['name']);
    $apellido = mysqli_real_escape_string($enlace, $_POST['lastname']);
    $username = mysqli_real_escape_string($enlace, $_POST['username']);
    $password = mysqli_real_escape_string($enlace, $_POST['password']);

    if ($nombre === "" or $apellido === "" or $username === "" or $password === "") {
        echo "Todos los datos son obligatorios";
    } else if (strlen($nombre) > 15 or strlen($apellido) > 20 or strlen($username) > 12 or strlen($password) > 12) {
        echo "Nombre(max 15 caracteres) o apellido(max 20 caracteres) muy largo";
    }else {
        $insertDatos = "INSERT INTO usuarios (nombre, apellido, username, contraseña) VALUES ('$nombre', '$apellido', '$username', '$password')";
        $ejecutarInsert = mysqli_query($enlace, $insertDatos);

        if ($ejecutarInsert) {
            header('Location: index.php');
        } else {
            echo "Error MySql";
        }
    }
}
?>