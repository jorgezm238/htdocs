<?php
/* Crea una función para resolver la ecuación de segundo grado. Esta función recibe
los coeficientes de la ecuación y devuelve un array con las soluciones. Si no hay
soluciones reales, devuelve FALSE.  */

function ecuacion ($a, $b, $c){
$discriminante = $b*$b - 4*$a*$c;

    if ($discriminante < 0) {
        return false;
    } 

    $sol1 = (-$b + sqrt($discriminante)) / (2 * $a);
    $sol2 = (-$b - sqrt($discriminante)) / (2 * $a);
    return [$sol1 , $sol2];
}



?>