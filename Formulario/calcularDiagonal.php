<?php
$matriz=array();
    for ($i=0; $i < $numeroDimensiones ; $i++) { 
        echo "<br>";
        for ($j=0; $j < $numeroDimensiones ; $j++) {


         }     
        }
$matriz[$i][$j]=$_POST["$i,$j"];

function suma($matriz){
    $sumaprincipal = 0;
    $sumasecundaria = 0;
    
    for ($i = 0; $i < count($matriz); $i++) {
        $sumaprincipal += $matriz[$i][$i];
        $sumasecundaria += $matriz[$i][count($matriz)-1-$i];
    }
    echo "La suma de la diagonal principal es: " . $sumaprincipal. "<br>";
    echo "La suma de la diagonal secundaria es: " . $sumasecundaria. "<br>";
    var_dump($matriz);

}
//Visualizar sumaElementos



?>