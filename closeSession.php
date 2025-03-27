<?php
include 'conn.php';
session_start();

// Guardar sumas resueltas antes de cerrar (por si acaso)

/*
if (isset($_SESSION['sumas'])) {
    $usuario_id = $_SESSION['id'];
    foreach ($_SESSION['sumas'] as $suma) {
        if ($suma['resuelta']) {
            $stmt = $enlace->prepare("SELECT idsumas FROM sumas_resueltas WHERE idusuarios = ? AND matriz1 = ? AND matriz2 = ?");
            $stmt->bind_param("iss", $usuario_id, json_encode($suma['matriz1']), json_encode($suma['matriz2']));
            $stmt->execute();
            
            if (!$stmt->get_result()->fetch_assoc()) {
                // Insertar si no existe
                $insert = $enlace->prepare("INSERT INTO sumas_resueltas (idusuarios, matriz1, matriz2, respuesta) VALUES (?, ?, ?, ?)");
                $digito1 = (int)($suma['matriz1'][0][0] . $suma['matriz1'][0][1]);
                $digito2 = (int)($suma['matriz2'][0][0] . $suma['matriz2'][0][1]);
                $insert->bind_param("issi", $usuario_id, 
                                  json_encode($suma['matriz1']), 
                                  json_encode($suma['matriz2']), 
                                  ($digito1 + $digito2));
                $insert->execute();
            }
        }
    }
}
*/

$_SESSION = array();
session_destroy();

header('Location: index.php');
exit();
?>