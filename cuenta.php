<?php
include 'conn.php';
session_start();
?>

<script type="text/javascript">
    localStorage.clear();
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="static/css/styles.css">
    <link rel="stylesheet" href="static/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cuenta</title>
</head>
<body>
    <section class="header__section">
        <header class="header">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="dashboard.php" id="logo">
                    <i class="fa-solid fa-plus"></i>
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link">¡Hola, <?php echo $_SESSION['username']; ?>!</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php" id="inicio">Inicio</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="" id="cuenta">Cuenta</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="closeSession.php">Cerrar sesión</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        </header>
    </section>

    <div class="form-wrapper edit-form-wrapper">
        <form action="" method="post" class="user-form regist-form edit-form">

            <div class="input__container">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="nombre" value="<?php echo $_SESSION['nombre']; ?>">
            </div>

            <div class="input__container">
                <label for="lastname">Apellido</label>
                <input type="text" id="lastname" name="apellido" value="<?php echo $_SESSION['apellido']; ?>">
            </div>

            <div class="input__container">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
            </div>

            <div class="input__container">
                <label for="password">Contraseña actual</label>
                <input type="password" id="password" name="old-password">
            </div>

            <div class="input__container">
                <label for="password">Contraseña nueva</label>
                <input type="password" id="password" name="password">
            </div>
            <input type="hidden" id="idusuario" name="id" value="<?php echo $_SESSION['id']; ?>">
            <button type="submit" class="btn btn-primary login-btn" name="editar">Editar</button>
        </form>
    </div>
    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['editar'])) {
    session_start();
    $id = mysqli_real_escape_string($enlace, $_POST['id']);
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($enlace, $_POST['apellido']);
    $username = mysqli_real_escape_string($enlace, $_POST['username']);
    $oldPassword = mysqli_real_escape_string($enlace, $_POST['old-password']);
    $password = mysqli_real_escape_string($enlace, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($username === "" or $password === "") {
        echo '<div class="alert alert-danger regist-exception">Todos los campos son obligatorios</div>';
    } else if (strlen($username) > 12 or strlen($password) > 12) {
        echo '<div class="alert alert-danger regist-exception">Usuario o contraseña(max 12 caracteres) muy largo</div>';
    }else {
        $sql = ("UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', username = '$username', contraseña = '$hashed_password' WHERE idusuarios = '$id'");
        $execute = mysqli_query($enlace, $sql);

        if ($execute) {

          unset($_SESSION['sumas']);
          session_destroy();
          header('Location: index.php');
          
        } else {
          echo '<div class="alert alert-danger regist-exception">Error</div>';
        }
    }
}
?>