<?php
/*Determinar la cantidad de dinero que recibirá un trabajador por concepto de las
horas extras trabajadas en una empresa, sabiendo que cuando las horas de
trabajo exceden de 40, el resto se consideran horas extras y que estas se pagan al
doble de una hora normal cuando no exceden de 8; si las horas extras exceden de
8 se pagan las primeras 8 al doble de lo que se pagan las horas normales y el resto
al triple*/

$sueldo_horas_normales=20;
$horas_trabajo=50;
$sueldo_horasExtra=0;
$result=0;

if ($horas_trabajo>40) {
    $horas_extra=($horas_trabajo - 40);

    if ($horas_extra <=8) {
        $sueldo_horasExtra= ($horas_extra *2) * $sueldo_horas_normales;
        $result=$sueldo_horasExtra;
    }
    if ($horas_extra > 8) {
        $result=$result + ($horas_extra*3);
    }
 

}
echo "La cantidad de dinero es: ". $result;


?>