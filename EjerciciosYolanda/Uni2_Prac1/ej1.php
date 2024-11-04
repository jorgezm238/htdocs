<?php
/*Dados 2 números asignados dentro del código a variables realizar el siguiente
cálculo: si son iguales que los multiplique, si el primero es mayor que el segundo
que los reste y si no que los sume. Mostrar el resultado en pantalla.*/
$n1=30;
$n2=30;
/* echo "Introduce el primer numero: ";
$n1=readline();
echo "Introduce el segundo numero: ";
$n2=readline(); */

 
if($n1 == $n2){
    $result= $n1*$n2;
    echo "El resultado de la multiplicación es: " . $result;
    }   

if ($n1 > $n2) {
     $result = $n1 - $n2;
    echo "El resultado de la resta es: " . $result;
    } 

 if($n1<$n2) {
     $result = $n1 + $n2;
    echo "El resultado de la suma es: " . $result;
    }


?>