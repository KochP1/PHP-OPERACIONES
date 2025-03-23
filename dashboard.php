<?php
include 'conn.php';
session_start();

function randomNums() {
    return [
        [rand(1, 9), rand(1, 9)]
    ];
}

// Inicializar las sumas aleatorias si no existen
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

// Inicializar el historial de sumas resueltas si no existe
if (!isset($_SESSION['sumas_resueltas'])) {
    $_SESSION['sumas_resueltas'] = [];
}

// Procesar la respuesta del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indice = $_POST['indice'];
    $respuestaUsuario = $_POST['respuesta'];

    if (isset($_SESSION['sumas'][$indice])) {
        $suma = $_SESSION['sumas'][$indice];
        $digito_1 = (int) ($suma['matriz1'][0][0] . $suma['matriz1'][0][1]);
        $digito_2 = (int) ($suma['matriz2'][0][0] . $suma['matriz2'][0][1]);
        
        $respuestaCorrecta = $digito_1 + $digito_2;

        if ($respuestaUsuario == $respuestaCorrecta) {
            $_SESSION['sumas_resueltas'][] = [
                'matriz1' => $suma['matriz1'],
                'matriz2' => $suma['matriz2'],
                'respuesta' => $respuestaCorrecta
            ];

            $_SESSION['sumas'][$indice] = [
                'matriz1' => randomNums(),
                'matriz2' => randomNums(),
                'resuelta' => false
            ];

            $_SESSION['mensaje'] = ['tipo' => 'alert-success', 'texto' => '¡Respuesta correcta! Se ha generado una nueva suma.'];
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'alert-danger', 'texto' => 'Respuesta incorrecta. Inténtalo de nuevo.'];
        }
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
                  <a class="navbar-brand" href="dashboard.php">Navbar</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php"">Home</a>
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

    <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="alert message <?php echo $_SESSION['mensaje']['tipo']; ?>">
                    <?php echo $_SESSION['mensaje']['texto']; ?>
                </div>
                <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <section class="sumas-section">
        <div class="title__container">
            <h1>Sumas propuestas</h1>
        </div>
        <div class="grid__container">
            <?php foreach ($_SESSION['sumas'] as $index => $suma): ?>
                <?php if (!$suma['resuelta']): ?>
                    <form action="" method="post" class="suma-form">
                        <input type="hidden" name="indice" value="<?php echo $index; ?>">
                        <div class="flex-suma__container">
                        <div class="suma_container">
                            <!-- Mostrar la primera matriz -->
                            <?php foreach ($suma['matriz1'] as $fila): ?>
                                <div class="digitos__container">
                                    <?php foreach ($fila as $valor): ?>
                                        <span class="digito"><?php echo $valor; ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>

                            <!-- Mostrar la segunda matriz -->
                            <?php foreach ($suma['matriz2'] as $fila): ?>
                                <div class="digitos__container utl_digitos">
                                    <?php foreach ($fila as $valor): ?>
                                        <span class="digito digito_3"><?php echo $valor; ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>

                            <!-- Campo de entrada para la respuesta -->
                            <div class="buttons__container">
                                <input type="number" name="respuesta" required>
                                <input type="submit" value="Enviar">
                            </div>
                        </div>

                        <span class="simbolo">+</span>
                        </div>
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>
</html>