<?php

include 'Operaciones.php';

// crear un objeto de clase Operaciones
$operar = new Operaciones(50,20);
// mostrar el objeto operar, usa el método __toString()
echo $operar . "<br>";

// mostrar operaciones básicas usando los métodos suma, resta, multiplicacion y division
echo $operar->suma() . "<br>";
echo $operar->resta() . "<br>";
echo $operar->mult() . "<br>";
echo $operar->div() . "<br>";



?>