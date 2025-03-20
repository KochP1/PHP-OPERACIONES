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
    <title>Login</title>
</head>
<body>
    <div class="form-wrapper">
        <form action="" method="post" class="user-form">
            <div class="input__container">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username">
            </div>

            <div class="input__container">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary login-btn" name="iniciar">Inciar sesión</button>
            <a href="regist.php">¿No tienes una cuenta?</a>
        </form>
    </div>

    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['iniciar'])) {
    $username = mysqli_real_escape_string($enlace, $_POST['username']);
    $password = mysqli_real_escape_string($enlace, $_POST['password']);

    if ($username === "" or $password === "") {
        echo '<div class="alert alert-danger regist-exception">Todos los campos son obligatorios</div>';
    } else if (strlen($username) > 12 or strlen($password) > 12) {
        echo '<div class="alert alert-danger regist-exception">Usuario o contraseña(max 12 caracteres) muy largo</div>';
    }else {
        $sql = mysqli_query($enlace, "SELECT * FROM usuarios WHERE username = '$username'");
        if ($sql && mysqli_num_rows($sql) > 0) {
            $usuario = mysqli_fetch_assoc($sql);
            if (password_verify($password, $usuario['contraseña'])) {
                header('Location: dashboard.php');
                exit();
            } else {
                echo '<div class="alert alert-danger regist-exception">Usuario o contraseña inválidos</div>';
            }
        }   
    }
}
?>