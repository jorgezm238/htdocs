<?php
$matriz = [
[1,2,3],
[4,5,6],
[7,8,9]
];
$sumaprincipal = 0;
$sumasecundaria = 0;

for ($i = 0; $i < 3; $i++) {
    $sumaprincipal += $matriz[$i][$i];
    $sumasecundaria += $matriz[$i][count($matriz)-1-$i];
}
echo "La suma de la diagonal principal es: " . $sumaprincipal. "<br>";
echo "La suma de la diagonal secundaria es: " . $sumasecundaria. "<br>";
var_dump($matriz);            

?>