<?php
function ecuacion ($a, $b, $c){
    $discriminante = $b*$b - 4*$a*$c;
    
        if ($discriminante < 0) {
            return false;
        } 
    
        $sol1 = (-$b + sqrt($discriminante)) / (2 * $a);
        $sol2 = (-$b - sqrt($discriminante)) / (2 * $a);
        return [$sol1 , $sol2];
    }

    function esPalindromo($palabra) {

        if ($palabra == strrev($palabra)) {
            return true;
        } else {
            return false;
        }
    }

    function ej4($arr, $limite) {
        $resultado = [];
        foreach ($arr as $numero) {
            if ($numero < $limite) {
                $resultado[]=$numero;
            }
        }
        return $resultado;
    }

    function isset($variable1){
    if (isset($variable1)) {
        return true;
    } else {
        return false;
    }
    }
    function empty($variable2){
        if (empty($variable2)) {
            return true;
        } else {
            return false;
        }
    }

    function null($variable3){
        if (is_null($variable3)) {
            return true;
        } else {
            return false;
        }


    }

?>
