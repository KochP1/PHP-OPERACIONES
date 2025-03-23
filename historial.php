<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/styles.css">
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <title>Historial de Sumas Resueltas</title>
</head>
<body>
    <section class="header__section">
        <header class="header">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                  <a class="navbar-brand" href="dashboard.php">Navbar</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="historial.php">Historial</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="closeSession.php">Cerrar sesión</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">Hello, <?php echo $_SESSION['username']; ?></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        </header>
    </section>

    <section class="historial-section">
        <div class="title__container">
            <h1>Historial de sumas resueltas</h1>
        </div>
        <div class="grid__container">
            <?php foreach ($_SESSION['sumas_resueltas'] as $suma): ?>
            <div class="flex-suma__container sumas-resueltas">
                <div class="suma_container">
                    <!-- Mostrar la primera matriz -->
                    <?php foreach ($suma['matriz1'] as $fila): ?>
                        <div class="digitos__container resuelto">
                            <?php foreach ($fila as $valor): ?>
                                <span class="digito"><?php echo $valor; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                    <!-- Mostrar la segunda matriz -->
                    <?php foreach ($suma['matriz2'] as $fila): ?>
                        <div class="digitos__container utl_digitos resuelto utl_digitos-resuelto">
                            <?php foreach ($fila as $valor): ?>
                                <span class="digito digito_3"><?php echo $valor; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                    <!-- Mostrar la respuesta correcta -->
                    <div class="respuesta-container">
                        <span class="respuesta">Respuesta: <?php echo $suma['respuesta']; ?></span>
                    </div>
                </div>
                <span class="simbolo">+</span>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="del-btn__container">
            <a href="del_historial.php">
                <button class="btn btn-danger">Eliminar historial</button>
            </a>
        </div>
    </section>

    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>
</html>