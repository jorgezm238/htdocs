<?php
/* Crea el código que dé respuesta al siguiente planteamiento:
Queremos almacenar en una matriz el número de alumnos con el que cuenta una
academia, ordenados en función del nivel y del idioma que se estudia. Tendremos
3 filas que representarán al Nivel básico, medio y de perfeccionamiento y 4
columnas en las que figurarán los idiomas (0 = Inglés, 1 = Francés, 2 = Alemán y 3
= Ruso). Mostrar por pantalla los alumnos que existen en cada nivel e idioma.*/

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