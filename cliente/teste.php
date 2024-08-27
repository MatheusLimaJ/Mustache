<?php 

$hora1 = '02:30';
$hora2 = '01:45';

// Converta as horas para timestamps
$timestamp1 = strtotime($hora1);
$timestamp2 = strtotime($hora2);

// Some os timestamps
$soma = $timestamp1 + ($timestamp2 - strtotime('00:00'));

// Converta o timestamp resultante de volta para o formato de hora
$resultado = date('H:i', $soma);

// Mostre o resultado
echo 'Resultado: ' . $resultado;

?>