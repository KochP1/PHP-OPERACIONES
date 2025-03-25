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
            <button type="submit" class="btn btn-primary login-btn" name="iniciar">Buscar</button>
            <a href="index.php">Volver</a>
        </form>
    </div>

    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>
</html>