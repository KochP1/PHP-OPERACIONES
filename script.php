<?php

$matriz1 = [
    [2, 5]
];

$matriz2 = [
    [1, 8]
];

// Sumar las matrices
$resultado = [
    [$matriz1[0][0] + $matriz2[0][0], $matriz1[0][1] + $matriz2[0][1]]
];

$digito1 = $matriz1[0];

echo "'$digito1' ";

echo 'El resultado de la suma es:\n';

print_r($resultado);

?>