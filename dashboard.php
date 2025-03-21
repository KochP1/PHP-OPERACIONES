<?php
include 'conn.php';
session_start();


function randomNums() {
  return [
      [rand(1, 9), rand(1, 9)]
  ];
}


if (!isset($_SESSION['sumas'])) {
  $_SESSION['sumas'] = [];
  for ($i = 0; $i < 8; $i++) {
      $_SESSION['sumas'][] = [
          'matriz1' => randomNums(),
          'matriz2' => randomNums(),
          'resuelta' => false 
      ];
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/styles.css">
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <title>Operaciones</title>
</head>
<body>
    <section class="header__section">
        <header class="header">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Navbar</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.html">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Historial</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="closeSession.php">Cerrar sesión</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link">Hello, <?php echo $_SESSION['username'] ?></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        </header>
    </section>

    <section class="sumas-section">
      <div class="grid__container">

      <?php foreach ($_SESSION['sumas'] as $index => $suma): ?>
        <?php if (!$suma['resuelta']): ?>
        <div class="suma_container">

        <?php foreach ($suma['matriz1'] as $fila): ?>
          <div class="digitos__container">
          <?php foreach ($fila as $valor): ?>
            <span class="digito"><?php echo $valor; ?></span>
          <?php endforeach; ?>
          </div>
          <?php endforeach; ?>

          <?php foreach ($suma['matriz2'] as $fila): ?>
          <div class="digitos__container utl_digitos">
            <?php foreach ($fila as $valor): ?>
            <span class="digito digito_3">6</span>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>

        </div>
        <?php endif; ?>
      <?php endforeach; ?>
      </div>
    </section>

    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>
</html>