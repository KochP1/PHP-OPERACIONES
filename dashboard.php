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
    $respuestaUsuario_2 = $_POST['respuesta_2'];
    $respuestaUsuario_3 = $_POST['respuesta_3'];

    $respuesta_1 = (string) ($respuestaUsuario);
    $respuesta_2 = (string) ($respuestaUsuario_2);
    $respuesta_3 = (string) ($respuestaUsuario_3);
    $respuestaCompleta =$respuesta_1 . $respuesta_2 . $respuesta_3;
    $respuestaFinal = (int) $respuestaCompleta;

    if (isset($_SESSION['sumas'][$indice])) {
        $suma = $_SESSION['sumas'][$indice];
        $digito_1 = (int) ($suma['matriz1'][0][0] . $suma['matriz1'][0][1]);
        $digito_2 = (int) ($suma['matriz2'][0][0] . $suma['matriz2'][0][1]);
        
        $respuestaCorrecta = $digito_1 + $digito_2;

        if ($respuestaFinal == $respuestaCorrecta) {
            $_SESSION['sumas_resueltas'][] = [
                'matriz1' => $suma['matriz1'],
                'matriz2' => $suma['matriz2'],
                'respuesta' => $respuestaCorrecta
            ];
            //Marcar la suma como resuelta
            $_SESSION['sumas'][$indice]['resuelta'] = true;

            $_SESSION['mensaje'] = ['tipo' => 'alert-success', 'texto' => '¡Respuesta correcta!'];
            header('Location: dashboard.php');
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'alert-danger', 'texto' => "Respuesta incorrecta. Inténtalo de nuevo."];
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Operaciones</title>
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
                        <a class="nav-link active" aria-current="page" href="cuenta.php" id="cuenta">Cuenta</a>
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
        <div class="grid__container" id="grid-container">
            <?php foreach ($_SESSION['sumas'] as $index => $suma): ?>
            <div class="wrapper">
                <div class="volver__container" id="volver-container-<?php echo $index; ?>">
                    <button class="btn btn-danger btn-volver" type="button" id="btn-volver-<?php echo $index; ?>" onclick="volver() ">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <form action="" method="post" class="suma-form <?php echo $suma['resuelta'] ? 'resuelta' : ''; ?>" index="<?php echo $index; ?>" onclick="deploySuma(this.getAttribute('index'))" id="sum-form-<?php echo $index; ?>">
                    <input type="hidden" name="indice" value="<?php echo $index; ?>">
                    <div class="flex-suma__container" id="<?php echo $index; ?>">
                    <div class="suma_container">
                        <!-- Mostrar la primera matriz -->
                        <?php foreach ($suma['matriz1'] as $fila): ?>
                            <div class="digitos__container">
                                <?php foreach ($fila as $valor): ?>
                                    <span class="digito <?php echo $suma['resuelta'] ? 'resuelta' : ''; ?> digito-1-<?php echo $index; ?>"><?php echo $valor; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>

                        <!-- Mostrar la segunda matriz -->
                        <?php foreach ($suma['matriz2'] as $fila): ?>
                            <div class="digitos__container utl_digitos <?php echo $suma['resuelta'] ? 'resuelta' : ''; ?>">
                                <?php foreach ($fila as $valor): ?>
                                    <span class="digito digito_3 <?php echo $suma['resuelta'] ? 'resuelta' : ''; ?> digito-2-<?php echo $index; ?>"><?php echo $valor; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>

                        <!-- Campo de entrada para la respuesta -->
                        <div class="buttons__container" id="btns-container-<?php echo $index; ?>">
                            <input type="number" name="respuesta" onkeydown="return false;" class="input-respuesta" min="0" max="9" step="1">
                            <input type="number" name="respuesta_2" onkeydown="return false;" class="input-respuesta" min="0" max="9" step="1">
                            <input type="hidden" name="respuesta_3" onkeydown="return false;" class="input-respuesta" min="0" max="9" step="1" id="respuesta-3-<?php echo $index; ?>">
                        </div>
                        <div class="volver__container" id="send-container-<?php echo $index; ?>">
                            <button class="btn btn-primary btn-enviar" type="submit" id="btn-enviar-<?php echo $index; ?>">
                                Enviar
                            </button>
                        </div>        
                    </div>
                    <span class="simbolo <?php echo $suma['resuelta'] ? 'resuelta' : ''; ?>">+</span>
                    </div>

                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <span class="span__footer">12345</span>

    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script src="static/js/script.js"></script>
</body>
</html>