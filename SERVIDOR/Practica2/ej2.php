<?php
$alumnos = array(
   "Basico"=> array(
    'Ingles' => 1,
    'Francés'=> 14,
    'Alemán'=> 8,
    'Ruso' => 3
   ) , 
    " Medio"=> array(
    'Ingles' => 6,
    'Francés'=> 19,
    'Alemán'=> 7,
    'Ruso' => 2
   ) , 
    "Perfeccionamiento"=> array(
    'Ingles' => 3,
    'Francés'=> 13,
    'Alemán'=> 4,
    'Ruso' => 1
   ) , 
);
foreach ($alumnos as $nombres => $primerfor) { //recorres "BASICO", "MEDIO", "PERFECCIONAMIENTO"
    foreach ($primerfor as $idioma => $valor) { // recorres lo de dentro (El idioma y el valor del idioma)
      
      echo $idioma ." = " .$valor;
    }
    echo"<br>";
}



?>