<?php

/*Generar de forma aleatoria una matriz de 3x5 con valores numéricos.
a. Imprimir todos los elementos en forma sucesiva tomándolos por fila.
b. Igual al anterior pero por columna.*/

$num = array();
    for ($i=0; $i <3; $i++) { 
        for ($j=0; $j <5 ; $j++) { 
            $num[$i][$j] = rand(0, 10);
        }
    }

    foreach ($num as $fila) {
        foreach ($fila as $valor) {
            echo $valor . "\t";
        }
        echo "<br>"; 
    }

    
echo "Columna 1: ";
for ($i = 0; $i < 3; $i++) {
    echo $num[$i][0] . " ";
}
echo "\n";

echo "Columna 2: ";
for ($i = 0; $i < 3; $i++) {
    echo $num[$i][1] . " ";
}
echo "\n";

echo "Columna 3: ";
for ($i = 0; $i < 3; $i++) {
    echo $num[$i][2] . " ";
}
echo "\n";

echo "Columna 4: ";
for ($i = 0; $i < 3; $i++) {
    echo $num[$i][3] . " ";
}
echo "\n";

echo "Columna 5: ";
for ($i = 0; $i < 3; $i++) {
    echo $num[$i][4] . " ";
}
echo "\n";  
echo "<br>";

echo "Fila 1: ";
for ($i = 0; $i < 5; $i++) {
    echo $num[0][$i] . " ";
}
echo "\n";

echo "Fila 2: ";
for ($i = 0; $i < 5; $i++) {
    echo $num[1][$i] . " ";
}
echo "\n";

echo "Fila 3: ";
for ($i = 0; $i < 5; $i++) {
    echo $num[2][$i] . " ";
}
echo "\n";





?>